<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;

class ButtonBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'button';
    }

    public static function getLabel(): string
    {
        return 'Button';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the button')
            ->schema([
                TextInput::make('label')
                    ->required()
                    ->maxLength(255),

                TextInput::make('link')
                    ->required()
                    ->maxLength(255)
                    ->url(),

                Toggle::make('target')
                    ->label('Open link in a new window')
                    ->default(false),

                Grid::make()->schema([
                    Select::make('variant')
                        ->required()
                        ->default('primary')
                        ->options([
                            'primary' => 'Primary',
                            'secondary' => 'Secondary',
                            'outline' => 'Outline',
                            'ghost' => 'Ghost',
                        ]),

                    Select::make('size')
                        ->required()
                        ->default('default')
                        ->options([
                            'sm' => 'Small',
                            'default' => 'Medium',
                            'lg' => 'Large',
                            'xl' => 'Extra Large',
                        ]),
                ]),

                Grid::make()->schema([
                    Select::make('alignment')
                        ->required()
                        ->default('left')
                        ->options([
                            'left' => 'Left',
                            'center' => 'Center',
                            'right' => 'Right',
                        ]),

                    Select::make('width')
                        ->required()
                        ->default('auto')
                        ->options([
                            'auto' => 'Auto',
                            'full' => 'Full',
                        ])
                ]),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.button.preview', [
            'label' => $config['label'] ?? '',
            'link' => $config['link'] ?? '#',
            'variant' => $config['variant'] ?? 'primary',
            'size' => $config['size'] ?? 'default',
            'target' => $config['target'] ?? false,
            'alignment' => $config['alignment'] ?? 'left',
            'width' => $config['width'] ?? 'auto',
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.button.index', [
            'label' => $config['label'] ?? '',
            'link' => $config['link'] ?? '#',
            'variant' => $config['variant'] ?? 'primary',
            'size' => $config['size'] ?? 'default',
            'target' => $config['target'] ?? false,
            'alignment' => $config['alignment'] ?? 'left',
            'width' => $config['width'] ?? 'auto',
        ])->render();
    }
}
