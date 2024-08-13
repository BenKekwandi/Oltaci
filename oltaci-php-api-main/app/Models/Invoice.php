<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Log;

/**
 * 
 *
 * @property int $id
 * @property double $amount
 * @property string $currency
 * @property string $invoice_number
 * @property datetime $invoicing_date
 * @property integer $transaction_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\IncomeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Income filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Income filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Income filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Income renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Income restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Income sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Income sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInvoicingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    // use SoftDeletes;

    protected $fillable = [
        'id',
        'amount',
        'currency',
        'payment_type',
        'invoicing_date',
        'invoice_file',
        'invoice_number',
        'transaction_id'
    ];

    public function getInvoiceFileAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
        return null;
    }
}
