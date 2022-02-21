<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Author;
use Livewire\Component;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Route;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\Pages\CreateAuthor;
use App\Filament\Resources\AuthorResource\RelationManagers;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $label = 'Author';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof CreateAuthor) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->unique(Author::class, 'slug', fn ($record) => $record),
                        RichEditor::make('bio')
                            ->disableToolbarButtons(['attachFiles', 'h2', 'h3', 'blockquote', 'codeBlock', 'strike'])
                            ->columnSpan(['sm' => 2]),
                        Group::make()->schema([
                            TextInput::make('facebook_handle'),
                            TextInput::make('twitter_handle'),
                            TextInput::make('instagram_handle'),
                            TextInput::make('linkedin_handle'),
                            TextInput::make('youtube_handle'),
                            TextInput::make('pinterest_handle'),
                        ])->columns(2)->columnSpan(['sm' => 2])
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Card::make()
                    ->schema([
                        FileUpload::make('avatar')->disk('avatars')->image()->imagePreviewHeight('250')->maxFiles(1)->maxSize(512)
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->width(36)->height(36)->disk('avatars'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
