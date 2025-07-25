<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinalLaporanResource\Pages;
use App\Models\PengajuanMagang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;

class FinalLaporanResource extends Resource
{
    protected static ?string $model = PengajuanMagang::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Akhir';
    protected static ?string $pluralModelLabel = 'Laporan Akhir';

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && in_array($user->role, ['admin', 'mahasiswa']);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery()->with(['mahasiswa.user', 'pembimbing.user']);
        if (Auth::user()->role === 'mahasiswa' && Auth::user()->mahasiswa) {
            $query->where('mahasiswa_id', Auth::user()->mahasiswa->id);
        } elseif (Auth::user()->role === 'admin') {
            $query->whereIn('status', [PengajuanMagang::STATUS_DITERIMA, PengajuanMagang::STATUS_SELESAI]);
        }
        return $query;
    }

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';
        $isMahasiswa = $user->role === 'mahasiswa';

        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengajuan')
                    ->schema([
                        Forms\Components\Select::make('mahasiswa_id')
                            ->relationship('mahasiswa', 'user.name', fn ($query) => $query->whereHas('user', fn ($q) => $q->where('role', 'mahasiswa')))
                            ->label('Mahasiswa')
                            ->disabled()
                            ->required()
                            ->default(fn () => $isMahasiswa && $user->mahasiswa ? $user->mahasiswa->id : null),
                        Forms\Components\Select::make('pembimbing_id')
                            ->relationship('pembimbing', 'user_id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? 'Tanpa Nama')
                            ->label('Pembimbing')
                            ->disabled()
                            ->visible($isAdmin),
                        Forms\Components\TextInput::make('bidang_diminati')
                            ->label('Bidang Diminati')
                            ->disabled(),
                        Forms\Components\TextInput::make('durasi_magang')
                            ->label('Durasi Magang')
                            ->suffix('minggu')
                            ->disabled(),
                        Forms\Components\TextInput::make('status')
                            ->label('Status Pengajuan')
                            ->disabled(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Laporan Akhir')
                    ->schema([
                        Forms\Components\FileUpload::make('final_laporan')
                            ->label('Laporan Akhir')
                            ->directory('pengajuan-magang/laporan')
                            ->acceptedFileTypes(['application/pdf'])
                            ->visible($isMahasiswa)
                            ->disabled(fn ($record) => !$record || !$record->isDiterima() || $record->final_laporan)
                            ->required(fn ($record) => $record instanceof \App\Models\PengajuanMagang && $isMahasiswa && $record->isDiterima() && !$record->final_laporan),
                    ])
                    ->visible($isMahasiswa || $isAdmin),

                Forms\Components\Section::make('Sertifikat')
                    ->schema([
                        Forms\Components\FileUpload::make('sertifikat')
                            ->label('Sertifikat')
                            ->directory('pengajuan-magang/sertifikat')
                            ->acceptedFileTypes(['application/pdf'])
                            ->visible(fn ($record) => $record instanceof \App\Models\PengajuanMagang && Auth::user()->role === 'admin')
                            ->disabled(fn ($record) => !$record || !$record->final_laporan || ($record->sertifikat))
                            ->required(fn ($record) => $record instanceof \App\Models\PengajuanMagang && Auth::user()->role === 'admin' && $record->final_laporan && !$record->sertifikat)
                            ->afterStateUpdated(function ($state, $set, $record) {
                                if ($state && $record && $record->final_laporan) {
                                    $record->status = PengajuanMagang::STATUS_SELESAI;
                                    $record->save();
                                }
                            }),
                    ])
                    ->visible(fn ($record) => $record instanceof \App\Models\PengajuanMagang && (Auth::user()->role === 'admin' || (Auth::user()->role === 'mahasiswa' && $record->sertifikat))),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';
        $isMahasiswa = $user->role === 'mahasiswa';

        return $table
            ->heading(function () use ($user, $isMahasiswa) {
                if (!$isMahasiswa || !$user->mahasiswa) {
                    return null;
                }

                $pengajuan = PengajuanMagang::where('mahasiswa_id', $user->mahasiswa->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if (!$pengajuan) {
                    return null;
                }

                $html = '';

                if ($pengajuan->isDiterima() && !$pengajuan->final_laporan) {
                    $html = '
                        <div style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
                                   border: 2px solid #f59e0b;
                                   border-radius: 12px;
                                   padding: 20px;
                                   margin: 16px 0;
                                   box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.1);">
                            <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                <div style="background: #f59e0b;
                                           color: white;
                                           border-radius: 50%;
                                           width: 32px;
                                           height: 32px;
                                           display: flex;
                                           align-items: center;
                                           justify-content: center;
                                           font-weight: bold;
                                           margin-right: 12px;">📋</div>
                                <h3 style="color: #92400e;
                                          font-size: 18px;
                                          font-weight: 700;
                                          margin: 0;">UPLOAD LAPORAN AKHIR</h3>
                            </div>
                            <div style="background: #fde68a;
                                       border-left: 4px solid #f59e0b;
                                       padding: 12px 16px;
                                       border-radius: 6px;">
                                <p style="color: #92400e;
                                         font-size: 16px;
                                         margin: 0;
                                         line-height: 1.5;">
                                    📄 Pengajuan magang Anda telah diterima. Silakan upload laporan akhir Anda.
                                </p>
                            </div>
                        </div>';
                } elseif ($pengajuan->isDiterima() && $pengajuan->final_laporan && !$pengajuan->sertifikat) {
                    $html = '
                        <div style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
                                   border: 2px solid #f59e0b;
                                   border-radius: 12px;
                                   padding: 20px;
                                   margin: 16px 0;
                                   box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.1);">
                            <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                <div style="background: #f59e0b;
                                           color: white;
                                           border-radius: 50%;
                                           width: 32px;
                                           height: 32px;
                                           display: flex;
                                           align-items: center;
                                           justify-content: center;
                                           font-weight: bold;
                                           margin-right: 12px;">⏳</div>
                                <h3 style="color: #92400e;
                                          font-size: 18px;
                                          font-weight: 700;
                                          margin: 0;">MENUNGGU SERTIFIKAT</h3>
                            </div>
                            <div style="background: #fde68a;
                                       border-left: 4px solid #f59e0b;
                                       padding: 12px 16px;
                                       border-radius: 6px;">
                                <p style="color: #92400e;
                                         font-size: 16px;
                                         margin: 0;
                                         line-height: 1.5;">
                                    📋 Laporan akhir Anda telah diupload. Menunggu admin untuk mengupload sertifikat.
                                </p>
                            </div>
                        </div>';
                } elseif ($pengajuan->status === PengajuanMagang::STATUS_SELESAI && $pengajuan->sertifikat) {
                    $html = '
                        <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
                                   border: 2px solid #16a34a;
                                   border-radius: 12px;
                                   padding: 20px;
                                   margin: 16px 0;
                                   box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.1);">
                            <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                <div style="background: #16a34a;
                                           color: white;
                                           border-radius: 50%;
                                           width: 32px;
                                           height: 32px;
                                           display: flex;
                                           align-items: center;
                                           justify-content: center;
                                           font-weight: bold;
                                           margin-right: 12px;">✅</div>
                                <h3 style="color: #15803d;
                                          font-size: 18px;
                                          font-weight: 700;
                                          margin: 0;">MAGANG SELESAI</h3>
                            </div>
                            <div style="background: #bbf7d0;
                                       border-left: 4px solid #16a34a;
                                       padding: 12px 16px;
                                       border-radius: 6px;">
                                <p style="color: #15803d;
                                         font-size: 16px;
                                         margin: 0;
                                         line-height: 1.5;">
                                    🎉 Magang Anda telah selesai! Sertifikat tersedia untuk diunduh.
                                </p>
                            </div>
                            <div style="margin-top: 12px; background: rgba(22, 163, 74, 0.1); border-radius: 6px; padding: 12px;">
                                <a href="' . asset('storage/' . $pengajuan->sertifikat) . '"
                                   target="_blank"
                                   style="background: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; transition: background-color 0.2s;"
                                   onmouseover="this.style.background=\'#059669\'"
                                   onmouseout="this.style.background=\'#16a34a\'">
                                    📥 Unduh Sertifikat
                                </a>
                            </div>
                        </div>';
                }

                return new HtmlString($html);
            })
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Mahasiswa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pembimbing.user.name')
                    ->label('Pembimbing')
                    ->sortable()
                    ->searchable()
                    ->visible($isAdmin),
                Tables\Columns\TextColumn::make('bidang_diminati')
                    ->label('Bidang Diminati')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('durasi_magang')
                    ->label('Durasi Magang')
                    ->suffix(' minggu')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pengajuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        PengajuanMagang::STATUS_PENDING => 'warning',
                        PengajuanMagang::STATUS_DITERIMA => 'success',
                        PengajuanMagang::STATUS_DITOLAK => 'danger',
                        PengajuanMagang::STATUS_SELESAI => 'info',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('final_laporan')
                    ->label('Laporan Akhir')
                    ->formatStateUsing(fn ($state) => $state ? 'Sudah Diupload' : 'Belum Diupload')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sertifikat')
                    ->label('Sertifikat')
                    ->formatStateUsing(fn ($state) => $state ? 'Sudah Diupload' : 'Belum Diupload')
                    ->sortable()
                    ->visible($isAdmin || fn ($record) => $record->sertifikat),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        PengajuanMagang::STATUS_DITERIMA => 'Diterima',
                        PengajuanMagang::STATUS_SELESAI => 'Selesai',
                    ])
                    ->visible($isAdmin),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Upload')
                    ->visible(fn ($record) => $isAdmin || ($isMahasiswa && $record->isDiterima() && !$record->final_laporan)),
                Action::make('view_laporan')
                    ->label('Lihat Laporan')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->visible(fn ($record) => $isAdmin && $record->final_laporan)
                    ->url(fn ($record) => asset('storage/' . $record->final_laporan))
                    ->openUrlInNewTab(),
                Action::make('download_sertifikat')
                    ->label('Unduh Sertifikat')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->visible(fn ($record) => $isMahasiswa && $record->status === PengajuanMagang::STATUS_SELESAI && $record->sertifikat)
                    ->url(fn ($record) => asset('storage/' . $record->sertifikat))
                    ->openUrlInNewTab(),
                Action::make('verify_sertifikat')
                    ->label('Verifikasi Sertifikat')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $isAdmin && $record->final_laporan && !$record->sertifikat)
                    ->form([
                        Forms\Components\FileUpload::make('sertifikat')
                            ->label('Sertifikat')
                            ->directory('pengajuan-magang/sertifikat')
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->sertifikat = $data['sertifikat'];
                        $record->status = PengajuanMagang::STATUS_SELESAI;
                        $record->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible($isAdmin)
                    ->requiresConfirmation(),
            ]);
    }

    public static function canCreate(): bool
    {
        return false; // Laporan Akhir is tied to PengajuanMagang, so no direct creation
    }

    public static function canEdit(Model $record): bool
    {
        if (!$record instanceof PengajuanMagang) {
            return false;
        }

        $user = Auth::user();
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'mahasiswa' && $user->mahasiswa) {
            return $record->mahasiswa_id === $user->mahasiswa->id && $record->isDiterima() && !$record->final_laporan;
        }
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        if (!$record instanceof PengajuanMagang) {
            return false;
        }

        return Auth::user()->role === 'admin';
    }

    public static function canView(Model $record): bool
    {
        if (!$record instanceof PengajuanMagang) {
            return false;
        }

        $user = Auth::user();
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'mahasiswa' && $user->mahasiswa) {
            return $record->mahasiswa_id === $user->mahasiswa->id;
        }
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinalLaporans::route('/'),
            'edit' => Pages\EditFinalLaporan::route('/{record}/edit'),
            // 'view' => Pages\ViewFinalLaporan::route('/{record}'), // Commented out due to undefined ViewFinalLaporan
        ];
    }
}
