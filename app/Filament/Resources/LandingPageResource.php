<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Models\LandingPage;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Landing Page';
    protected static ?string $modelLabel = 'Landing Page';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Konten Landing Page')
                    ->tabs([
                        Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Section::make('Konten Utama')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title')
                                            ->label('Judul Utama')
                                            ->required()
                                            ->maxLength(100)
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('hero_subtitle')
                                            ->label('Subjudul')
                                            ->required()
                                            ->rows(2)
                                            ->maxLength(200)
                                            ->columnSpanFull(),
                                        FileUpload::make('hero_image')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->directory('landing-page/hero')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Tombol Aksi')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_cta_text')
                                                    ->label('Teks Tombol Utama')
                                                    ->required()
                                                    ->maxLength(30),
                                                Forms\Components\TextInput::make('hero_cta_link')
                                                    ->label('Link Tombol Utama')
                                                    ->url()
                                                    ->required(),
                                                Forms\Components\TextInput::make('hero_secondary_cta_text')
                                                    ->label('Teks Tombol Sekunder')
                                                    ->maxLength(30),
                                                Forms\Components\TextInput::make('hero_secondary_cta_link')
                                                    ->label('Link Tombol Sekunder')
                                                    ->url(),
                                            ]),
                                    ]),

                                Section::make('Statistik')
                                    ->description('Tampilan angka statistik di hero section')
                                    ->schema([
                                        Repeater::make('statistics')
                                            ->label('Daftar Statistik')
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->label('Nilai')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('label')
                                                    ->label('Label')
                                                    ->required()
                                                    ->maxLength(20),
                                                Forms\Components\TextInput::make('suffix')
                                                    ->label('Suffix (contoh: +, %)')
                                                    ->maxLength(5),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(3)
                                            ->maxItems(5),
                                    ]),
                            ]),

                        Tabs\Tab::make('Tentang Kami')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Konten Tentang')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_title')
                                            ->label('Judul Section')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\Textarea::make('about_description')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        FileUpload::make('about_image')
                                            ->label('Gambar Tentang')
                                            ->image()
                                            ->directory('landing-page/about')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Fitur Unggulan')
                                    ->schema([
                                        Repeater::make('features')
                                            ->label('Daftar Fitur')
                                            ->schema([
                                                Forms\Components\Select::make('icon')
                                                    ->label('Ikon')
                                                    ->options([
                                                        'heroicon-o-check-circle' => 'Check',
                                                        'heroicon-o-user-group' => 'User Group',
                                                        'heroicon-o-star' => 'Star',
                                                        'heroicon-o-chart-bar' => 'Chart',
                                                        'heroicon-o-academic-cap' => 'Academic',
                                                        'heroicon-o-light-bulb' => 'Light Bulb',
                                                    ])
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Fitur')
                                                    ->required()
                                                    ->maxLength(50),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required()
                                                    ->rows(2)
                                                    ->maxLength(150),
                                                Forms\Components\Select::make('color')
                                                    ->label('Warna')
                                                    ->options([
                                                        'primary' => 'Primary',
                                                        'secondary' => 'Secondary',
                                                        'success' => 'Success',
                                                        'danger' => 'Danger',
                                                        'warning' => 'Warning',
                                                        'info' => 'Info',
                                                    ])
                                                    ->default('primary'),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(4)
                                            ->maxItems(6),
                                    ]),
                            ]),

                        Tabs\Tab::make('Program')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Section::make('Konten Program')
                                    ->schema([
                                        Forms\Components\TextInput::make('programs_title')
                                            ->label('Judul Section')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\Textarea::make('programs_description')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Daftar Program')
                                    ->schema([
                                        Repeater::make('programs')
                                            ->label('Program')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Nama Program')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required()
                                                    ->rows(2)
                                                    ->maxLength(200),
                                                Forms\Components\TextInput::make('duration')
                                                    ->label('Durasi')
                                                    ->required()
                                                    ->maxLength(50),
                                                Forms\Components\TextInput::make('quota')
                                                    ->label('Kuota')
                                                    ->required()
                                                    ->maxLength(50),
                                                FileUpload::make('image')
                                                    ->label('Gambar Program')
                                                    ->image()
                                                    ->directory('landing-page/programs'),
                                                Forms\Components\Select::make('color')
                                                    ->label('Warna')
                                                    ->options([
                                                        'primary' => 'Primary',
                                                        'secondary' => 'Secondary',
                                                        'success' => 'Success',
                                                        'danger' => 'Danger',
                                                        'warning' => 'Warning',
                                                        'info' => 'Info',
                                                    ])
                                                    ->default('primary'),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(3)
                                            ->maxItems(6),
                                    ]),
                            ]),

                        Tabs\Tab::make('Testimoni')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                Section::make('Konten Testimoni')
                                    ->schema([
                                        Forms\Components\TextInput::make('testimonials_title')
                                            ->label('Judul Section')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\Textarea::make('testimonials_description')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Daftar Testimoni')
                                    ->schema([
                                        Repeater::make('testimonials')
                                            ->label('Testimoni')
                                            ->schema([
                                                Forms\Components\Textarea::make('quote')
                                                    ->label('Kutipan')
                                                    ->required()
                                                    ->rows(3)
                                                    ->maxLength(300),
                                                Forms\Components\TextInput::make('author')
                                                    ->label('Nama')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Jabatan/Peran')
                                                    ->required()
                                                    ->maxLength(100),
                                                FileUpload::make('image')
                                                    ->label('Foto')
                                                    ->image()
                                                    ->directory('landing-page/testimonials')
                                                    ->avatar(),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(3)
                                            ->maxItems(6),
                                    ]),
                            ]),

                        Tabs\Tab::make('CTA Section')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Section::make('Call to Action')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_section_title')
                                            ->label('Judul')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\Textarea::make('cta_section_description')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        FileUpload::make('cta_image')
                                            ->label('Gambar Background')
                                            ->image()
                                            ->directory('landing-page/cta')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Tombol Aksi')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('cta_primary_text')
                                                    ->label('Teks Tombol Utama')
                                                    ->required()
                                                    ->maxLength(30),
                                                Forms\Components\TextInput::make('cta_primary_link')
                                                    ->label('Link Tombol Utama')
                                                    ->url()
                                                    ->required(),
                                                Forms\Components\TextInput::make('cta_secondary_text')
                                                    ->label('Teks Tombol Sekunder')
                                                    ->required()
                                                    ->maxLength(30),
                                                Forms\Components\TextInput::make('cta_secondary_link')
                                                    ->label('Link Tombol Sekunder')
                                                    ->url()
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Kontak & Footer')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('Informasi Kontak')
                                    ->schema([
                                        Forms\Components\Textarea::make('contact_info.address')
                                            ->label('Alamat')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('contact_info.phone')
                                            ->label('Nomor Telepon')
                                            ->required()
                                            ->maxLength(20),
                                        Forms\Components\TextInput::make('contact_info.email')
                                            ->label('Email')
                                            ->email()
                                            ->required(),
                                        Forms\Components\Textarea::make('contact_info.map_embed')
                                            ->label('Embed Google Maps')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Media Sosial')
                                    ->schema([
                                        Forms\Components\TextInput::make('social_media.facebook')
                                            ->label('Facebook')
                                            ->url()
                                            ->prefix('https://facebook.com/'),
                                        Forms\Components\TextInput::make('social_media.instagram')
                                            ->label('Instagram')
                                            ->url()
                                            ->prefix('https://instagram.com/'),
                                        Forms\Components\TextInput::make('social_media.twitter')
                                            ->label('Twitter')
                                            ->url()
                                            ->prefix('https://twitter.com/'),
                                        Forms\Components\TextInput::make('social_media.youtube')
                                            ->label('YouTube')
                                            ->url()
                                            ->prefix('https://youtube.com/'),
                                        Forms\Components\TextInput::make('social_media.linkedin')
                                            ->label('LinkedIn')
                                            ->url()
                                            ->prefix('https://linkedin.com/'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('SEO & Pengaturan')
                            ->icon('heroicon-o-adjustments-horizontal')
                            ->schema([
                                Section::make('Pengaturan SEO')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(100),
                                        Forms\Components\Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->rows(2)
                                            ->maxLength(160),
                                        Forms\Components\Textarea::make('meta_keywords')
                                            ->label('Meta Keywords')
                                            ->rows(2),
                                    ]),

                                Section::make('Pengaturan Umum')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktifkan Halaman')
                                            ->default(true),
                                        Forms\Components\Select::make('theme_color')
                                            ->label('Warna Tema')
                                            ->options([
                                                'blue' => 'Biru',
                                                'green' => 'Hijau',
                                                'red' => 'Merah',
                                                'purple' => 'Ungu',
                                                'orange' => 'Oranye',
                                            ])
                                            ->default('blue'),
                                    ]),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->label('Judul Halaman')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d F Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        true => 'Aktif',
                        false => 'Nonaktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
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
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
