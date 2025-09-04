<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Details')
                ->components([
                    TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->required()
                    ->image(),
                ]),
                Fieldset::make('Additional')
                ->schema([
                    Repeater::make('benefits')
                        ->relationship('benefits')
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                        ]),
                    Textarea::make('about')
                        ->required()
                        ->columnSpanFull(),
                    Toggle::make('is_popular')
                        ->required(),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    ])
            ]);
    }
}
