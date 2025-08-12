<?php

declare(strict_types=1);

namespace Datlechin\FilamentMenuBuilder\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Datlechin\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property bool $is_visible
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|MenuLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read Collection|MenuItem[] $menuItems
 * @property-read int|null $menuItems_count
 */
class Menu extends Model
{
    protected $guarded = [];

    public function getTable(): string
    {
        return config('filament-menu-builder.tables.menus', parent::getTable());
    }

    protected function casts(): array
    {
        return [
            'is_visible' => 'bool',
        ];
    }

    public function locations(): HasMany
    {
        return $this->hasMany(FilamentMenuBuilderPlugin::get()->getMenuLocationModel());
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(FilamentMenuBuilderPlugin::get()->getMenuItemModel())
            ->whereNull('parent_id')
            ->orderBy('parent_id')
            ->orderBy('order')
            ->with('children');
    }

    public static function location(string $location): ?self
    {
        return self::query()
            ->where('is_visible', true)
            ->whereRelation('locations', 'location', $location)
            ->with('menuItems')
            ->first();
    }
}
