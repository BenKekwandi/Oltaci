<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


/**
 * App\Models\Subscriber
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CaptainFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Captain filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain withoutTrashed()
 * @mixin \Eloquent
 */

class Subscriber extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use Notifiable;
    // use SoftDeletes;

    protected $table = "subscribers";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
    ];


    
}
