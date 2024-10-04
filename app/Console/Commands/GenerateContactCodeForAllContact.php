<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;

class GenerateContactCodeForAllContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-contact-code-for-all-contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contacts = Contact::all();

        foreach ($contacts as $contact) {
            $contact->generateContactCode();
        }
    }
}
