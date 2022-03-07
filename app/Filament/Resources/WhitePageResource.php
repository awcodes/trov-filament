<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WhitePage;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use App\Forms\Components\BlockContent;
use App\Filament\Resources\WhitePageResource\Pages;

class WhitePageResource extends Resource
{
    protected static ?string $model = WhitePage::class;

    protected static ?string $label = 'White Page';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-s-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->disableLabel()
                            ->placeholder('Title')
                            ->extraInputAttributes(['class' => 'text-2xl'])
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof Pages\CreateWhitePage) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        SlugInput::make('slug')
                            ->mode(fn ($livewire) => $livewire instanceof Pages\EditWhitePage ? 'edit' : 'create')
                            ->baseUrl(function ($record) {
                                return '/' . $record->type . 's/';
                            })
                            ->label('slug')
                            ->disableLabel()
                            ->required()
                            ->unique(WhitePage::class, 'slug', fn ($record) => $record),
                        Forms\Components\Section::make('Page Content')
                            ->schema([
                                BlockContent::make('content')
                            ])
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Details')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->default('draft')
                                    ->options([
                                        'draft' => 'Draft',
                                        'review' => 'In review',
                                        'published' => 'Published',
                                    ])
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\Select::make('type')
                                    ->default('article')
                                    ->options([
                                        'article' => 'Article',
                                        'resource' => 'Resource',
                                    ])->required()
                                    ->columnSpan(2),
                                Forms\Components\BelongsToSelect::make('author_id')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->withoutSeconds()
                                    ->columnSpan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?WhitePage $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?WhitePage $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->required(),
                                Forms\Components\Textarea::make('seo_description')
                                    ->rows(3)
                                    ->required(),
                                Forms\Components\Toggle::make('indexable'),
                            ]),
                    ]),
            ])->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'draft' => 'Draft',
                    'review' => 'In Review',
                    'published' => 'Published',
                ])->colors(['primary', 'danger' => 'draft', 'warning' => 'review', 'success' => 'published']),
                Tables\Columns\TextColumn::make('type')->enum([
                    'article' => 'Article',
                    'resource' => 'Resource',
                ]),
                Tables\Columns\TextColumn::make('published_at')->label('Published At')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'In Review',
                        'published' => 'Published',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'article' => 'Article',
                        'resource' => 'Resource',
                    ]),
            ])->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListWhitePages::route('/'),
            'create' => Pages\CreateWhitePage::route('/create'),
            'edit' => Pages\EditWhitePage::route('/{record}/edit'),
        ];
    }
}
