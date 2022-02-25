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
use Trov\MediaLibrary\Components\Fields\MediaLibrary;

class BlockContent extends Component
{
    protected string $view = 'forms.components.block-content';

    public static function make(): static
    {
        return (new static())->schema([
            Builder::make('content')
                ->label('Blocks')
                ->blocks([
                    Block::make('heading')
                        ->schema([
                            TextInput::make('content')
                                ->label('Heading')
                                ->required(),
                            Radio::make('level')
                                ->options([
                                    'h1' => '1',
                                    'h2' => '2',
                                    'h3' => '3',
                                    'h4' => '4',
                                    'h5' => '5',
                                    'h6' => '6',
                                ])
                                ->inline()
                                ->required(),
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
                ]),
        ]);
    }
}
