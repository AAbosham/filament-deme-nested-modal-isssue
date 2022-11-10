<?php

namespace App\Filament\Resources\Blog\PostResource\Widgets;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Widgets\TableWidget as BaseWidget;

class Comments extends BaseWidget
{
    public $record;

    protected function getTableHeading(): string | Htmlable | Closure | null
    {
        return null;
    }

    protected function getTableQuery(): Builder
    {
        return $this->record->comments()->getQuery();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('customer.name')
                ->label('Customer')
                ->searchable()
                ->sortable(),

            Tables\Columns\BooleanColumn::make('is_visible')
                ->label('Visibility')
                ->sortable(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required(),

            // Forms\Components\Select::make('customer_id')
            //     ->relationship('customer', 'name')
            //     ->searchable()
            //     ->required(),

            Forms\Components\Toggle::make('is_visible')
                ->label('Approved for public')
                ->default(true),

            Forms\Components\MarkdownEditor::make('content')
                ->required()
                ->label('Content'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make()
                    ->record($this->record)
                    ->form($this->getFormSchema())
            ])
        ];
    }
}
