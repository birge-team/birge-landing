<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title.ru')
                    ->searchable()
                    ->sortable()
                    ->limit(25)
                    ->formatStateUsing(fn ($state) => $state['ru'] ?? $state['en'] ?? is_array($state) ? reset($state) : $state),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->label('Категория'),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn ($state) => $state['ru'] ?? $state['en'] ?? is_array($state) ? reset($state) : $state),
                TextColumn::make('description.ru')
                    ->searchable()
                    ->limit(20)
                    ->label('Описание')
                    ->formatStateUsing(fn ($state) => $state['ru'] ?? $state['en'] ?? is_array($state) ? reset($state) : $state),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
