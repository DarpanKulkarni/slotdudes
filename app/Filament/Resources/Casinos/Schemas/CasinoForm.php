<?php

namespace App\Filament\Resources\Casinos\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CasinoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns([
                        'sm' => 1,
                        'lg' => 12,
                    ])
                    ->schema([
                        Section::make([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->unique('casinos', ignoreRecord: true),

                            TextInput::make('link')
                                ->label('Website link')
                                ->url()
                                ->required()
                                ->maxLength(255)
                                ->unique('casinos', ignoreRecord: true),

                            RichEditor::make('description')
                                ->maxLength(4294967000)
                                ->nullable()
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'link'],
                                    ['h2', 'h3'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['attachFiles', 'customBlocks'],
                                    ['undo', 'redo'],
                                ]),

                            Repeater::make('highlights')
                                ->addActionLabel('Add new highlight')
                                ->defaultItems(0)
                                ->minItems(0)
                                ->table([
                                    Repeater\TableColumn::make('Title')
                                        ->alignment(Alignment::Start),

                                    Repeater\TableColumn::make('Is Visible?')
                                        ->width('100px')
                                        ->alignment(Alignment::Center),
                                ])
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->distinct(),

                                    Toggle::make('is_visible'),
                                ])
                        ])->columnSpan([
                            'sm' => 1,
                            'lg' => 8,
                        ]),

                        Section::make([
                            SpatieMediaLibraryFileUpload::make('logo')
                                ->getUploadedFileNameForStorageUsing(
                                    function (TemporaryUploadedFile $file, callable $get) {
                                        return str($get('name'))->slug() . '.' . $file->getClientOriginalExtension();
                                    }
                                )
                                ->collection('logos')
                                ->disk('public')
                                ->panelAspectRatio('1')
                                ->image()
                                ->required()
                                ->maxFiles(1)
                                ->imagePreviewHeight('120')
                                ->downloadable(false)
                                ->openable(false),

                            Select::make('status')
                                ->native(false)
                                ->selectablePlaceholder(false)
                                ->rules(['required'])
                                ->markAsRequired()
                                ->options([
                                    'published' => 'Published',
                                    'draft' => 'Draft',
                                ])
                                ->default('published'),
                        ])->columnSpan([
                            'sm' => 1,
                            'lg' => 4,
                        ]),
                    ]),
            ])->columns(1);
    }
}
