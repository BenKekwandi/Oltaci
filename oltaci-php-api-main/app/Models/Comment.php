<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * 
 *
 * @property int $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string|null $media
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
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 * @mixin \Eloquent
 */

class Comment extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $table = "comments";

    protected $primaryKey = 'id';

    protected $fillable = [
        'body',
        'post_id',
        'user_id'
    ];

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}