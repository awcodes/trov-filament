<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DiscoveryTopic;
use App\Forms\Fields\SlugInput;
use App\Models\DiscoveryArticle;
use Filament\Resources\Resource;
use Trov\MediaLibrary\Models\Media;
use App\Forms\Components\BlockContent;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;
use App\Filament\Resources\DiscoveryArticleResource\Pages;

class DiscoveryArticleResource extends Resource
{
    protected static ?string $model = DiscoveryArticle::class;

    protected static ?string $label = 'Article';

    protected static ?string $navigationLabel = 'Articles';

    protected static ?string $navigationGroup = 'Discovery Center';

    protected static ?string $navigationIcon = 'heroicon-s-academic-cap';

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
                                if ($livewire instanceof Pages\CreateDiscoveryArticle) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\Section::make('Meta Information')
                            ->schema([
                                SlugInput::make('slug')
                                    ->mode(fn ($livewire) => $livewire instanceof Pages\EditDiscoveryArticle ? 'edit' : 'create')
                                    ->required()
                                    ->unique(DiscoveryArticle::class, 'slug', fn ($record) => $record),
                            ]),
                        Forms\Components\Section::make('Page Content')
                            ->schema([
                                MediaLibrary::make('featured_image')
                                    ->label('Featured Image'),
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
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->withoutSeconds()
                                    ->columnSpan(2),
                                Forms\Components\BelongsToSelect::make('discovery_topic_id')
                                    ->relationship('topic', 'title')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\BelongsToSelect::make('author_id')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?DiscoveryArticle $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?DiscoveryArticle $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                Tables\Columns\ImageColumn::make('featuredImage.thumb')->label('Thumb')->width(36)->height(36),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('topic.title')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'draft' => 'Draft',
                    'review' => 'In Review',
                    'published' => 'Published',
                ])->colors(['primary', 'danger' => 'draft', 'warning' => 'review', 'success' => 'published']),
                Tables\Columns\TextColumn::make('published_at')->label('Published At')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'In Review',
                        'published' => 'Published',
                    ]),
                Tables\Filters\SelectFilter::make('discovery_topic_id')->label('Topic')->relationship('topic', 'title'),
                Tables\Filters\SelectFilter::make('author_id')->label('Author')->relationship('author', 'name'),
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
            'index' => Pages\ListDiscoveryArticles::route('/'),
            'create' => Pages\CreateDiscoveryArticle::route('/create'),
            'edit' => Pages\EditDiscoveryArticle::route('/{record}/edit'),
        ];
    }
}
