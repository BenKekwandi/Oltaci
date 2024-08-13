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
 * @property int $reservation_id
 * @property int $additional_service_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReservationAdditionalServiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereIsOngoing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService withoutTrashed()
 * @property int|null $reservation_id
 * @property int|null $additional_service_id
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereAdditionalServiceId($value)
 * @property-read \App\Models\AdditionalService|null $additionalService
 * @property-read \App\Models\Reservation|null $reservation
 * @mixin \Eloquent
 */



class ReservationAdditionalService extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;

    protected $table = 'reservation_additional_service';

    protected $fillable = [
        'reservation_id',
        'additional_service_id',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function additionalService():BelongsTo
    {
        return $this->belongsTo(AdditionalService::class);
    }




}
