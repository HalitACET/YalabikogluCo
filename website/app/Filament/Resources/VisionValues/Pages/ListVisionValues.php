<?php

namespace App\Filament\Resources\VisionValues\Pages;

use App\Filament\Resources\VisionValues\VisionValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisionValues extends ListRecords
{
    protected static string $resource = VisionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
