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
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Forms\Components\BlockContent;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\LandingPageResource\Pages;
use App\Filament\Resources\LandingPageResource\RelationManagers;
use App\Filament\Resources\LandingPageResource\Pages\EditLandingPage;
use App\Filament\Resources\LandingPageResource\Pages\ListLandingPages;
use App\Filament\Resources\LandingPageResource\Pages\CreateLandingPage;

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
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof CreateLandingPage) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        SlugInput::make('slug')
                            ->mode(fn ($livewire) => $livewire instanceof EditLandingPage ? 'edit' : 'create')
                            ->required()
                            ->unique(LandingPage::class, 'slug', fn ($record) => $record),
                        TextInput::make('seo_title')
                            ->required(),
                        Textarea::make('seo_description')
                            ->rows(3)
                            ->required(),
                        BlockContent::make('content')
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
                        Toggle::make('indexable')
                            ->columnSpan(2),
                        Toggle::make('has_chat')
                            ->columnSpan(2),
                        Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (?LandingPage $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (?LandingPage $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }
}
