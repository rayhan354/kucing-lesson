<?php

namespace App\Filament\Resources\SectionContents;

use App\Filament\Resources\SectionContents\Pages\CreateSectionContent;
use App\Filament\Resources\SectionContents\Pages\EditSectionContent;
use App\Filament\Resources\SectionContents\Pages\ListSectionContents;
use App\Filament\Resources\SectionContents\Pages\ViewSectionContent;
use App\Filament\Resources\SectionContents\Schemas\SectionContentForm;
use App\Filament\Resources\SectionContents\Schemas\SectionContentInfolist;
use App\Filament\Resources\SectionContents\Tables\SectionContentsTable;
use App\Models\SectionContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionContentResource extends Resource
{
    protected static ?string $model = SectionContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SectionContentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SectionContentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SectionContentsTable::configure($table);
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
            'index' => ListSectionContents::route('/'),
            'create' => CreateSectionContent::route('/create'),
            'view' => ViewSectionContent::route('/{record}'),
            'edit' => EditSectionContent::route('/{record}/edit'),
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
