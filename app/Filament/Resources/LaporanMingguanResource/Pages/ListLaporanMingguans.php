<?php

namespace App\Filament\Resources\LaporanMingguanResource\Pages;

use App\Filament\Resources\LaporanMingguanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListLaporanMingguans extends ListRecords
{
    protected static string $resource = LaporanMingguanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(fn () => static::$resource::canCreate()),
        ];
    }
}
