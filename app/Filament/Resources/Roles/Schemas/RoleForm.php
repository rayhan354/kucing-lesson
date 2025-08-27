<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;

use Filament\Tables\Filters\TrashedFilter;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Role Name'),
                Select::make('guard_name')
                    ->required()
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                        // Add more guards if needed based on your app's config/auth.php
                    ])
                    ->label('Guard Name'),
                // Add more fields if needed, e.g., for permissions (requires relation setup)
            ]);
    }
}
