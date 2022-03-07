<?php

namespace App\Filament\Resources;

use App\Models\Faq;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Forms\Fields\SlugInput;
use Filament\Resources\Resource;
use App\Filament\Resources\FaqResource\Pages;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $label = 'FAQ';

    protected static ?string $pluralLabel = 'FAQs';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-s-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->required()
                            ->reactive()
                            ->disableLabel()
                            ->placeholder('Question')
                            ->extraInputAttributes(['class' => 'text-2xl'])
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($livewire instanceof Pages\CreateFaq) {
                                    return $set('slug', Str::slug($state));
                                }
                            }),
                        SlugInput::make('slug')
                            ->mode(fn ($livewire) => $livewire instanceof Pages\EditFaq ? 'edit' : 'create')
                            ->baseUrl('/faqs/')
                            ->label('slug')
                            ->disableLabel()
                            ->required()
                            ->unique(Faq::class, 'slug', fn ($record) => $record),
                        Forms\Components\Section::make('Answer')
                            ->schema([
                                TinyEditor::make('answer')
                                    ->label('Rich Text')
                                    ->profile('custom')
                                    ->required(),
                            ]),
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
                                Forms\Components\SpatieTagsInput::make('tags')
                                    ->type('faqTag')
                                    ->columnspan(2),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Faq $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Faq $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                    ])
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
                Tables\Columns\TextColumn::make('question')->searchable()->sortable(),
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
            ])->defaultSort('updated_at', 'desc');
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
