<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExternalLinkType extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $fillable = [
        'name',
        'svg'
    ];

    public function iconUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("icon")?->getFullUrl() ?? null;
            }
        );
    }

    public function uploadIcon(UploadedFile $media = null)
    {
        foreach ($this->getMedia("icon") as $icon)
            $icon->delete();

        $media
            ? $this->addMedia($media)->toMediaCollection("icon")
            : null;
    }
}
