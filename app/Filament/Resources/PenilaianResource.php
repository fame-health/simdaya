<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianResource\Pages;
use App\Models\Penilaian;
use App\Models\PengajuanMagang;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Penilaian Magang';

    public static function form(Form $form): Form
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $form
            ->schema([
                Forms\Components\Select::make('pengajuan_magang_id')
                    ->label('Pengajuan Magang')
                    ->options(function () use ($user) {
                        if ($user->isPembimbing()) {
                            return PengajuanMagang::where('pembimbing_id', $user->pembimbing->id)
                                ->pluck('id', 'id');
                        }
                        return PengajuanMagang::pluck('id', 'id');
                    })
                    ->required()
                    ->disabled(fn () => !$user->isAdmin()),
                Forms\Components\Select::make('mahasiswa_id')
                    ->label('Mahasiswa')
                    ->options(function () use ($user) {
                        if ($user->isPembimbing()) {
                            return PengajuanMagang::where('pembimbing_id', $user->pembimbing->id)
                                ->with('mahasiswa')
                                ->get()
                                ->pluck('mahasiswa.nim', 'mahasiswa_id');
                        }
                        return \App\Models\Mahasiswa::pluck('nim', 'id');
                    })
                    ->required()
                    ->disabled(fn () => !$user->isAdmin()),
                Forms\Components\TextInput::make('aspek_penilaian')
                    ->label('Aspek Penilaian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nilai')
                    ->label('Nilai')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100),
                Forms\Components\TextInput::make('bobot')
                    ->label('Bobot')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(1)
                    ->disabled(fn () => !$user->isAdmin()),
                Forms\Components\TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Nilai akhir dihitung otomatis: nilai × bobot'),
                Forms\Components\TextInput::make('grade')
                    ->label('Grade')
                    ->maxLength(2)
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('tanggal_penilaian')
                    ->label('Tanggal Penilaian')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM Mahasiswa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('aspek_penilaian')
                    ->label('Aspek Penilaian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bobot')
                    ->label('Bobot')
                    ->sortable()
                    ->visible(fn () => $user->isAdmin()),
                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade')
                    ->label('Grade')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penilaian')
                    ->label('Tanggal Penilaian')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->modifyQueryUsing(function ($query) use ($user) {
                if ($user->isPembimbing()) {
                    return $query->whereHas('pengajuanMagang', function ($q) use ($user) {
                        $q->where('pembimbing_id', $user->pembimbing->id);
                    });
                }
                return $query;
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return $user->isAdmin() || $user->isPembimbing();
    }
}
