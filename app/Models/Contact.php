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

class Contact extends Model implements HasMedia
{
    use HasFactory,
        ModelUtilities,
        InteractsWithMedia;
        

    protected $fillable = [
        "user_id",
        "company_id",
        "name",
        "address",
        "phone_number",
        "fax",
        "email",
        "subtitle",
        "job_title",
        "quote",
        "contact_code",
        "website_url"
    ];

    public function generateContactCode()
    {
        $this->update([
            "contact_code" => dechex(time().$this->id)
        ]);
    }

    public function firstName() : Attribute
    {
        return Attribute::make(
            get: function () {
                return explode(" ", $this->name)[0];
            }
        );
    }

    public function lastName() : Attribute
    {
        return Attribute::make(
            get: function () {
                $name_chunks = explode(" ", $this->name);
                $last_name = "";

                foreach ($name_chunks as $index => $name_chunk) {
                    if ($index > 1)
                        $last_name .= " ".$name_chunk;
                }

                return $last_name;
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function external_links()
    {
        return $this->morphMany(ExternalLink::class, 'taggable');
    }

    public function profilePictureUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("profile-picture")?->getFullUrl() ?? null;
            }
        );
    }

    public function uploadProfilePicture(UploadedFile $media = null)
    {
        foreach ($this->getMedia("profile-picture") as $profile_picture)
            $profile_picture->delete();

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

    public function updateExternalLinks(Array $external_links_data)
    {
        // $external_links_data_format = [
        //     "external_link_types" => 1,
        //     "url" => "https://google.com"
        // ];

        $this->external_links()->delete();

        $filtered_external_links_data = collect($external_links_data)
            ->filter(function ($external_link_data, $index) {
                return isset($external_link_data["url"]);
            });

        $this->external_links()->createMany($filtered_external_links_data);
    }
}
