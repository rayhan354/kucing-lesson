<?php

namespace App\Filament\Resources\CourseMentors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use App\Models\CourseMentor;
use App\Models\User;

class CourseMentorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Mentor')
                    ->options(function() {
                        return User::role('mentor')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('course_id')
                    ->relationship('course', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Toggle::make('is_active'),
                Textarea::make('about')
                    ->columnSpanFull(),
            ]);
    }
}
