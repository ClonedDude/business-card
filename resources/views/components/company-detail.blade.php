<div class="d-flex flex-column">
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">registration number:</div>
        <div>{{ $company->registration_number }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">name:</div>
        <div>{{ $company->name }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">address:</div>
        <div>{{ $company->address }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">phone number:</div>
        <div>{{ $company->phone_number }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">fax:</div>
        <div>{{ $company->fax }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">website:</div>
        <div>{{ $company->website }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">email:</div>
        <div>{{ $company->email }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4">
        <div class="text-capitalize">logo:</div>
        {{-- <div>{{ $company->logo_url }}</div> --}}
    </div>
</div>