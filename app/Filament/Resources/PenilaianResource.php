<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianResource\Pages;
use App\Models\Penilaian;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use App\Models\PengajuanMagang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static ?string $navigationGroup = 'ALUR PELAKSANAAN PKL';

    public static function getNavigationSort(): ?int
{
    return 4; // Ganti X dengan angka sesuai urutan yang kamu inginkan
}


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Penilaian';

    protected static ?string $modelLabel = 'Penilaian';

    protected static ?string $pluralModelLabel = 'Penilaian';

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $isMahasiswa = $user->role === 'mahasiswa';
        $isPembimbing = $user->role === 'pembimbing';

        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->label('Mahasiswa')
                    ->relationship('mahasiswa', 'nim')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name . ' (' . $record->nim . ')')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabled($isMahasiswa),
                Forms\Components\Select::make('pembimbing_id')
                    ->label('Pembimbing')
                    ->relationship('pembimbing', 'nip')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name . ' (' . $record->nip . ')')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabled($isMahasiswa),
                Forms\Components\TextInput::make('aspek_penilaian')
                    ->label('Aspek Penilaian')
                    ->required()
                    ->maxLength(255)
                    ->disabled($isMahasiswa),
                Forms\Components\TextInput::make('nilai')
                    ->label('Nilai')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->disabled($isMahasiswa),
                Forms\Components\TextInput::make('bobot')
                    ->label('Bobot')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(1)
                    ->step(0.01)
                    ->disabled($isMahasiswa),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->disabled($isMahasiswa),
                Forms\Components\TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('grade')
                    ->label('Grade')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\DateTimePicker::make('tanggal_penilaian')
                    ->label('Tanggal Penilaian')
                    ->required()
                    ->disabled($isMahasiswa),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $isMahasiswa = $user->role === 'mahasiswa';
        $isPembimbing = $user->role === 'pembimbing';
        $isAdmin = !$isMahasiswa && !$isPembimbing;

        $pembimbing = $isPembimbing ? Pembimbing::where('user_id', $user->id)->first() : null;
        $mahasiswa = $isMahasiswa ? Mahasiswa::where('user_id', $user->id)->first() : null;

        // Hitung jumlah mahasiswa bimbingan untuk pembimbing
        $mahasiswaList = $isPembimbing && $pembimbing
            ? PengajuanMagang::where('pembimbing_id', $pembimbing->id)
                ->where('status', PengajuanMagang::STATUS_DITERIMA)
                ->with(['mahasiswa.user'])
                ->distinct('mahasiswa_id')
                ->get()
            : collect([]);
        $mahasiswaCount = $mahasiswaList->count();

        $ungradedCount = $isPembimbing && $pembimbing
            ? Penilaian::where('pembimbing_id', $pembimbing->id)
                ->whereNull('nilai')
                ->count()
            : 0;

        return $table
            ->heading(function () use ($isPembimbing, $mahasiswaCount, $ungradedCount, $mahasiswaList) {
                if ($isPembimbing) {
                    $html = '
                        <div style="background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
                                   border: 2px solid #2563eb;
                                   border-radius: 12px;
                                   padding: 20px;
                                   margin: 16px 0;
                                   box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);">
                            <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                <div style="background: #2563eb;
                                           color: white;
                                           border-radius: 50%;
                                           width: 48px;
                                           height: 48px;
                                           display: flex;
                                           align-items: center;
                                           justify-content: center;
                                           font-size: 28px;
                                           margin-right: 16px;
                                           box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                           transition: transform 0.2s;"
                                           title="Daftar Mahasiswa Bimbingan">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <h3 style="color: #1e40af;
                                          font-size: 22px;
                                          font-weight: 700;
                                          margin: 0;">DAFTAR MAHASISWA BIMBINGAN (' . htmlspecialchars($mahasiswaCount) . ' MAHASISWA, ' . htmlspecialchars($ungradedCount) . ' BELUM DINILAI)</h3>
                            </div>
                            <div style="background: #bfdbfe;
                                       border-left: 4px solid #2563eb;
                                       padding: 12px 16px;
                                       border-radius: 6px;">
                                <p style="color: #1e40af;
                                         font-size: 16px;
                                         margin: 0;
                                         line-height: 1.5;">
                                    Tinjau dan masukkan nilai untuk mahasiswa yang Anda bimbing. Gunakan filter di bawah untuk memilih mahasiswa tertentu.
                                </p>
                            </div>';

                    // Add table for supervised students
                    if ($mahasiswaCount > 0) {
                        $html .= '
                            <div style="margin-top: 16px;">
                                <table style="width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                    <thead>
                                        <tr style="background: #2563eb; color: white;">
                                            <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600;">No</th>
                                            <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600;">Nama Mahasiswa</th>
                                            <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600;">NIM</th>
                                            <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600;">Status Magang</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        foreach ($mahasiswaList as $index => $pengajuan) {
                            $html .= '
                                        <tr style="border-bottom: 1px solid #e5e7eb;">
                                            <td style="padding: 12px; font-size: 14px; color: #1e40af;">' . ($index + 1) . '</td>
                                            <td style="padding: 12px; font-size: 14px; color: #1e40af;">' . htmlspecialchars($pengajuan->mahasiswa->user->name) . '</td>
                                            <td style="padding: 12px; font-size: 14px; color: #1e40af;">' . htmlspecialchars($pengajuan->mahasiswa->nim) . '</td>
                                            <td style="padding: 12px; font-size: 14px;">
                                                <span style="padding: 4px 8px; border-radius: 4px; background: #dcfce7; color: #15803d; font-weight: 600;">
                                                    ' . htmlspecialchars($pengajuan->status) . '
                                                </span>
                                            </td>
                                        </tr>';
                        }
                        $html .= '
                                    </tbody>
                                </table>
                            </div>';
                    } else {
                        $html .= '
                            <div style="margin-top: 16px; background: #fef2f2; border-left: 4px solid #dc2626; padding: 12px 16px; border-radius: 6px;">
                                <p style="color: #991b1b; font-size: 16px; margin: 0; line-height: 1.5;">
                                    Tidak ada mahasiswa bimbingan yang ditemukan.
                                </p>
                            </div>';
                    }

                    $html .= '
                            <div style="margin-top: 16px;">
                                <button type="button"
                                        class="filament-button filament-button-size-lg"
                                        style="background: #2563eb;
                                               color: white;
                                               padding: 12px 24px;
                                               font-size: 18px;
                                               font-weight: 600;
                                               border-radius: 8px;
                                               border: none;
                                               cursor: pointer;
                                               box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                               transition: background 0.2s;"
                                        title="Filter berdasarkan nama mahasiswa"
                                        onclick="document.querySelector(\'[wire\\\\:model=\\\"tableFilters.mahasiswa.value\\\"]\').focus();">
                                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Filter Berdasarkan Mahasiswa
                                </button>
                            </div>
                        </div>';

                    return new HtmlString($html);
                }
                return null;
            })
            ->query(function () use ($isMahasiswa, $isPembimbing, $user, $mahasiswa, $pembimbing) {
                $query = Penilaian::query()->with(['mahasiswa.user', 'pembimbing.user']);
                if ($isMahasiswa && $mahasiswa) {
                    $query->where('mahasiswa_id', $mahasiswa->id);
                } elseif ($isPembimbing && $pembimbing) {
                    $query->where('pembimbing_id', $pembimbing->id);
                }
                return $query;
            })
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(query: function (Builder $query, $search) {
                        $query->whereHas('mahasiswa.user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable()
                    ->weight('bold')
                    ->size('sm'),
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('pembimbing.user.name')
                    ->label('Nama Pembimbing')
                    ->searchable(query: function (Builder $query, $search) {
                        $query->whereHas('pembimbing.user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('pembimbing.nip')
                    ->label('NIP Pembimbing')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('aspek_penilaian')
                    ->label('Aspek Penilaian')
                    ->searchable()
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('status_penilaian')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->nilai !== null ? 'Sudah Dinilai' : 'Belum Dinilai';
                    })
                    ->badge()
                    ->colors([
                        'success' => 'Sudah Dinilai',
                        'warning' => 'Belum Dinilai',
                    ])
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextInputColumn::make('nilai')
                    ->label('Nilai')
                    ->type('number')
                    ->rules(['required', 'numeric', 'min:0', 'max:100'])
                    ->updateStateUsing(function ($record, $state) {
                        $record->nilai = $state;
                        $record->tanggal_penilaian = now();
                        $record->save();
                    })
                    ->default('-')
                    ->sortable()
                    ->visible($isPembimbing),
                Tables\Columns\TextColumn::make('bobot')
                    ->label('Bobot')
                    ->default('-')
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->default('-')
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('grade')
                    ->label('Grade')
                    ->default('-')
                    ->sortable()
                    ->size('sm'),
                Tables\Columns\TextColumn::make('tanggal_penilaian')
                    ->label('Tanggal Penilaian')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->size('sm'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('mahasiswa')
                    ->label('Nama Mahasiswa')
                    ->relationship('mahasiswa', 'nim')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name . ' (' . $record->nim . ')')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->visible($isPembimbing || $isAdmin),
                Tables\Filters\SelectFilter::make('pembimbing')
                    ->label('Pembimbing')
                    ->relationship('pembimbing', 'nip')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name . ' (' . $record->nip . ')')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->visible($isAdmin),
                Tables\Filters\SelectFilter::make('status_penilaian')
                    ->label('Status')
                    ->options([
                        'Sudah Dinilai' => 'Sudah Dinilai',
                        'Belum Dinilai' => 'Belum Dinilai',
                    ])
                    ->query(function ($query, $state) {
                        if ($state['value'] === 'Sudah Dinilai') {
                            $query->whereNotNull('nilai');
                        } elseif ($state['value'] === 'Belum Dinilai') {
                            $query->whereNull('nilai');
                        }
                    })

                    ->visible($isPembimbing || $isAdmin),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('info')
                    ->visible($isMahasiswa),
                Tables\Actions\EditAction::make()
                    ->color('warning')
                    ->visible($isPembimbing),
                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->visible($isPembimbing || $isAdmin),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible($isPembimbing || $isAdmin),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(25);
    }

    public static function getRelations(): array
    {
        return [];
    }

 public static function getPages(): array
{
    $user = Auth::user();
    $pages = [
        'index' => Pages\ListPenilaians::route('/'),
    ];

    // Only check roles if a user is authenticated
    if ($user) {
        $isMahasiswa = $user->role === 'mahasiswa';
        $isPembimbing = $user->role === 'pembimbing';

        if ($isPembimbing) {
            // Add any pembimbing-specific pages here if needed
        }

        if ($isMahasiswa) {
            // Add any mahasiswa-specific pages here if needed
        }
    }

    return $pages;
}

    public static function canCreate(): bool
    {
        return Auth::user()->role === 'pembimbing';
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        $pembimbing = Pembimbing::where('user_id', $user->id)->first();
        return $user->role === 'pembimbing' && $pembimbing && $record->pembimbing_id === $pembimbing->id;
    }

    public static function canView($record): bool
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        return $user->role === 'mahasiswa' && $mahasiswa && $record->mahasiswa_id === $mahasiswa->id;
    }

    public static function canDelete($record): bool
    {
        $user = Auth::user();
        $pembimbing = Pembimbing::where('user_id', $user->id)->first();
        $isAdmin = !$user->role === 'mahasiswa' && !$user->role === 'pembimbing';
        return ($user->role === 'pembimbing' && $pembimbing && $record->pembimbing_id === $pembimbing->id) || $isAdmin;
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user->role === 'mahasiswa' || $user->role === 'pembimbing' || (!$user->role === 'mahasiswa' && !$user->role === 'pembimbing');
    }

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();
        if ($user->role === 'pembimbing') {
            $pembimbing = Pembimbing::where('user_id', $user->id)->first();
            return (string) Penilaian::where('pembimbing_id', $pembimbing->id)->count();
        }
        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            return (string) Penilaian::where('mahasiswa_id', $mahasiswa->id)->count();
        }
        return (string) Penilaian::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            $count = Penilaian::where('mahasiswa_id', $mahasiswa->id)->count();
            return $count > 0 ? 'success' : 'warning';
        }
        if ($user->role === 'pembimbing') {
            $pembimbing = Pembimbing::where('user_id', $user->id)->first();
            $count = Penilaian::where('pembimbing_id', $pembimbing->id)->whereNull('nilai')->count();
            return $count > 0 ? 'warning' : 'success';
        }
        return 'primary';
    }
}
