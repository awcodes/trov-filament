<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use App\Models\Post;
use Filament\Tables;
use App\Models\Media;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use App\Forms\Fields\MediaLibrary;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PostResource\Pages;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\SpatieTagsInput;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $label = 'Post';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof CreatePost) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        SlugInput::make('slug')
                            ->mode(fn ($livewire) => $livewire instanceof EditPost ? 'edit' : 'create')
                            ->required()
                            ->unique(Post::class, 'slug', fn ($record) => $record),
                        TextInput::make('seo_title')
                            ->required(),
                        Textarea::make('seo_description')
                            ->rows(3)
                            ->required(),
                        MediaLibrary::make('featured_image')->afterStateHydrated(function (MediaLibrary $component, Media $media, $state) {
                            $component->state($media->where('id', $state)->first());
                        })->dehydrateStateUsing(fn ($state) => $state['id']),
                        Builder::make('content')->blocks([
                            Builder\Block::make('heading')
                                ->schema([
                                    TextInput::make('content')
                                        ->label('Heading')
                                        ->required(),
                                    Select::make('level')
                                        ->options([
                                            'h1' => 'Heading 1',
                                            'h2' => 'Heading 2',
                                            'h3' => 'Heading 3',
                                            'h4' => 'Heading 4',
                                            'h5' => 'Heading 5',
                                            'h6' => 'Heading 6',
                                        ])
                                        ->required(),
                                ]),
                            Builder\Block::make('rich-text')
                                ->schema([
                                    RichEditor::make('content')
                                        ->label('Rich Text')
                                        ->disableToolbarButtons([
                                            'blockquote',
                                            'codeBlock',
                                            'attachFiles',
                                            'strike',
                                            'h2',
                                            'h3',
                                        ])
                                        ->required(),
                                ]),
                            Builder\Block::make('image')
                                ->schema([
                                    FileUpload::make('url')
                                        ->disk('images')
                                        ->label('Image')
                                        ->image()
                                        ->required(),
                                    TextInput::make('alt')
                                        ->label('Alt text')
                                        ->required(),
                                ]),
                        ]),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Card::make()
                    ->schema([
                        Select::make('status')
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
                        Toggle::make('indexable')
                            ->columnSpan(2),
                        BelongsToSelect::make('author_id')
                            ->relationship('author', 'name')
                            ->required()
                            ->columnSpan(2),
                        SpatieTagsInput::make('tags')
                            ->columnSpan(2),
                        Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (?Post $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (?Post $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columns(2)
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
                ImageColumn::make('featuredImage.thumb')->label('Thumb')->width(36)->height(36),
                TextColumn::make('title')->searchable()->sortable(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
