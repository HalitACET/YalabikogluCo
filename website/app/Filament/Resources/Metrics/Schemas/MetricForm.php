<?php

namespace App\Filament\Resources\Metrics\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class MetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('value')
                    ->required(),
                Select::make('placement')
                    ->options([
                        'home' => 'Home',
                        'case_studies' => 'Case Studies',
                        'both' => 'Both',
                    ])
                    ->default('home')
                    ->required(),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Toggle::make('is_published')
                    ->default(false),
                Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Select::make('locale')
                            ->options(config('locales.supported'))
                            ->required(),
                        TextInput::make('label')
                            ->required(),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => config("locales.supported.{$state['locale']}") ?? null)
                    ->default([]),
            ]);
    }
}
