<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Author;
use Livewire\Component;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\AuthorResource\Pages;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $label = 'Author';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof Pages\CreateAuthor) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Author::class, 'slug', fn ($record) => $record),
                        TinyEditor::make('bio')
                            ->profile('custom')
                            ->columnSpan(['sm' => 2]),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\TextInput::make('facebook_handle'),
                            Forms\Components\TextInput::make('twitter_handle'),
                            Forms\Components\TextInput::make('instagram_handle'),
                            Forms\Components\TextInput::make('linkedin_handle'),
                            Forms\Components\TextInput::make('youtube_handle'),
                            Forms\Components\TextInput::make('pinterest_handle'),
                        ])->columns(2)->columnSpan(['sm' => 2])
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')->disk('avatars')->image()->imagePreviewHeight('250')->maxFiles(1)->maxSize(512)
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
