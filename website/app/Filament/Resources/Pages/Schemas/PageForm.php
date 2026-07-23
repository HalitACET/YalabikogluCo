<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('slug')
                    ->options([
                        'home' => 'Home',
                        'disciplines' => 'Disciplines',
                        'axio-method' => 'Axio Method',
                        'case-studies' => 'Case Studies',
                        'vision' => 'Vision',
                        'contact' => 'Contact',
                        'privacy' => 'Privacy',
                    ])
                    ->unique(ignoreRecord: true)
                    ->required(),
                Repeater::make('translations')
                    ->relationship('translations')
                    ->schema([
                        Select::make('locale')
                            ->options(config('locales.supported'))
                            ->required(),
                        TextInput::make('meta_title'),
                        Textarea::make('meta_description'),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => config("locales.supported.{$state['locale']}") ?? null)
                    ->default([]),
            ]);
    }
}
