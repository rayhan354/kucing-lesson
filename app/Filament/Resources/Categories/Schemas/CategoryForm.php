<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Category Name')
                    ->hint('Enter the name of the category')
                    ->helperText('This is the name of the category')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
