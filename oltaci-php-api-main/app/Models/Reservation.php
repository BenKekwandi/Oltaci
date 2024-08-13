<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $tour_id
 * @property int $number_of_people
 * @property int $total_price
 * @property bool $has_been_paid
 * @property bool $has_been_verified
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIsOngoing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation withoutTrashed()
 * @property int|null $payment_id
 * @property int|null $captain_id
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereHasBeenPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereHasBeenVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereNumberOfPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalPrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdditionalService> $additionalServices
 * @property-read int|null $additional_services_count
 * @property-read \App\Models\Captain|null $captain
 * @property-read \App\Models\Tour $tour
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'tour_id',
        'user_id',
        'number_of_people',
        'total_price',
        'payment_id',
        'has_been_paid',
        'has_been_verified',
        'with_captain',
        'identity_number',
        'email',
        'phone',
        'address',
        'departure_date',
        'return_date',
    ];

    protected $casts = [
        'has_been_paid' => 'boolean',
        'has_been_verified' => 'boolean',
        'with_captain' => 'boolean',
        'departure_date' => 'date',
        'return_date' => 'date',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
    function captain(): BelongsTo
    {
        return $this->belongsTo(Captain::class);
    }

    public function additionalServices(): BelongsToMany
    {
        return $this->belongsToMany(AdditionalService::class, 'reservation_additional_service');
    }

}
