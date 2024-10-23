<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class ContactService {
    public function createContact(array $data)
    {
        $validated = Validator::make($data, [
            "user_id" => ["required", "exists:users,id"],
            "company_id" => ["required", "exists:companies,id"],
            "name" => ["required", "string"],
            "address" => ["required", "string"],
            "phone_number" => ["required", "string"],
            "fax" => ["required", "string"],
            "email" => ["required", "email"],
            "subtitle" => ["required", "string", "nullable"],
            "job_title" => ["required", "string", "nullable"],
            "quote" => ["required", "string", "nullable"],
            "external_links" => ["sometimes", "array"],
            "external_link.*.external_link_type_id" => ["required", "exists:external_link_types,id"],
            "external_link.*.url" => ["sometimes", "exists:external_link_types,id"],
            "profile_picture" => ["required", "image"],
            "website_url" => ["required", "nullable"]
        ])->validate();

        $contact = Contact::create($validated);
        $contact->updateExternalLinks($validated["external_links"] ?? []);
        $contact->uploadProfilePicture($validated["profile_picture"] ?? null);
        $contact->generateContactCode();

        return $contact;
    }

    public function updateContact(int $id, array $data)
    {
        $contact = Contact::find($id);

        $validated = Validator::make($data, [
            "company_id" => ["sometimes", "exists:companies,id"],
            "name" => ["sometimes", "string"],
            "address" => ["sometimes", "string"],
            "phone_number" => ["sometimes", "string"],
            "fax" => ["sometimes", "string"],
            "email" => ["sometimes", "email"],
            "subtitle" => ["sometimes", "string", "nullable"],
            "job_title" => ["sometimes", "string", "nullable"],
            "quote" => ["sometimes", "string", "nullable"],
            "external_links" => ["sometimes", "array"],
            "external_link.*.external_link_type_id" => ["required", "exists:external_link_types,id"],
            "external_link.*.url" => ["sometimes", "exists:external_link_types,id"],
            "profile_picture" => ["sometimes", "image"],
            "website_url" => ["sometimes", "nullable"]
        ])->validate();

        $contact->update($validated);
        $contact->updateExternalLinks($validated["external_links"] ?? []);
        if (isset($validated["profile_picture"])) {
            $contact->uploadProfilePicture($validated["profile_picture"]);
        }
        // $contact->uploadProfilePicture($validated["profile_picture"] ?? null);

        return $contact;
    }

    public function deleteContact(int $id)
    {
        $contact = Contact::find($id);

        return $contact->delete();
    }
}