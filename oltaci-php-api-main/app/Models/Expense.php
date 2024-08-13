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
 * @property string|null $picture
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExpenseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Expense filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withoutTrashed()
 * @mixin \Eloquent
 */
class Expense extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'currency',
        'payment_method',
        'purpose',
        'notes'
    ];
}
