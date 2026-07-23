<?php

namespace App\Filament\Resources\AxioDimensions;

use App\Filament\Resources\AxioDimensions\Pages\CreateAxioDimension;
use App\Filament\Resources\AxioDimensions\Pages\EditAxioDimension;
use App\Filament\Resources\AxioDimensions\Pages\ListAxioDimensions;
use App\Filament\Resources\AxioDimensions\Schemas\AxioDimensionForm;
use App\Filament\Resources\AxioDimensions\Tables\AxioDimensionsTable;
use App\Models\AxioDimension;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AxioDimensionResource extends Resource
{
    protected static ?string $model = AxioDimension::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AxioDimensionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AxioDimensionsTable::configure($table);
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
            'index' => ListAxioDimensions::route('/'),
            'create' => CreateAxioDimension::route('/create'),
            'edit' => EditAxioDimension::route('/{record}/edit'),
        ];
    }
}
