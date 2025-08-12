<?php

declare(strict_types=1);

namespace Datlechin\FilamentMenuBuilder\Resources\MenuResource\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\DeleteAction;
use Datlechin\FilamentMenuBuilder\Concerns\HasLocationAction;
use Datlechin\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    use HasLocationAction;

    protected string $view = 'filament-menu-builder::edit-record';

    public static function getResource(): string
    {
        return FilamentMenuBuilderPlugin::get()->getResource();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema($schema->getComponents()),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            $this->getLocationAction(),
        ];
    }
}
