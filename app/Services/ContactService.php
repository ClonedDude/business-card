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
        ])->validate();

        $contact = Contact::create($validated);

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
        ])->validate();

        $contact->update($validated);

        return $contact;
    }

    public function deleteContact(int $id)
    {
        $contact = Contact::find($id);

        return $contact->delete();
    }
}