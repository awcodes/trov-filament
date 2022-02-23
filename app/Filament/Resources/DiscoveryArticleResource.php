<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Media;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DiscoveryTopic;
use App\Forms\Fields\SlugInput;
use App\Models\DiscoveryArticle;
use Filament\Resources\Resource;
use App\Forms\Components\Section;
use AWCodes\FilamentMediaLibrary\Components\MediaLibrary;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use App\Forms\Components\BlockContent;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\DiscoveryArticleResource\Pages;
use App\Filament\Resources\DiscoveryArticleResource\RelationManagers;
use App\Filament\Resources\DiscoveryArticleResource\Pages\EditDiscoveryArticle;
use App\Filament\Resources\DiscoveryArticleResource\Pages\ListDiscoveryArticles;
use App\Filament\Resources\DiscoveryArticleResource\Pages\CreateDiscoveryArticle;

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
                Group::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->disableLabel()
                            ->placeholder('Title')
                            ->extraInputAttributes(['class' => 'text-2xl'])
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof CreateDiscoveryArticle) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Section::make('Meta Information')
                            ->schema([
                                SlugInput::make('slug')
                                    ->mode(fn ($livewire) => $livewire instanceof EditDiscoveryArticle ? 'edit' : 'create')
                                    ->required()
                                    ->unique(DiscoveryArticle::class, 'slug', fn ($record) => $record),
                            ]),
                        Section::make('Page Content')
                            ->schema([
                                MediaLibrary::make('featured_image')
                                    ->afterStateHydrated(function (MediaLibrary $component, Media $media, $state) {
                                        $component->state($media->where('id', $state)->first());
                                    })
                                    ->dehydrateStateUsing(fn ($state) => $state['id']),
                                BlockContent::make('content')
                            ])
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                Select::make('status')
                                    ->default('draft')
                                    ->options([
                                        'draft' => 'Draft',
                                        'review' => 'In review',
                                        'published' => 'Published',
                                    ])
                                    ->required()
                                    ->columnSpan(2),
                                DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->withoutSeconds()
                                    ->columnSpan(2),
                                BelongsToSelect::make('discovery_topic_id')
                                    ->relationship('topic', 'title')
                                    ->required()
                                    ->columnSpan(2),
                                BelongsToSelect::make('author_id')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->columnSpan(2),
                                Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?DiscoveryArticle $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?DiscoveryArticle $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                ImageColumn::make('featuredImage.thumb')->label('Thumb')->width(36)->height(36),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('topic.title')->searchable()->sortable(),
                BadgeColumn::make('status')->enum([
                    'draft' => 'Draft',
                    'review' => 'In Review',
                    'published' => 'Published',
                ])->colors(['primary', 'danger' => 'draft', 'warning' => 'review', 'success' => 'published']),
                TextColumn::make('published_at')->label('Published At')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'In Review',
                        'published' => 'Published',
                    ]),
                SelectFilter::make('discovery_topic_id')->label('Topic')->relationship('topic', 'title'),
                SelectFilter::make('author_id')->label('Author')->relationship('author', 'name'),
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
