<?php

namespace App\Models;

use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    use HasFactory,
        ModelUtilities,
        InteractsWithMedia;

    protected $fillable = [
        "admin_id",
        "registration_number",
        "name",
        "address",
        "phone_number",
        "email",
        "fax",
        "website",
    ];
    
    public function admin()
    {
        return $this->belongsTo(User::class, "admin_id");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "company_users");
    }

    public function logoUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("logo")?->getFullUrl() ?? null;
            }
        );
    }

    public function uploadLogo(UploadedFile $media = null)
    {
        if ($media) {
            foreach ($this->getMedia("logo") as $logo)
                $logo->delete();
        }

        $media
            ? $this->addMedia($media)->toMediaCollection("logo")
            : null;
    }

    public function companyPictureUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("picture")?->getFullUrl() ?? null;
            }
        );
    }

    public function uploadCompanyPicture(UploadedFile $media = null)
    {
        foreach ($this->getMedia("picture") as $picture)
            $picture->delete();

        if ($media) {
            $image = ImageManagerStatic::make($media->getPathname());

            $original_width = $image->width();
            $original_height = $image->height();

            $targeted_width = 1280;
            $targeted_height = ($targeted_width / $original_width) * $original_height;

            $image->resize($targeted_width, $targeted_height);

            $this->addMediaFromString($image->stream(null, 66)->__toString())
                ->usingFileName($media->getClientOriginalName())
                ->toMediaCollection("picture");
        }
    }
}
