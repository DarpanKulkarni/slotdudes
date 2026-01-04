<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ButtonBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ImageBlock;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PageForm
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
                            ->markAsRequired()
                            ->lazy()
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', str($state)->slug)),

                        TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->rules(['required', 'max:255'])
                            ->markAsRequired()
                            ->readOnly(fn(Get $get) => !$get('editing_slug'))
                            ->helperText('Ignore slug in case of home page.')
                            ->hintAction(
                                Action::make('edit_slug')
                                    ->label('Edit slug')
                                    ->color('primary')
                                    ->action(function (Set $set) {
                                        $set('editing_slug', true);
                                    })
                            ),

                        RichEditor::make('content')
                            ->rules(fn(Get $get) => $get('is_blog_page') || $get('is_home_page') || $get('is_slot_reviews_page') ? [] : ['required'])
                            ->markAsRequired(fn(Get $get) => !$get('is_blog_page') || !$get('is_home_page') || !$get('is_slot_reviews_page'))
                            ->hidden(fn(Get $get) => $get('is_blog_page') || $get('is_home_page') || $get('is_slot_reviews_page'))
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['alignStart', 'alignCenter', 'alignEnd'],
                                ['h2', 'h3'],
                                ['blockquote', 'codeBlock'],
                                ['bulletList', 'orderedList'],
                                ['attachFiles', 'customBlocks'],
                                ['undo', 'redo'],
                            ])
                    ])->columnSpan([
                        'sm' => 1,
                        'lg' => 8,
                    ]),

                    Section::make([
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

                        Toggle::make('is_home_page')
                            ->default(false)
                            ->disabled(fn(Get $get) => $get('is_blog_page') || $get('is_slot_reviews_page'))
                            ->lazy(),

                        Toggle::make('is_blog_page')
                            ->default(false)
                            ->disabled(fn(Get $get) => $get('is_home_page') || $get('is_slot_reviews_page'))
                            ->lazy(),

                        Toggle::make('is_slot_reviews_page')
                            ->default(false)
                            ->disabled(fn(Get $get) => $get('is_home_page') || $get('is_blog_page'))
                            ->lazy(),

                        Toggle::make('show_in_menu')
                            ->default(false)
                    ])->columnSpan([
                        'sm' => 1,
                        'lg' => 4,
                    ]),
                ]),
        ])->columns(1);
    }
}
