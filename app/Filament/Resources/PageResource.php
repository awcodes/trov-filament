<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use App\Models\Media;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use App\Forms\Fields\MediaLibrary;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Forms\Components\BlockContent;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

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
                Group::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->disableLabel()
                            ->placeholder('Title')
                            ->extraInputAttributes(['class' => 'text-2xl'])
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof CreatePage) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        Section::make('Meta Information')
                            ->schema([

                                SlugInput::make('slug')
                                    ->mode(fn ($livewire) => $livewire instanceof EditPage ? 'edit' : 'create')
                                    ->required()
                                    ->unique(Page::class, 'slug', fn ($record) => $record),

                            ]),
                        Section::make('Hero')
                            ->schema([
                                MediaLibrary::make('hero_image')
                                    ->label('Image')
                                    ->afterStateHydrated(function (MediaLibrary $component, Media $media, $state) {
                                        $component->state($media->where('id', $state)->first());
                                    })
                                    ->dehydrateStateUsing(fn ($state) => $state['id']),
                                Textarea::make('hero_content')
                                    ->label('Call Out')
                                    ->rows(3),
                            ]),
                        Section::make('Page Content')
                            ->schema([
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
                                    ->options([
                                        'draft' => 'Draft',
                                        'review' => 'In review',
                                        'published' => 'Published',
                                    ])
                                    ->required()
                                    ->columnSpan(2),
                                Toggle::make('has_chat')
                                    ->columnSpan(2),
                                Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Page $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Page $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                ImageColumn::make('heroImage.thumb')->label('Hero'),
                TextColumn::make('title')->searchable()->sortable(),
                BadgeColumn::make('status')->enum([
                    'draft' => 'Draft',
                    'review' => 'In Review',
                    'published' => 'Published',
                ])->colors(['primary', 'danger' => 'draft', 'warning' => 'review', 'success' => 'published']),
                TextColumn::make('updated_at')->label('Last Updated')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
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
