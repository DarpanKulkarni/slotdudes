<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use UnitEnum;

class ManageSiteSettings extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel = 'Site Settings';
    protected static string | \UnitEnum | null $navigationGroup = "Settings";
    protected static ?int $navigationSort = 2;
    protected static string $settings = SiteSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Settings')
                    ->schema([
                        TextInput::make('siteTitle')
                            ->rules(['required', 'max:255'])
                            ->markAsRequired()
                            ->default(config('app.name')),

                        Textarea::make('siteDescription')
                            ->rules(['required', 'max:500'])
                            ->markAsRequired()
                            ->rows(3)
                            ->default(''),

                        TextInput::make('casinosPerPage')
                            ->numeric()
                            ->rules(['required', 'numeric', 'min:1', 'max:100'])
                            ->markAsRequired()
                            ->helperText('Number of casino logos to show per page.'),

                        TextInput::make('postsPerPage')
                            ->numeric()
                            ->rules(['required', 'numeric', 'min:1', 'max:100'])
                            ->markAsRequired()
                            ->helperText('Number of blog posts to show per page.'),
                    ])
                    ->columns(1),

                Section::make('Branding')
                    ->schema([
                        Grid::make()->schema([
                            FileUpload::make('siteLogo')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                    return 'site-logo.' . $file->getClientOriginalExtension();
                                })
                                ->disk('public')
                                ->image()
                                ->imageResizeMode('contain')
                                ->imageResizeTargetWidth('400')
                                ->imageResizeTargetHeight('200')
                                ->helperText('Leave empty to use default logo.'),

                            FileUpload::make('siteFavicon')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                    return 'favicon.' . $file->getClientOriginalExtension();
                                })
                                ->disk('public')
                                ->image()
                                ->imageResizeMode('contain')
                                ->imageResizeTargetWidth('32')
                                ->imageResizeTargetHeight('32')
                                ->helperText('Leave empty to use default favicon.'),

                            FileUpload::make('metaImage')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                    return 'meta-image.' . $file->getClientOriginalExtension();
                                })
                                ->disk('public')
                                ->image()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->imageResizeTargetWidth('1200')
                                ->imageResizeTargetHeight('675')
                                ->helperText('Leave empty to use default image. Recommended size: 1200x675'),

                        ])->columns(),
                    ])
                    ->columns(1),

                Section::make('Footer Settings')
                    ->schema([
                        RichEditor::make('footerText')
                            ->rules(['required'])
                            ->markAsRequired()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['attachFiles', 'customBlocks'],
                                ['undo', 'redo'],
                            ]),

                        RichEditor::make('copyrightText')
                            ->rules(['required'])
                            ->markAsRequired()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'link'],
                            ])
                            ->default(function($get) {
                                return '<p>Copyright &copy;'. date('Y') . $get('site_title') . ' / All Rights Reserved</p>';
                            }),

                        Textarea::make('footerScripts')
                            ->rows(8)
                            ->helperText('Include your scripts in <script></script> tags'),
                    ])
                    ->columns(1),
            ])->columns(1);
    }
}
