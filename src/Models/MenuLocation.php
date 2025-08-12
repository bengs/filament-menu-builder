<?php

declare(strict_types=1);

namespace Datlechin\FilamentMenuBuilder\Models;

use Illuminate\Support\Carbon;
use Datlechin\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $menu_id
 * @property string $location
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Menu $menu
 */
class MenuLocation extends Model
{
    protected $guarded = [];

    public function getTable(): string
    {
        return config('filament-menu-builder.tables.menu_locations', parent::getTable());
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(FilamentMenuBuilderPlugin::get()->getMenuModel());
    }
}
