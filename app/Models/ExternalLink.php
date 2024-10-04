<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalLink extends Model
{
    use HasFactory;

    protected $fillable = [
        "external_link_type_id",
        "taggable_id",
        "taggable_type",
        "url"
    ];

    public function taggable()
    {
        return $this->morphTo();
    }

    public function external_link_type()
    {
        return $this->belongsTo(ExternalLinkType::class, "external_link_type_id");
    }
}
