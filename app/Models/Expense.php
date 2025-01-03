<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Intervention\Image\ImageManagerStatic;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\ModelUtilities;



class Expense extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $fillable = ['user_id', 'expense_name', 'total_amount', 'currency', 'additional_details','date_of_expense', 'company_id', 'approval'];

    // Define the relationship (expense -> many expense items)
  

    public function expenseItems()
    {
        return $this->hasMany(ExpenseTransactionItem::class, 'expense_id', 'id');
    }

    public function approvals()
    {
        return $this->morphMany(ExpenseApproval::class, 'approvalable');
    }
    
    //testing receipt image
    public function receiptPictureUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("receipt-picture")?->getFullUrl();
            }
        );
    }

    public function getReceiptPicture() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia("receipt-picture")();
            }
        );
    }


    public function uploadReceiptPicture(UploadedFile $media = null)
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
