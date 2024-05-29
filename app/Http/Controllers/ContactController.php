<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view("welcome", compact("contact"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, ContactService $contactService)
    {
        $contact = $contactService->createContact($request->all());

        return redirect(route("contacts.index"))
            ->with("success", "contact created successfully");
    }

    public function edit()
    {
        return view("welcome");
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
