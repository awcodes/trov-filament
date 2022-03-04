<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use Trov\MediaLibrary\Models\Media;
use App\Forms\Components\BlockContent;
use App\Filament\Resources\PageResource\Pages;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $label = 'Page';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-s-document';

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
                                if ($livewire instanceof Pages\CreatePage) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\Section::make('Meta Information')
                            ->schema([
                                SlugInput::make('slug')
                                    ->mode(fn ($livewire) => $livewire instanceof Pages\EditPage ? 'edit' : 'create')
                                    ->required()
                                    ->unique(Page::class, 'slug', fn ($record) => $record),

                            ]),
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
                                Forms\Components\Select::make('status')
                                    ->default('draft')
                                    ->options([
                                        'draft' => 'Draft',
                                        'review' => 'In review',
                                        'published' => 'Published',
                                    ])
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\Toggle::make('has_chat')
                                    ->columnSpan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Page $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Page $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                Tables\Columns\ImageColumn::make('heroImage.thumb')->label('Hero'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'draft' => 'Draft',
                    'review' => 'In Review',
                    'published' => 'Published',
                ])->colors(['primary', 'danger' => 'draft', 'warning' => 'review', 'success' => 'published']),
                Tables\Columns\TextColumn::make('updated_at')->label('Last Updated')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'In Review',
                        'published' => 'Published',
                    ])
            ])->defaultSort('title', 'asc');
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
