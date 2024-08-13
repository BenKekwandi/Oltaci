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
 * @property string $details
 * @property string $boat_id
 * @property string $log_datetime
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereLogDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property int|null $trip_id
 * @property-read \App\Models\Boat|null $boat
 * @method static \Illuminate\Database\Eloquent\Builder|BoatLog whereTripId($value)
 * @mixin \Eloquent
 */

class BoatLog extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    // use SoftDeletes;

    protected $table = 'boat_logs';

    protected $fillable = [
        'boat_id',
        'details',
        'log_datetime'
    ];

    function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }

}

