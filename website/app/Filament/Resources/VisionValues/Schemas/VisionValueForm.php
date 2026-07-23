<?php

namespace App\Filament\Resources\VisionValues\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class VisionValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Select::make('locale')
                            ->options(config('locales.supported'))
                            ->required(),
                        TextInput::make('title')
                            ->required(),
                        Textarea::make('description')
                            ->required(),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => config("locales.supported.{$state['locale']}") ?? null)
                    ->default([]),
            ]);
    }
}
