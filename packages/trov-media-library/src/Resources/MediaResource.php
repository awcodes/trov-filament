<?php

namespace Trov\MediaLibrary\Resources;

use Filament\Forms;
use Filament\Tables;
use Trov\MediaLibrary\Models\Media;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Trov\MediaLibrary\Resources\MediaResource\Pages;
use Trov\MediaLibrary\Resources\MediaResource\Pages\EditMedia;
use Trov\MediaLibrary\Resources\MediaResource\Pages\CreateMedia;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-s-photograph';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Group::make()
                            ->hidden(function ($livewire) {
                                return $livewire instanceof EditMedia;
                            })
                            ->schema([
                                Hidden::make('public_id'),
                                Hidden::make('filename'),
                                Hidden::make('ext'),
                                Hidden::make('type'),
                                Hidden::make('width'),
                                Hidden::make('height'),
                                Hidden::make('disk'),
                                Hidden::make('size'),
                                FileUpload::make('image_upload')
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
                        ViewField::make('preview')
                            ->hidden(function ($livewire) {
                                return $livewire instanceof CreateMedia;
                            })
                            ->view('forms.components.media-preview')
                            ->afterStateHydrated(function ($component, $state, $record) {
                                $component->state($record);
                            }),
                        Section::make('Details')
                            ->schema([
                                Placeholder::make('uploaded_on')
                                    ->label('Uploaded on')
                                    ->content(fn ($record): string => $record ? $record->created_at->format('F j, Y') : '-'),
                                Placeholder::make('file_type')
                                    ->label('File Type')
                                    ->content(fn ($record): string => $record ? $record->type : '-'),
                                Placeholder::make('file_size')
                                    ->label('File Size')
                                    ->content(fn ($record): string => $record ? $record->sizeForHumans() : '-'),
                                Placeholder::make('dimensions')
                                    ->label('Dimensions')
                                    ->content(fn ($record): string => $record ? $record->width . ' x ' . $record->height : '-'),
                                Placeholder::make('file_url')
                                    ->label('File URL')
                                    ->content(fn ($record): string => $record ? $record->url : '-')->columnSpan(['lg' => 4]),
                                Placeholder::make('file_name')
                                    ->label('File Name')
                                    ->content(fn ($record): string => $record ? $record->filename . '.' . $record->ext : '-')->columnSpan(['lg' => 4]),
                            ])
                            ->columns(['lg' => 4]),
                    ])
                    ->columnSpan([
                        'sm' => 2
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                TextInput::make('alt')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener" class="underline">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
                                TextInput::make('title'),
                                Textarea::make('caption'),
                                Textarea::make('description'),
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
                ImageColumn::make('thumb'),
                TextColumn::make('filename')->searchable()->sortable(),
                TextColumn::make('updated_at')->label('Date')->date()->sortable(),
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
