<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\LandingPage;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use App\Forms\Components\BlockContent;
use App\Filament\Resources\LandingPageResource\Pages;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;

    protected static ?string $label = 'Page';

    protected static ?string $navigationGroup = 'Airport';

    protected static ?string $navigationIcon = 'heroicon-s-paper-airplane';

    protected static ?string $navigationLabel = 'Pages';


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
                                if ($livewire instanceof Pages\CreateLandingPage) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        SlugInput::make('slug')
                            ->mode(fn ($livewire) => $livewire instanceof Pages\EditLandingPage ? 'edit' : 'create')
                            ->baseUrl('/loans/')
                            ->label('slug')
                            ->disableLabel()
                            ->required()
                            ->unique(LandingPage::class, 'slug', fn ($record) => $record),
                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label('Title')
                                    ->required(),
                                Forms\Components\Textarea::make('seo_description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->required(),
                            ])
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
                                    ->content(fn (?LandingPage $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?LandingPage $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),

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
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }
}
