<?php

namespace Trov\MediaLibrary\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Storage;
use Trov\MediaLibrary\Resources\MediaResource\Pages;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-s-photograph';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->hidden(function ($livewire) {
                                return $livewire instanceof Pages\EditMedia;
                            })
                            ->schema([
                                Forms\Components\Hidden::make('public_id'),
                                Forms\Components\Hidden::make('filename'),
                                Forms\Components\Hidden::make('ext'),
                                Forms\Components\Hidden::make('type'),
                                Forms\Components\Hidden::make('width'),
                                Forms\Components\Hidden::make('height'),
                                Forms\Components\Hidden::make('disk'),
                                Forms\Components\Hidden::make('size'),
                                Forms\Components\FileUpload::make('image_upload')
                                    ->maxFiles(1)
                                    ->maxWidth(5000)
                                    ->imageResizeTargetWidth('1920')
                                    ->preserveFilenames()
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'application/pdf'])
                                    ->saveUploadedFileUsing(function ($state, $set) {
                                        foreach ($state as $file) {
                                            $originalName = $file->getClientOriginalName();
                                            $basename = pathinfo($originalName, PATHINFO_FILENAME);
                                            $result = $file->storeOnCloudinaryAs(config('cloudinary.folder'), $basename);

                                            $set('public_id', $result->getPublicId());
                                            $set('filename', $basename);
                                            $set('ext', $result->getExtension());
                                            $set('type', $result->getFileType());
                                            $set('width', $result->getWidth());
                                            $set('height', $result->getHeight());
                                            $set('disk', 'cloudinary');
                                            $set('size', $result->getSize());
                                        }

                                        return '';
                                    }),
                            ]),
                        Forms\Components\Section::make('Preview')
                            ->hidden(function ($livewire) {
                                return $livewire instanceof Pages\CreateMedia;
                            })
                            ->schema([
                                Forms\Components\ViewField::make('preview')
                                    ->view('forms.components.media-preview')
                                    ->disableLabel()
                                    ->afterStateHydrated(function ($component, $state, $record) {
                                        $component->state($record);
                                    }),
                            ]),
                        Forms\Components\Section::make('Details')
                            ->schema([
                                Forms\Components\Placeholder::make('uploaded_on')
                                    ->label('Uploaded on')
                                    ->content(fn ($record): string => $record ? $record->created_at->format('F j, Y') : '-'),
                                Forms\Components\Placeholder::make('file_type')
                                    ->label('File Type')
                                    ->content(fn ($record): string => $record ? $record->type : '-'),
                                Forms\Components\Placeholder::make('file_size')
                                    ->label('File Size')
                                    ->content(fn ($record): string => $record ? $record->sizeForHumans() : '-'),
                                Forms\Components\Placeholder::make('dimensions')
                                    ->label('Dimensions')
                                    ->content(fn ($record): string => $record ? $record->width . ' x ' . $record->height : '-'),
                                Forms\Components\Placeholder::make('file_url')
                                    ->label('File URL')
                                    ->content(fn ($record): string => $record ? $record->url : '-')->columnSpan(['lg' => 4]),
                                Forms\Components\Placeholder::make('file_name')
                                    ->label('File Name')
                                    ->content(fn ($record): string => $record ? $record->filename . '.' . $record->ext : '-')->columnSpan(['lg' => 4]),
                            ])
                            ->columns(['lg' => 4]),
                    ])
                    ->columnSpan([
                        'sm' => 2
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Meta')
                            ->schema([
                                Forms\Components\TextInput::make('alt')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener" class="underline text-primary-500 hover:text-primary-600 focus:text-primary-600">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
                                Forms\Components\TextInput::make('title'),
                                Forms\Components\Textarea::make('caption')->rows(2),
                                Forms\Components\Textarea::make('description')->rows(2),
                            ])
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
                Tables\Columns\ImageColumn::make('thumb'),
                Tables\Columns\TextColumn::make('filename')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Date')->date()->sortable(),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
