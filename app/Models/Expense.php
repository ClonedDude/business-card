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

class Expense extends Model implements HasMedia
{
    use HasFactory,
        ModelUtilities,
        InteractsWithMedia;

    protected $fillable = [
        "expense_name",
        "additional_details",
        "total_amount",
        "currency",
        "date_of_expense",
        "user_ID",
        "approval",
    ];
    
    public function uploadReceiptImage(UploadedFile $media = null)
    {
        foreach ($this->getMedia("receipt-picture") as $icon)
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
                ->toMediaCollection("receipt-picture");
        }
    }

    

}
