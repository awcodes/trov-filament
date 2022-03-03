<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Welcome;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use App\Forms\Components\BlockContent;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\WelcomeResource\Pages;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;
use App\Filament\Resources\WelcomeResource\RelationManagers;

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
                Group::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->disableLabel()
                            ->placeholder('Title')
                            ->extraInputAttributes(['class' => 'text-2xl']),
                        Section::make('Hero')
                            ->schema([
                                MediaLibrary::make('hero_image')
                                    ->label('Image'),
                                Textarea::make('hero_content')
                                    ->label('Call Out')
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                Toggle::make('has_chat')
                                    ->columnSpan(2),
                                Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Welcome $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Welcome $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                        Section::make('SEO')
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('Title')
                                    ->required(),
                                Textarea::make('seo_description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->required(),
                                Toggle::make('indexable'),
                            ])
                    ])
                    ->columnSpan([
                        'lg' => 1,
                    ]),
                Section::make('Page Content')
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
                ImageColumn::make('heroImage.thumb')->label('Hero'),
                TextColumn::make('title'),
                TextColumn::make('updated_at')->label('Last Updated')->date(),
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
