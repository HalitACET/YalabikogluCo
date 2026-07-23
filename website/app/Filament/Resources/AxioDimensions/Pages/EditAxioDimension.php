<?php

namespace App\Filament\Resources\AxioDimensions\Pages;

use App\Filament\Resources\AxioDimensions\AxioDimensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAxioDimension extends EditRecord
{
    protected static string $resource = AxioDimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
