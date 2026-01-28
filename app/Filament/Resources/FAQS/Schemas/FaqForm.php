<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([
                    TextInput::make('question')
                        ->unique(ignoreRecord: true)
                        ->rules(['required', 'max:255'])
                        ->markAsRequired(),

                    RichEditor::make('answer')
                        ->rules(['required'])
                        ->markAsRequired()
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike', 'link'],
                            ['h2', 'h3'],
                            ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                            ['attachFiles', 'customBlocks'],
                            ['undo', 'redo'],
                        ]),
                ])
            ]);
    }
}
