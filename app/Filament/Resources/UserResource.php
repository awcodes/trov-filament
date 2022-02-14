<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\BelongsToManyCheckboxList;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms\Components\Radio;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Users';

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->required()->email()->unique(User::class, 'email', fn ($record) => $record),
                        BelongsToManyCheckboxList::make('roles')->relationship('roles', 'name')->columns(4),
                        BelongsToManyCheckboxList::make('permissions')->relationship('permissions', 'name')->columns(4)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email'),
            ])
            ->filters([
                //
            ])->defaultSort('name', 'asc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
