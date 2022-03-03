<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Builder\Block;
use App\Forms\Fields\RadioButton;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Trov\MediaLibrary\Components\Fields\MediaLibrary;

class BlockContent extends Component
{
    protected string $view = 'forms.components.block-content';

    public static function make(): static
    {
        return (new static())->schema([
            Repeater::make('content')
                ->label('Sections')
                ->createItemButtonLabel('Add Section')
                ->schema([
                    Toggle::make('full_width')->default(false)->reactive(),
                    Select::make('bg_color')->label('Background Color')->hidden(fn (Closure $get) => $get('full_width') === false)->options([
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'tertiary' => 'Tertiary',
                        'accent' => 'Accent',
                        'gray' => 'Gray',
                    ]),
                    Builder::make('blocks')
                        ->label('Blocks')
                        ->createItemButtonLabel('Add Block')
                        ->blocks([
                            Block::make('hero')
                                ->schema([
                                    MediaLibrary::make('image')
                                        ->label('Image'),
                                    Textarea::make('content')
                                        ->label('Call to Action'),
                                ]),
                            Block::make('heading')
                                ->schema([
                                    TextInput::make('content')
                                        ->label('Text')
                                        ->required()
                                        ->columnSpan([
                                            'sm' => 2,
                                            'xl' => 1,
                                        ]),
                                    RadioButton::make('level')
                                        ->options([
                                            'h1' => '1',
                                            'h2' => '2',
                                            'h3' => '3',
                                            'h4' => '4',
                                            'h5' => '5',
                                            'h6' => '6',
                                        ])
                                        ->required()
                                        ->columnSpan([
                                            'sm' => 2,
                                            'lg' => 1,
                                            'xl' => null
                                        ]),
                                ])->columns([
                                    'lg' => 2
                                ]),
                            Block::make('rich-text')
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
                            Block::make('grid')
                                ->schema([
                                    Radio::make('columns')
                                        ->options([
                                            '1' => '1',
                                            '2' => '2',
                                            '3' => '3',
                                            '4' => '4',
                                            '5' => '5',
                                            '6' => '6',
                                            '7' => '7',
                                            '8' => '8',
                                            '9' => '9',
                                            '10' => '10',
                                            '11' => '11',
                                            '12' => '12',
                                        ])
                                        ->inline()
                                        ->required(),
                                    Repeater::make('items')
                                        ->label('Items')
                                        ->schema([
                                            TextInput::make('name')->required(),
                                            Select::make('role')
                                                ->options([
                                                    'member' => 'Member',
                                                    'administrator' => 'Administrator',
                                                    'owner' => 'Owner',
                                                ])
                                                ->required(),
                                        ])
                                        ->columns(2)
                                ]),
                            Block::make('image')
                                ->schema([
                                    MediaLibrary::make('image')
                                        ->label('Image'),
                                ]),
                            Block::make('image-left')
                                ->label('Image with Text on Right')
                                ->schema([
                                    MediaLibrary::make('image')
                                        ->label('Image')
                                        ->columnSpan(1),
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
                                        ->required()
                                        ->columnSpan(2),
                                ])->columns(['sm' => 3]),
                            Block::make('image-right')
                                ->label('Image with Text on Right')
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
                                        ->required()
                                        ->columnSpan(2),
                                    MediaLibrary::make('image')
                                        ->label('Image')
                                        ->columnSpan(1),
                                ])->columns(['sm' => 3]),
                            Block::make('infographic')
                                ->schema([
                                    MediaLibrary::make('image')
                                        ->label('Image'),
                                    Textarea::make('transcript')
                                        ->label('Transcript'),
                                ]),
                        ]),
                ])
        ]);
    }
}
