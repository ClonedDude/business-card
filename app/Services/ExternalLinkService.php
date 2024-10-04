<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ExternalLink;

class ExternalLinkService {
    public function createExternalLink(array $data)
    {
        $validated = Validator::make($data, [
            "external_link_type_id" => ["required"],
            "taggable_id" => ["required"],
            "taggable_type" => ["required"],
            "url" => ["required", "url"],
        ])->validate();

        $external_link = ExternalLink::create($validated);

        return $external_link;
    }

    public function updateExternalLink(int $id, array $data)
    {
        $external_link = ExternalLink::find($id);

        $validated = Validator::make($data, [
            "external_link_type_id" => ["required"],
            "taggable_id" => ["required"],
            "taggable_type" => ["required"],
            "url" => ["required", "url"],
        ])->validate();

        $external_link->update($validated);

        return $external_link;
    }

    public function deleteExternalLink(int $id)
    {
        $external_link = ExternalLink::find($id);

        return $external_link->delete();
    }
}