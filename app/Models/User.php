<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\Support\ImageFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        InteractsWithMedia,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function google2faSecret(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value ?? false
                    ? decrypt($value)
                    : null;
            },
            set: function ($value) {
                return encrypt($value);
            },
        );
    }

    public function profilePictureUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("profile-picture")?->getFullUrl();
            }
        );
    }

    public function uploadProfilePicture(UploadedFile $media = null)
    {
        foreach ($this->getMedia("profile-picture") as $icon)
            $icon->delete();

        if ($media) {
            $image = ImageManagerStatic::make($media->getPathname());

            $original_width = $image->width();
            $original_height = $image->height();

            $targeted_width = 1280;
            $targeted_height = ($targeted_width / $original_width) * $original_height;

            $image->resize($targeted_width, $targeted_height);

            $this->addMediaFromString($image->stream(null, 66)->__toString())
                ->usingFileName($media->getClientOriginalName())
                ->toMediaCollection("profile-picture");
        }
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, "company_users", "user_id", "company_id");
    }
}
