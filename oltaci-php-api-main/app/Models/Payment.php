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
 * @property string $token
 * @property integer $expiration
 * @property string|null $conversation_id
 * @property string|null $buyer_identity_number
 * @property string|null $reservation_id
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PaymentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Payment filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withoutTrashed()
 * @property float|null $amount
 * @property string|null $currency
 * @property float|null $commission_fee
 * @property float|null $commission_rate
 * @property string|null $payment_time
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCommissionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereToken($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'token',
        'reservation_id',
        'amount',
        'currency',
        'commission_rate',
        'payment_time'
    ];
}
