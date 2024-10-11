<div class="d-flex flex-column">
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Expense ID: </div>
        <div>{{ $expense->id }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Expense name: </div>
        <div>{{ $expense->expense_name }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Additional Details: </div>
        <div>{{ $expense->additional_details }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Total Amount: </div>
        <div>{{ $expense->total_amount }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Currency: </div>
        <div>{{ $expense->currency }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Date of Expense: </div>
        <div>{{ $expense->date_of_expense }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Created by: </div>
        <div>{{ $expense->user_ID }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Created at: </div>
        <div>{{ $expense->expense_created_at }}</div>
    </div>
    <div class="d-flex flex-row justify-content-between p-4 border-bottom">
        <div class="text-capitalize">Approval: </div>
            <div> 
                @if($expense->approval=0)
                <p>Not approved</p>
                @elseif($expense->approval=1)
                <p>Approved</p>
                @endif
            </div>
    </div>

</div>