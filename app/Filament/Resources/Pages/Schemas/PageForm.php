<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Get $get, Set $set): void {
                                if (blank($get('slug'))) {
                                    $set('slug', Str::slug($state ?? ''));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->validationMessages(['regex' => 'Slug may only contain lowercase letters, numbers, and hyphens. No slashes or spaces.'])
                            ->helperText('Lowercase letters, numbers and hyphens only — e.g. about-us'),
                        Toggle::make('is_home')
                            ->label('Set as homepage')
                            ->helperText('Only one page can be the homepage. Enabling this will remove it from any other page.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Content')
                    ->schema([
                        Builder::make('content')
                            ->blocks(self::topLevelBlocks())
                            ->columnSpanFull()
                            ->collapsed()
                            ->blockNumbers(false),
                    ]),
            ]);
    }

    /**
     * @return array<Block>
     */
    protected static function topLevelBlocks(): array
    {
        return [
            ...self::baseBlocks(),
            Block::make('columns')
                ->label('Columns')
                ->schema([
                    Select::make('count')
                        ->label('Columns count')
                        ->options([
                            2 => '2 columns',
                            3 => '3 columns',
                            4 => '4 columns',
                        ])
                        ->default(2)
                        ->required()
                        ->native(false),
                    Builder::make('column_1')
                        ->label('Column 1')
                        ->blocks(self::baseBlocks())
                        ->required()
                        ->collapsed(),
                    Builder::make('column_2')
                        ->label('Column 2')
                        ->blocks(self::baseBlocks())
                        ->required()
                        ->collapsed(),
                    Builder::make('column_3')
                        ->label('Column 3')
                        ->blocks(self::baseBlocks())
                        ->visible(fn (Get $get): bool => (int) ($get('count') ?? 2) >= 3)
                        ->collapsed(),
                    Builder::make('column_4')
                        ->label('Column 4')
                        ->blocks(self::baseBlocks())
                        ->visible(fn (Get $get): bool => (int) ($get('count') ?? 2) >= 4)
                        ->collapsed(),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<Block>
     */
    protected static function baseBlocks(): array
    {
        return [
            Block::make('heading')
                ->label('Heading')
                ->schema([
                    Select::make('level')
                        ->label('Heading level')
                        ->options([
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'h5' => 'H5',
                            'h6' => 'H6',
                        ])
                        ->default('h2')
                        ->required()
                        ->native(false),
                    TextInput::make('text')
                        ->label('Text')
                        ->required(),
                ])->columns(2),
            Block::make('text')
                ->label('Text')
                ->schema([
                    Textarea::make('text')
                        ->required()
                        ->rows(5),
                ]),
            Block::make('image')
                ->label('Image')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->directory('pages')
                        ->disk('public')
                        ->required(),
                    TextInput::make('alt')
                        ->label('Alt text')
                        ->maxLength(255),
                ]),
        ];
    }
}
