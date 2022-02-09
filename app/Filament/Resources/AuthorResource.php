<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Author;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Group::make()->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('slug'),
                    ])->columns(2),
                    Group::make()->schema([
                        Forms\Components\RichEditor::make('bio')->disableToolbarButtons(['attachFiles', 'h2', 'h3', 'blockquote', 'codeBlock', 'strike']),
                    ]),
                    Group::make()->schema([
                        Forms\Components\TextInput::make('facebook_handle'),
                        Forms\Components\TextInput::make('twitter_handle'),
                        Forms\Components\TextInput::make('instagram_handle'),
                        Forms\Components\TextInput::make('linkedin_handle'),
                        Forms\Components\TextInput::make('youtube_handle'),
                        Forms\Components\TextInput::make('pinterest_handle'),
                    ])->columns(2)
                ])->columnSpan(2),
                Card::make()->schema([
                    Group::make()->schema([
                        Forms\Components\FileUpload::make('avatar')->disk('avatars')->image()->imagePreviewHeight('250')->maxFiles(1)->maxSize(512)
                    ])
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->disk('avatars'),
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
