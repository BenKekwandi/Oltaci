<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use DateTime;

/**
 * App\Models\Captain
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $date_of_birth
 * @property string|null $profile_picture
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $license_number
 * @property int $years_of_experience
 * @property string $certifications
 * @property string $special_skills
 * @property string $languages_spoken
 * @property string $availability_calendar
 * @property string $preferred_working_hours
 * @property float $average_rating
 * @property int $number_of_reviews
 * @property string $customer_feedback
 * @property string $boat_name
 * @property string $boat_type
 * @property int $boat_capacity
 * @property string $biography
 * @property string $linkedin
 * @property string $facebook
 * @property string $instagram
 * @property string $gallery
 * @property string $introductory_video
 * @property string $emergency_contact_name
 * @property string $emergency_contact_relation
 * @property string $emergency_contact_phone
 * @property int $availability_status
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
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereYearsOfExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereCertifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereSpecialSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereLanguagesSpoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereAvailabilityCalendar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain wherePreferredWorkingHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereAverageRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereNumberOfReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereCustomerFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereBoatName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereBoatType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereBoatCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereIntroductoryVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereEmergencyContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereEmergencyContactRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereEmergencyContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereAvailabilityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain withoutTrashed()
 * @mixin \Eloquent
 */

class Captain extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'profile_picture',
        'email',
        'phone',
        'address',
        'license_number',
        'years_of_experience',
        'certifications',
        'special_skills',
        'languages_spoken',
        'availability_calendar',
        'preferred_working_hours',
        'average_rating',
        'number_of_reviews',
        'customer_feedback',
        'boat_name',
        'boat_type',
        'boat_capacity',
        'biography',
        'linkedin',
        'facebook',
        'instagram',
        'gallery',
        'introductory_video',
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_phone',
        'availability_status'
    ];
    protected $casts = [
        'date_of_birth' => 'date',
        'availability_status' => 'boolean',
    ];

    

    public function getProfilePictureAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }

        return null;
    }

    public function getDateOfBirthAttribute($value)
    {
        if ($value) {
            return (new DateTime($value))->format('Y-m-d H:i');
        }
    }
}
