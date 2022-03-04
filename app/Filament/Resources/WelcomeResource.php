<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Welcome;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Forms\Components\BlockContent;
use App\Filament\Resources\WelcomeResource\Pages;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;

class WelcomeResource extends Resource
{
    protected static ?string $model = Welcome::class;

    protected static ?string $label = 'Welcome Page';

    protected static ?string $pluralLabel = 'Welcome Page';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-s-hand';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->disableLabel()
                            ->placeholder('Title')
                            ->extraInputAttributes(['class' => 'text-2xl']),
                        Forms\Components\Section::make('Hero')
                            ->schema([
                                MediaLibrary::make('hero_image')
                                    ->label('Image'),
                                Forms\Components\Textarea::make('hero_content')
                                    ->label('Call Out')
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Details')
                            ->schema([
                                Forms\Components\Toggle::make('has_chat')
                                    ->columnSpan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Welcome $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Welcome $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label('Title')
                                    ->required(),
                                Forms\Components\Textarea::make('seo_description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->required(),
                                Forms\Components\Toggle::make('indexable'),
                            ])
                    ])
                    ->columnSpan([
                        'lg' => 1,
                    ]),
                Forms\Components\Section::make('Page Content')
                    ->schema([
                        BlockContent::make('content')
                    ])->columnSpan([
                        'lg' => 3,
                    ])
            ])
            ->columns([
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('heroImage.thumb')
                    ->label('Hero'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->date(),
            ])
            ->filters([]);
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWelcomes::route('/'),
            'edit' => Pages\EditWelcome::route('/{record}/edit'),
        ];
    }
}
