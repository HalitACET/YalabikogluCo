<?php

namespace App\Filament\Resources\VisionValues\Pages;

use App\Filament\Resources\VisionValues\VisionValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVisionValue extends EditRecord
{
    protected static string $resource = VisionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
