<?php

namespace App\Filament\Resources\VisionValues;

use App\Filament\Resources\VisionValues\Pages\CreateVisionValue;
use App\Filament\Resources\VisionValues\Pages\EditVisionValue;
use App\Filament\Resources\VisionValues\Pages\ListVisionValues;
use App\Filament\Resources\VisionValues\Schemas\VisionValueForm;
use App\Filament\Resources\VisionValues\Tables\VisionValuesTable;
use App\Models\VisionValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VisionValueResource extends Resource
{
    protected static ?string $model = VisionValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VisionValueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisionValuesTable::configure($table);
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
            'index' => ListVisionValues::route('/'),
            'create' => CreateVisionValue::route('/create'),
            'edit' => EditVisionValue::route('/{record}/edit'),
        ];
    }
}
