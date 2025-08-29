<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->helperText('Minimum 9 characters')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255),
                Select::make('occupation')
                    ->options([
                        'Developer' => 'Developer',
                        'Designer' => 'Designer',
                        'Marketer' => 'Marketer',
                        'Cyber Security' => 'Cyber Security',
                        'Project Manager' => 'Project Manager',
                    ])
                    ->required(),
                FileUpload::make('photo')
                    ->image()
                    ->directory('user-photos')  // Saves to storage/app/public/user-photos
                    ->preserveFilenames()
                    ->required(),
            ]);
    }
}
