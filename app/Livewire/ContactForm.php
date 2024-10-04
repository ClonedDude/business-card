<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ContactForm extends Component
{
    public $user_id, $company_id;
    public $user, $company;
    public $users, $companies;
    public $is_detail_inputs_allowed;
    public $name, $address, $phone_number, $fax, $email, $subtitle, $job_title, $quote, $website_url;
    public $contact;

    public function mount($contact)
    {
        if ($contact) {
            $this->contact = $contact;

            $this->name = $contact->name;
            $this->address = $contact->address;
            $this->phone_number = $contact->phone_number;
            $this->fax = $contact->fax;
            $this->email = $contact->email;
            $this->subtitle = $contact->subtitle;
            $this->job_title = $contact->job_title;
            $this->quote = $contact->quote;
            $this->website_url = $contact->website_url;

            $this->users = User::select("*")
                ->get();

            if ($this->users->count() > 1) {
                $this->user_id = $this->contact->user_id;
                $this->updatedUserId();
            }
        } else {
            $this->users = User::select("*")
                ->get();

            if ($this->users->count() > 1) {
                $this->user_id = $this->users->first()->id;
                $this->updatedUserId();
            }
        }
    }

    public function updatedUserId()
    {
        $this->getCompany();
    }

    public function getUser()
    {
        $user = User::find($this->user_id);

        $this->user = $user;
    }

    public function getCompany()
    {
        $user = User::find($this->user_id);

        $this->companies = $user->companies;

        if ($this->contact) {
            $this->company_id = $this->contact->company_id;
        } else {
            if ($this->companies->count() > 0) {
                $this->company_id = $this->companies->first()->id;
            } else {
                $this->company_id = null;
            }
        }
    }

    public function hydrate()
    {
    }

    public function render()
    {
        $this->is_detail_inputs_allowed = ($this->user_id && $this->company_id);

        return view('livewire.contact-form');
    }
}
