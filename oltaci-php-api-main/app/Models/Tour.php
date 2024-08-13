<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $boat_id
 * @property int $region_id
 * @property string $duration
 * @property float $price
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TourFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withoutTrashed()
 * @property-read \App\Models\Boat $boat
 * @property-read \App\Models\Region $region
 * @property int|null $captain_id
 * @property-read \App\Models\Captain|null $captain
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereType($value)
 * @mixin \Eloquent
 */
class Tour extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $table = "tours";

    protected $primaryKey = 'id';

    protected $fillable = [
        'boat_id',
        'region_id',
        'departure_id',
        'destination_id',
        'captain_id',
        'duration',
        'price',
        'type'
    ];

    protected function casts(): array
    {
        return [
            'boat_id' => 'integer',
            'region_id' => 'integer',
            'captain_id' => 'integer',
            'departure_id' => 'integer',
            'destination_id' => 'integer',
        ];
    }

    function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
    function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }
    function captain(): BelongsTo
    {
        return $this->belongsTo(Captain::class);
    }

    function departure(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    function destination(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

}
