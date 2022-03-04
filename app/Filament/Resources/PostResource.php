<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use Trov\MediaLibrary\Models\Media;
use Filament\Tables\Filters\Filter;
use App\Forms\Components\BlockContent;
use App\Filament\Resources\PostResource\Pages;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $label = 'Post';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = "Blog Posts";

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

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
                                if ($livewire instanceof Pages\CreatePost) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\Section::make('Meta Information')
                            ->schema([
                                SlugInput::make('slug')
                                    ->mode(fn ($livewire) => $livewire instanceof Pages\EditPost ? 'edit' : 'create')
                                    ->required()
                                    ->unique(Post::class, 'slug', fn ($record) => $record),
                            ]),
                        Forms\Components\Section::make('Post Content')
                            ->schema([
                                MediaLibrary::make('featured_image')
                                    ->label('Featured Image'),
                                BlockContent::make('content')
                            ])
                    ])
                    ->columnSpan([
                        'sm' => 2
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
                                Forms\Components\BelongsToSelect::make('author_id')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\SpatieTagsInput::make('tags')
                                    ->type('postTag')
                                    ->columnSpan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Post $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Post $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                                Forms\Components\Toggle::make('indexable')
                            ])
                    ])
            ])
            ->columns([
                'sm' => 3,
                'lg' => null
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featuredImage.thumb')->label('Thumb')->width(36)->height(36),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
