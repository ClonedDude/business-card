<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\ExternalLinkType;
use Livewire\Component;

class ContactExternalLinksForm extends Component
{
    public $contact;
    public $external_link_types;

    public function mount(Contact $contact)
    {
        $this->contact  = $contact->id
            ? $contact
            : null;
        $this->external_link_types = ExternalLinkType::all();
    }

    public function render()
    {
        return view('livewire.contact-external-links-form');
    }
}
