<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static \Database\Factories\AdditionalServiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdditionalService extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency'
    ];
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_additional_service');
    }
}
