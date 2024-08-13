<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 
 *
 * @property int $id
 * @property string $cost
 * @property string $boat_id
 * @property string $quantity
 * @property string $fueling_datetime
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BoatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereFuelingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property-read \App\Models\Boat|null $boat
 * @mixin \Eloquent
 */

class BoatFueling extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    // use SoftDeletes;

    protected $table = 'boat_fueling';

    protected $fillable = [
        'boat_id',
        'cost',
        'currency',
        'fueling_datetime',
        'quantity',
    ];

    function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }
}
