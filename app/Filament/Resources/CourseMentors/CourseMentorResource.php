<?php

namespace App\Filament\Resources\CourseMentors;

use App\Filament\Resources\CourseMentors\Pages\CreateCourseMentor;
use App\Filament\Resources\CourseMentors\Pages\EditCourseMentor;
use App\Filament\Resources\CourseMentors\Pages\ListCourseMentors;
use App\Filament\Resources\CourseMentors\Pages\ViewCourseMentor;
use App\Filament\Resources\CourseMentors\Schemas\CourseMentorForm;
use App\Filament\Resources\CourseMentors\Schemas\CourseMentorInfolist;
use App\Filament\Resources\CourseMentors\Tables\CourseMentorsTable;
use App\Models\CourseMentor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseMentorResource extends Resource
{
    protected static ?string $model = CourseMentor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CourseMentorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseMentorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseMentorsTable::configure($table);
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
            'index' => ListCourseMentors::route('/'),
            'create' => CreateCourseMentor::route('/create'),
            'view' => ViewCourseMentor::route('/{record}'),
            'edit' => EditCourseMentor::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
