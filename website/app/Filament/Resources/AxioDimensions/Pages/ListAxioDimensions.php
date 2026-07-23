<?php

namespace App\Filament\Resources\AxioDimensions\Pages;

use App\Filament\Resources\AxioDimensions\AxioDimensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAxioDimensions extends ListRecords
{
    protected static string $resource = AxioDimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
