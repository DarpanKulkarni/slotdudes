<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Storage;

class ImageBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'image';
    }

    public static function getLabel(): string
    {
        return 'Image';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the image')
            ->schema([
                FileUpload::make('image')
                    ->label('Upload Image')
                    ->image()
                    ->disk('public')
                    ->directory('content-images')
                    ->visibility('public')
                    ->required()
                    ->maxSize(5120),

                TextInput::make('alt')
                    ->label('Alt Text')
                    ->maxLength(255)
                    ->placeholder('Describe the image for accessibility'),

                Grid::make()->schema([
                    TextInput::make('width')
                        ->label('Width')
                        ->placeholder('auto')
                        ->helperText('e.g., 100px, 50%, auto')
                        ->default('auto'),

                    TextInput::make('height')
                        ->label('Height')
                        ->placeholder('auto')
                        ->helperText('e.g., 300px, auto')
                        ->default('auto'),
                ]),

                Select::make('alignment')
                    ->label('Alignment')
                    ->required()
                    ->default('left')
                    ->options([
                        'left' => 'Left',
                        'center' => 'Center',
                        'right' => 'Right',
                    ]),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        $imageUrl = isset($config['image']) ? Storage::disk('public')->url($config['image']) : '';

        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.image.preview', [
            'url' => $imageUrl,
            'alt' => $config['alt'] ?? '',
            'width' => $config['width'] ?? 'auto',
            'height' => $config['height'] ?? 'auto',
            'alignment' => $config['alignment'] ?? 'left',
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        $imageUrl = isset($config['image']) ? Storage::disk('public')->url($config['image']) : '';

        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.image.index', [
            'url' => $imageUrl,
            'alt' => $config['alt'] ?? '',
            'width' => $config['width'] ?? 'auto',
            'height' => $config['height'] ?? 'auto',
            'alignment' => $config['alignment'] ?? 'left',
        ])->render();
    }
}
