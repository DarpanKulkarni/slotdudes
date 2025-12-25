<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ButtonBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ImageBlock;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()
                ->columns([
                    'sm' => 1,
                    'lg' => 12,
                ])
                ->schema([
                    Section::make([
                        TextInput::make('title')
                            ->unique(ignoreRecord: true)
                            ->rules(['required', 'max:255'])
                            ->markAsRequired(),

                        RichEditor::make('content')
                            ->rules(['required'])
                            ->markAsRequired()
                            ->customBlocks([
                                ButtonBlock::class,
                                ImageBlock::class,
                            ])
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['attachFiles', 'customBlocks'],
                                ['undo', 'redo'],
                            ]),
                    ])->columnSpan([
                        'sm' => 1,
                        'lg' => 8,
                    ]),

                    Section::make([
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, $get) {
                                return str($get('title'))->slug() . '.' . $file->getClientOriginalExtension();
                            })
                            ->collection('featured-images')
                            ->disk('public')
                            ->panelAspectRatio('16:9')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675')
                            ->helperText('Recommended size: 1200x675'),

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

                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->unique(ignoreRecord: true)
                                    ->rules(['required', 'max:255'])
                                    ->markAsRequired(),
                            ])
                            ->createOptionAction(function (Action $action) {
                                return $action->modalWidth('md');
                            })
                            ->searchable(),
                    ])->columnSpan([
                        'sm' => 1,
                        'lg' => 4,
                    ]),
                ]),
        ])->columns(1);

    }
}
