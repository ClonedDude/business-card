<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;

class PublicContactController extends Controller
{
    public function show($contact_code)
    {
        $contact = Contact::where("contact_code", $contact_code)->first();
        return view("pages.public.contact.show", compact("contact", "contact_code"));
    }

    public function download($contact_code)
    {
        $contact = Contact::where("contact_code", $contact_code)
            ->first();

        $vcard = new VCard();

        $vcard->addName($contact->last_name, $contact->first_name, '', '', '');

        // add work data
        if ($contact->company->name) $vcard->addCompany($contact->company->name);
        if ($contact->job_title) $vcard->addJobtitle($contact->job_title);
        if ($contact->email) $vcard->addEmail($contact->email, 'PREF;WORK');
        if ($contact->phone_number) $vcard->addPhoneNumber($contact->phone_number, 'PREF;CELL');
        if ($contact->address) $vcard->addAddress($contact->address, '', '', '', '', '', '');

        return $vcard->download();
    }
}
