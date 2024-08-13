<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $location
 * @property string $coordinates
 * @property string $latitude
 * @property string $longitude
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Region filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Region filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Region filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Region sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Region sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereMapCoordinate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Region withoutTrashed()
 * @property string $coordinates
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCoordinates($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'description',
        'location',
        'coordinates',
        'latitude',
        'longitude'
    ];
}
