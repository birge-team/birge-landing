<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')
                    ->tabs([
                        self::languageTab('Русский', 'ru', 'Заголовок', 'Описание', 'Текст'),
                        self::languageTab('English', 'en', 'Title', 'Description', 'Text'),
                        self::languageTab('Қазақша', 'kk', 'Атауы', 'Сипаттама', 'Мәтін'),
                    ])
                    ->columnSpanFull(),

                Select::make('article_category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                DatePicker::make('date')
                    ->required(),
            ]);
    }

    private static function languageTab(
        string $tabLabel,
        string $locale,
        string $titleLabel,
        string $descriptionLabel,
        string $textLabel,
    ): Tabs\Tab {
        return Tabs\Tab::make($tabLabel)
            ->schema([
                TextInput::make("title.$locale")
                    ->required()
                    ->maxLength(255)
                    ->label($titleLabel),

//                TextInput::make("slug.$locale")
//                    ->required()
//                    ->maxLength(255)
//                    ->label('Slug'),

                TextInput::make("description.$locale")
                    ->required()
                    ->maxLength(255)
                    ->label($descriptionLabel),

                Repeater::make("content.$locale")
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Заголовок блока')
                            ->columnSpanFull(),

                        TextInput::make('title_content')
                            ->label('Заголовок для содержания')
                            ->columnSpanFull(),

                        RichEditor::make('text')
                            ->required()
                            ->label($textLabel)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->reorderable()
                    ->collapsible()
                    ->cloneable()
                    ->label('Контент'),
            ]);
    }
}
