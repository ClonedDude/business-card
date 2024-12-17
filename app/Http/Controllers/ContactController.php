<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use JeroenDesloovere\VCard\VCard;

class ContactController extends Controller
{
    public function index()
    {
        return view("pages.contact.index");
    }

    public function data()
    {
        $contacts_query = Contact::select("*")
            ->with(["user", "company"]);

        return DataTables::of($contacts_query)
            ->addColumn("profile_picture", function ($row) {
                return $row->profile_picture_url
                    ? view("components.image-preview", ["url" => $row->profile_picture_url, "title" => "{$row->name} profile picture"])->render()
                    : null;
            })
            ->addColumn("user_name", function ($row) {
                return $row->user->name;
            })
            ->addColumn("company_name", function ($row) {
                return $row->company->name;
            })
            ->addColumn("action", function ($row) {
                $detail_button
                    = '<div> <a href="'.route('contacts.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                        Detail
                    </a></div>';

                $public_detail_button
                    = '<div> <a href="'.route('public-contact-detail', ["contact_code" => $row->contact_code]).'" class="btn btn-sm btn-primary me-2 mb-4">
                        Public Detail
                    </a> </div>';

                $edit_button
                    = '<div><a href="'.route('contacts.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        Edit
                    </a> </div>';

                $delete_button
                    = '<form class="delete-training-form" action="'.route('contacts.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this contact? This action cannot be undone.\')">
                        '.csrf_field().'
                        <div><button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                        Delete</button></div>
                    </form>';

                $html = "<div class='d-flex flex-row equalize'>
                    $detail_button
                    $public_detail_button
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            ->rawColumns(["profile_picture", "action"])
            ->make(true);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view("pages.contact.show", compact("contact"));
    }

    public function downloadVCard($id)
    {
        $contact = Contact::findOrFail($id);

        $vcard = new VCard();

        $vcard->addName($contact->last_name, $contact->first_name, '', '', '');

        // add work data
        if ($contact->company->name) $vcard->addCompany($contact->company->name);
        if ($contact->job_title) $vcard->addJobtitle($contact->job_title);
        if ($contact->email) $vcard->addEmail($contact->email, 'WORK');
        if ($contact->phone_number) $vcard->addPhoneNumber($contact->phone_number, 'PREF;CELL');
        if ($contact->address) $vcard->addAddress($contact->address, '', '', '', '', '', '');

        return $vcard->download();
    }

    public function create()
    {
        return view("pages.contact.create");
    }

    public function store(Request $request, ContactService $contactService)
    {
        $contact = $contactService->createContact($request->all());

        return redirect(route("contacts.index"))
            ->with("success", "contact created successfully");
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view("pages.contact.edit", compact("contact"));
    }

    public function update(Request $request, ContactService $contactService, int $id)
    {
        $contact = $contactService->updateContact($id, $request->all());

        return redirect(route("contacts.index"))
            ->with("success", "contact updated successfully");
    }

    public function delete(Request $request, ContactService $contactService, int $id)
    {
        $contactService->deleteContact($id);

        return redirect(route("contacts.index"))
            ->with("success", "contact deleted successfully");
    }
}
