<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



/**
 * 
 *
 * @property int $id
 * @property int $boat_id
 * @property int $captain_id
 * @property int $user_id
 * @property string $end
 * @property string $start
 * @property float $departure
 * @property string $destination
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
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withoutTrashed()
 * @property-read \App\Models\Boat $boat
 * @property-read \App\Models\Captain $captain
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStatus($value)
 * @mixin \Eloquent
 */

class Trip extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    // use SoftDeletes;

    protected $table = "trips";

    protected $primaryKey = 'id';

    protected $fillable = [
        'boat_id',
        'captain_id',
        'user_id',
        'start',
        'end',
        'departure',
        'destination',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'boat_id' => 'integer',
            'captain_id' => 'integer',
            'user_id' => 'integer'
        ];
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }
    function captain(): BelongsTo
    {
        return $this->belongsTo(Captain::class);
    }
}
