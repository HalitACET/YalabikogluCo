<?php

namespace App\Filament\Resources\Disciplines\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class DisciplineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
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
                        TextInput::make('title')
                            ->required(),
                        Textarea::make('dek'),
                        Textarea::make('pull_quote'),
                        Repeater::make('areas_of_focus')
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                Textarea::make('description')
                                    ->required(),
                            ])
                            ->collapsible()
                            ->default([]),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => config("locales.supported.{$state['locale']}") ?? null)
                    ->default([]),
            ]);
    }
}
