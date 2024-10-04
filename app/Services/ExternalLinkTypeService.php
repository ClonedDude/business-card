<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ExternalLinkType;

class ExternalLinkTypeService {
    public function createExternalLinkType(array $data)
    {
        $validated = Validator::make($data, [
            "name" => ["required"],
            "icon" => ["required", "image"]
        ])->validate();

        $external_link_type = ExternalLinkType::create($validated);
        $external_link_type->uploadIcon($validated["icon"] ?? null);

        return $external_link_type;
    }

    public function updateExternalLinkType(int $id, array $data)
    {
        $external_link_type = ExternalLinkType::find($id);

        $validated = Validator::make($data, [
            "name" => ["required"],
            "icon" => ["nullable","image"]
        ])->validate();

        $external_link_type->update($validated);
        
        if (isset($validated["icon"])) {
            $external_link_type->uploadIcon($validated["icon"]);
        }

        return $external_link_type;
    }

    public function deleteExternalLinkType(int $id)
    {
        $external_link_type = ExternalLinkType::find($id);

        return $external_link_type->delete();
    }
}