<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class AdditionalService extends \Eloquent {}
}

namespace App\Models{
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
	class Boat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $equipment_id
 * @property string $boat_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property-read \App\Models\Boat|null $boat
 * @property-read \App\Models\Equipment|null $equipment
 * @mixin \Eloquent
 */
	class BoatEquipment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $cost
 * @property string $boat_id
 * @property string $quantity
 * @property string $fueling_datetime
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereFuelingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property-read \App\Models\Boat|null $boat
 * @mixin \Eloquent
 */
	class BoatFueling extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $details
 * @property string $boat_id
 * @property string $log_datetime
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereLogDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @property int|null $trip_id
 * @property-read \App\Models\Boat|null $boat
 * @method static \Illuminate\Database\Eloquent\Builder|BoatLog whereTripId($value)
 * @mixin \Eloquent
 */
	class BoatLog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $cost
 * @property string $inspector
 * @property string $maintenance_datetime
 * @property string $description
 * @property string $boat_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereMaintenanceDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereInspector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @mixin \Eloquent
 */
	class BoatMaintenance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Owner
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
	class BoatOwner extends \Eloquent {}
}

namespace App\Models{
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
	class BoatPicture extends \Eloquent {}
}

namespace App\Models{
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
	class Captain extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $trip_id
 * @property string $boat_id
 * @property string $weight
 * @property string $quantity
 * @property string $species
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatchRecord whereTripId($value)
 * @mixin \Eloquent
 */
	class CatchRecord extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
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
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Boat withoutTrashed()
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Boat whereDescription($value)
 * @mixin \Eloquent
 */
	class Equipment extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withoutTrashed()
 * @mixin \Eloquent
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 * @mixin \Eloquent
 */
	class Income extends \Eloquent {}
}

namespace App\Models{
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
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $location
 * @property string $map_coordinate
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Region filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Region filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Region filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Region sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Region sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereMapCoordinate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Region withoutTrashed()
 * @property string $coordinates
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCoordinates($value)
 * @mixin \Eloquent
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $tour_id
 * @property int $number_of_people
 * @property int $total_price
 * @property bool $has_been_paid
 * @property bool $has_been_verified
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIsOngoing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation withoutTrashed()
 * @property int|null $payment_id
 * @property int|null $captain_id
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereHasBeenPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereHasBeenVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereNumberOfPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalPrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdditionalService> $additionalServices
 * @property-read int|null $additional_services_count
 * @property-read \App\Models\Captain|null $captain
 * @property-read \App\Models\Tour $tour
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $additional_service_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReservationAdditionalServiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereIsOngoing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService withoutTrashed()
 * @property int|null $reservation_id
 * @property int|null $additional_service_id
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationAdditionalService whereAdditionalServiceId($value)
 * @property-read \App\Models\AdditionalService|null $additionalService
 * @property-read \App\Models\Reservation|null $reservation
 * @mixin \Eloquent
 */
	class ReservationAdditionalService extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $boat_id
 * @property int $region_id
 * @property string $duration
 * @property float $price
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TourFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withoutTrashed()
 * @property-read \App\Models\Boat $boat
 * @property-read \App\Models\Region $region
 * @property int|null $captain_id
 * @property-read \App\Models\Captain|null $captain
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereType($value)
 * @mixin \Eloquent
 */
	class Tour extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $currency
 * @property string $purpose
 * @property string $payment_method
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
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
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
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $boat_id
 * @property int $captain_id
 * @property string $end
 * @property string $start
 * @property float $departure
 * @property string $destination
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TourFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour sortFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereBoatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tour withoutTrashed()
 * @property-read \App\Models\Boat $boat
 * @property-read \App\Models\Captain $captain
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStatus($value)
 * @mixin \Eloquent
 */
	class Trip extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $username
 * @property string $phone
 * @property string $type
 * @property int $is_active
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User filter(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User filterBy(array|string $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|User filterFields(array|string $fields)
 * @method static \Illuminate\Database\Eloquent\Builder|User renamedFilterFields(array $renamedFilterFields)
 * @method static \Illuminate\Database\Eloquent\Builder|User restrictedFilters(array|string $restrictedFilters)
 * @method static \Illuminate\Database\Eloquent\Builder|User sort(?array $params = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User sortFields(array|string $fields)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

