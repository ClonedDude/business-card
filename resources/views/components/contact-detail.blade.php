<div class="d-flex flex-column">
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">name: </div>
        <div>{{ $contact->name }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">address: </div>
        <div>{{ $contact->address }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">phone number: </div>
        <div>{{ $contact->phone_number }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">fax: </div>
        <div>{{ $contact->fax }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">email: </div>
        <div>{{ $contact->email }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">subtitle: </div>
        <div>{{ $contact->subtitle }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">job title: </div>
        <div>{{ $contact->job_title }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">quote: </div>
        <div>{{ $contact->quote }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">contact code: </div>
        <div>{{ $contact->contact_code }}</div>
    </div>
</div>