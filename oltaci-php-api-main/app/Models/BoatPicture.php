<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;


/**
 * 
 *
 * @property int $id
 * @property integer $boat_id
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BoatPictureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture query()
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture withoutTrashed()
 * @property string|null $picture
 * @method static \Illuminate\Database\Eloquent\Builder|BoatPicture whereDescription($value)
 * @property-read \App\Models\Boat|null $boat
 * @mixin \Eloquent
 */

class BoatPicture extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'boat_id',
        'picture',
    ];

    function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }

    public function getPictureAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
        return Storage::disk('public')->url('boats/1719523272_667dd7c84146b.webp');
    }

}
