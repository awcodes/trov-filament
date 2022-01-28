<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Group::make()->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('slug'),
                    ])->columns(2),
                    Group::make()->schema([
                        Forms\Components\Textarea::make('bio')->rows(5),
                    ]),
                    Group::make()->schema([
                        Forms\Components\TextInput::make('facebook')->url(),
                        Forms\Components\TextInput::make('twitter')->url(),
                        Forms\Components\TextInput::make('instagram')->url(),
                        Forms\Components\TextInput::make('linkedin')->url(),
                        Forms\Components\TextInput::make('youtube')->url(),
                        Forms\Components\TextInput::make('pinterest')->url(),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Forms\Components\FileUpload::make('avatar')->image()->imagePreviewHeight('250')->maxFiles(1)->maxSize(512)
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
