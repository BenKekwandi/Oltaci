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
 * @property string $name
 * @property string $type
 * @property string $currency
 * @property string $purpose
 * @property string $payment_method
 * @property string $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withoutTrashed()
 * @property float $amount
 * @property string $payment_type
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePurpose($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'type',
        'currency',
        'payment_method',
        'purpose',
        'notes'
    ];
}
