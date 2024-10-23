<div class="d-flex flex-column">
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Item ID: </div>
        <div>{{ $item->id }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Item name: </div>
        <div>{{ $item->name }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Additional Details: </div>
        <div>{{ $item->description }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Total Amount: </div>
        <div>{{ $item->price }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Currency: </div>
        <div>{{ $item->currency }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Date of creation: </div>
        <div>{{ $item->created_at }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Company ID: </div>
        <div>{{ $item->company_id }}</div>
    </div>

</div>