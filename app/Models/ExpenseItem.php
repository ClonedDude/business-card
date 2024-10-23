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


class ExpenseItem extends Model
{
    protected $fillable = ['name', 'price', 'quantity', 'currency', 'company_id'];

    // Define the inverse relationship (expense -> items)
    public function expense()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}

