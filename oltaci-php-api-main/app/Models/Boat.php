<?php

namespace App\Models;

use App\Enums\BoatTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $height
 * @property string $length
 * @property string $width
 * @property string $engine_power
 * @property string $capacity
 * @property string $manufacturer
 * @property string|null $picture
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BoatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereEnginePower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property int|null $owner_id
 * @property int|null $year_built
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BoatEquipment> $equipments
 * @property-read int|null $equipments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BoatPicture> $pictures
 * @property-read int|null $pictures_count
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereYearBuilt($value)
 * @mixin \Eloquent
 */
class Boat extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'picture',
        'length',
        'height',
        'width',
        'capacity',
        'engine_power',
        'year_built',
        'manufacturer',
        'owner_id',
        'description',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function getPictureAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
        return null;
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(BoatPicture::class, 'boat_id');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'boat_id');
    }

    public function equipments(): HasMany
    {
        return $this->hasMany(BoatEquipment::class, 'boat_id');
    }


}
