<div>
    {{-- Expense name input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="expense_name-input">Expense Name</label>
        <input class="form-control" type="text" name="expense_name" id="expense_name-input" value="{{ old('expense_name', $expense_name) }}" required>
        @error('expense_name')
        <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    {{-- Additional details input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="additional_details-input">Additional Details</label>
        <input class="form-control" type="text" name="additional_details" id="additional_details-input" value="{{ old('additional_details', $additional_details) }}">
        @error('additional_details')
        <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    {{-- Date of Expense input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="date_of_expense-input">Date of Expense</label>
        <input class="form-control" type="date" name="date_of_expense" id="date_of_expense-input" value="{{ old('date_of_expense', $date_of_expense) }}">
        @error('date_of_expense')
        <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    {{-- Approval input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="approval-input">Approval</label>
        <select id="approval-input" class="form-select h-100" name="approval" required>
            <option value="1">Approved</option>
            <option value="0">Not Approved</option>
        </select>
        @error('approval')
        <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>
    <div style="display: none"> {{ $grandtotal = 0 }} </div>
   <div>
    {{-- Item transactions --}}
    <div class="item-transactions-section">
        {{-- Table for item inputs --}}
        <table class="item-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="dynamic_field">
                @if ($expense != null)
                    @foreach($expense->expenseItems as $i => $item)
                        <tr id="row{{ $i }}">
                            <td>
                                <select name="items[{{ $i }}][id]" id="item_{{ $i }}" class="item-select" required>
                                    <option value="">Select an item</option>
                                         @foreach ($items as $availableItem)
                                            <option value="{{ $availableItem->id }}" 
                                                data-price="{{ $availableItem->price }}" 
                                                data-currency="{{ $availableItem->currency }}" 
                                                @if ((int) $item->expense_item_id === (int) $availableItem->id) selected @endif>
                                                {{ $availableItem->name }}
                                            </option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="items[{{ $i }}][price]" id="price_{{ $i }}" class="price-input" placeholder="Price" value="{{ $item->price }}" readonly required>
                            </td>
                            <td>
                                <input type="text" name="items[{{ $i }}][currency]" id="currency_{{ $i }}" class="currency-display" value="{{ $item->currency }}" readonly required>
                            </td>
                            <td>
                                <select name="items[{{ $i }}][quantity]" id="quantity_{{ $i }}" class="quantity-select">
                                    @for ($j = 1; $j <= 30; $j++)
                                        <option value="{{ $j }}" {{ $item->quantity == $j ? 'selected' : '' }}>{{ $j }}</option>
                                    @endfor
                                </select>
                            </td>
                            <div style="display: none"> {{ $grandtotal += $item->price * $item->quantity }} </div>
                            <td>
                                <span id="subtotal_{{ $i }}" class="subtotal-display">{{ $item->currency }}{{ number_format($item->price * $item->quantity, 2) }} </span>
                            </td>
                            <td>
                                <button type="button" class="btn_remove remove-btn" id="{{ $i }}">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" id="add" class="add-btn">Add Items</button>

        {{-- Grand total display --}}
        <div class="grand-total-container">
            <span id="grand_total_display" class="grand-total">Grand total: {{  number_format($grandtotal, 2) }}</span>
            <input type="number" id="total_amount" name="total_amount" value readonly hidden>
            <input class="form-control" type="text" id="currency" name="currency" readonly hidden>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        
        var i = $('#dynamic_field tr').length;  // Get the count of existing items (rows)

        // If no existing rows, set i to 1 for creating a new form
        if (i === 0) {
            i = 1;
        }
        

        // Add new item input row on button click
        $('#add').click(function() {
            $('#dynamic_field').append(`
                <tr id="row${i}">
                    <td>
                        <select name="items[${i}][id]" id="item_${i}" class="item-select" required>
                            <option value="">Select an item</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->price }}" data-currency="{{ $item->currency }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[${i}][price]" id="price_${i}" class="price-input" placeholder="Price" readonly required>
                    </td>
                    <td>
                        <input type="text" name="items[${i}][currency]" id="currency_${i}" class="currency-display" placeholder="Currency" readonly required>
                    </td>
                    <td>
                        <select name="items[${i}][quantity]" id="quantity_${i}" class="quantity-select">
                            @for ($j = 1; $j <= 30; $j++)
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <span id="subtotal_${i}" class="subtotal-display">Subtotal: $0.00</span>
                    </td>
                    <td>
                        <button type="button" class="btn_remove remove-btn" id="${i}">Remove</button>
                    </td>
                </tr>
            `);
            i++; // Increment the row counter
        });

        // Update price, currency, and subtotal when item or quantity changes
        $(document).on('change', '.item-select, .quantity-select', function() {
            const rowId = $(this).closest('tr').attr('id').split('row')[1];
            updateSubtotal(rowId);
            updateGrandTotal(); // Trigger grand total update after each item or quantity change
        });

        // Function to update subtotal when price, currency, or quantity changes
        function updateSubtotal(index) {
            const selectedItem = $(`#item_${index}`).find(':selected');
            const price = parseFloat(selectedItem.data('price')) || 0;
            const currency = selectedItem.data('currency') || '$';
            const quantity = parseInt($(`#quantity_${index}`).val()) || 1;
            const subtotal = price * quantity;

            // Update the price, currency, and subtotal display
            $(`#price_${index}`).val(price.toFixed(2));
            $(`#currency_${index}`).val(currency);
            $(`#subtotal_${index}`).text(`Subtotal: ${currency}${subtotal.toFixed(2)}`);
        }

        // Function to update grand total
        function updateGrandTotal() {
            let grandTotal = 0;
            let currency = '';

            // Iterate over each item row and calculate the grand total
            $('#dynamic_field tr').each(function() {
                const rowId = $(this).attr('id').split('row')[1];
                const price = parseFloat($(`#price_${rowId}`).val()) || 0;
                const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
                const rowCurrency = $(`#currency_${rowId}`).val();

                // Add the row's subtotal to the grand total
                grandTotal += price * quantity;

                // Set the currency based on the first row's currency
                if (currency === '') {
                    currency = rowCurrency;
                }
            });

            // Update the grand total display
            $('#grand_total_display').text(`Grand Total: ${currency}${grandTotal.toFixed(2)}`);
            $('#total_amount').val(grandTotal.toFixed(2));
            $('#currency').val(`${currency}`);
        }

        // Remove an item row on click
        $(document).on('click', '.btn_remove', function() {
            const button_id = $(this).attr('id');
            $('#row' + button_id).remove();

            // Recalculate the grand total after removing a row
            updateGrandTotal();
        });

        $(document).on('submit', 'form', function() {
            // Trigger change event on all selects and inputs to ensure final values are captured
            $('.item-select, .quantity-select').trigger('change');
        });
    });
</script>
