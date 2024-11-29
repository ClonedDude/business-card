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
        <input class="form-control details" type="text" name="additional_details" id="additional_details-input" value="{{ old('additional_details', $additional_details) }}">
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
        @if($expense != null) {{-- for expense edit view --}}
            <option value="0" @if($expense->approval==0) selected @endif>Pending</option>
            <option value="1" @if($expense->approval==1) selected @endif> Approved</option>
            <option value="2" @if($expense->approval==2) selected @endif>Rejected</option>
        @else() { {{-- For expense create --}}
            <option selected value="0">Not Approved</option>
        }
        @endif
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
                                <input type="text" id="search-item_{{ $i }}" class="form-control search-item"  list="item-options_{{ $i }}" placeholder="Type to search items" 
                                value="{{ $item->item->name}}"> <!-- Pre-fill with the item name -->                                
                                <input type="hidden" name="items[{{ $i }}][item_id]" id="item_id_{{ $i }}"  value="{{ $item->item->id }}">
                                <datalist data-id="{{ $item->item->id }}" id="item-options_{{ $i }}"></datalist>  <!-- Datalist for search results -->
                            </td>
                            <td>
                                <input type="number" name="items[{{ $i }}][price]" id="price_{{ $i }}" class="price-input" placeholder="Price" value="{{ $item->price }}"  required>
                            </td>
                            <td>
                                <input type="text" name="items[{{ $i }}][currency]" id="currency_{{ $i }}" class="currency-display" value="{{ $item->currency }}"  required>
                            </td>
                            <td>
                                <input type="number" name="items[{{ $i }}][quantity]" id="quantity_{{ $i }}" class="form-control quantity-input" value="{{ $item->quantity }}" required>
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
            <span id="grand_total_display" class="grand-total">
                Grand total: 
                {{ optional($expense)->currency }}
                {{  number_format($grandtotal, 2) }}
            </span>
            <input type="number" id="total_amount" name="total_amount" value="{{ number_format((float)($grandtotal ?? 0), 2, '.', '') }}" readonly hidden>
            <input class="form-control" type="text" id="currency" name="currency" value="{{ $expense->currency }}" readonly hidden>
        </div>
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
                        <input type="text" id="search-item_${i}" class="form-control search-item" list="item-options_${i}" placeholder="Type to search items">
                        <input type="hidden" name="items[${i}][item_id]" id="item_id_${i}" value="">
                        <datalist id="item-options_${i}"> </datalist>  <!-- Datalist for search results -->
                        </td>
                    <td>
                        <input type="number" name="items[${i}][price]" id="price_${i}" class="price-input" placeholder="Price" required>
                    </td>
                    <td>
                        <input type="text" name="items[${i}][currency]" id="currency_${i}" class="currency-display" placeholder="Currency" required>
                    </td>
                    <td>
                        <input type="number" name="items[${i}][quantity]" id="quantity_${i}" class="form-control quantity-input" value="" min="1" required>
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

        $(document).on('change', '.quantity-select', function() {
            const rowId = $(this).closest('tr').attr('id').split('row')[1];
            updateSubtotal(rowId);  // Update subtotal based on the new quantity
            updateGrandTotal();     // Update grand total
        });

        $(document).on('input', '.quantity-input', function() {
            const rowId = $(this).closest('tr').attr('id').split('row')[1];
            updateSubtotal(rowId);  // Update subtotal based on the new quantity
            updateGrandTotal();     // Update grand total
        });

        document.getElementById('date_of_expense-input').addEventListener('click', function() {
            this.showPicker();  // Opens the date picker programmatically
        });

        // Function to update subtotal when price, currency, or quantity changes
        function updateSubtotal(rowId) {
            const selectedItem = $(`#item-list_${rowId}`).find(':selected');
            const price = parseFloat(selectedItem.data('price')) || 0;
            const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
            const currency = selectedItem.data('currency') || '$';
            const subtotal = price * quantity;

            // Update the price, currency, and subtotal display
            $(`#price_${rowId}`).val(price.toFixed(2));
            $(`#currency_${rowId}`).val(currency);
            $(`#subtotal_${rowId}`).text(`${currency}${subtotal.toFixed(2)}`);
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
    
    $(document).on('input', '.quantity-input', function() {
        const quantity = $(this).val();
    
        if (quantity < 1) {
            $(this).val(1);  // If quantity is less than 1, reset it to 1
        }
    });

    // Highlight search input on click for easier editing
    $(document).on('click', '.search-item', function() {
        $(this).select();  // Selects all text in the input for easy editing
        });


    $(document).on('keyup', '.search-item', function() {
        const query = $(this).val();  // User's input value
        const rowId = $(this).attr('id').split('_')[1];  // Get row index
        const datalist = $(`#item-options_${rowId}`);  // Reference to datalist for this row


        // Check if the query length is sufficient for a search
        if (query.length >= 2) {
            $.ajax({
                url: '{{ route("expenses.search-items") }}',  // Server-side search route
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    datalist.empty();  // Clear previous search results

                    // Add each item as an option in the datalist
                    response.items.forEach(item => {
                        datalist.append(`
                            <option data-id="${item.id}" data-price="${item.price}" data-currency="${item.currency}" value="${item.name}">
                        `);
                    });
                }
            });
        }
    });

      // Handle the selection from the datalist
      $(document).on('input', '.search-item', function() {
        const rowId = $(this).attr('id').split('_')[1];
        const selectedValue = $(this).val();  // Get the selected value from datalist
        const selectedOption = $(`#item-options_${rowId} option`).filter(function() {
            return this.value === selectedValue;
        });

        if (selectedOption.length > 0) {
            // Extract item data from the selected option
            const itemId = selectedOption.data('id');
            const price = parseFloat(selectedOption.data('price')) || 0;
            const currency = selectedOption.data('currency');

            // Update hidden item ID and display fields for price and currency
            $(`#item_id_${rowId}`).val(itemId);
            $(`#price_${rowId}`).val(price.toFixed(2));
            $(`#currency_${rowId}`).val(currency);
            $(`#currency_${rowId}`).prop('readonly', true); // Make currency readonly
            $(`#price_${rowId}`).prop('readonly', true); // Make price readonly


            // Update subtotal and grand total
            const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
            const subtotal = price * quantity;
            $(`#subtotal_${rowId}`).text(`${currency}${subtotal.toFixed(2)}`);
            updateGrandTotal();
        }
        if (!selectedOption.length) {
            const itemId = selectedOption.data('id');
            const price = parseFloat(selectedOption.data('price')) || 0;
            const currency = selectedOption.data('currency');

            // If empty, make price and currency inputs editable
            $(`#price_${rowId}`).prop('readonly', false);
            $(`#currency_${rowId}`).prop('readonly', false);

            // Clear hidden item ID, price, currency. and quantity values
            $(`#item_id_${rowId}`).val('');
            $(`#price_${rowId}`).val('');
            $(`#currency_${rowId}`).val('');
            $(`#quantity_${rowId}`).val('');

            // Update subtotal and grand total
            const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
            const subtotal = price * quantity;
            $(`#subtotal_${rowId}`).text(`${currency ? currency : ''}${subtotal.toFixed(2)}`);
            updateGrandTotal();
        }
    });


    // Item selection on search result click
    $(document).on('click', '.search-result', function() {
        const rowId = $(this).closest('td').find('.search-item').attr('id').split('_')[1];  // Get the row index
        const itemId = $(this).data('id');  // Get the item ID from the clicked result
        let price = $(this).data('price');  // Get the item price from the clicked result
        const currency = $(this).data('currency');  // Get the item currency from the clicked result

        // Check if `price` is a valid number, otherwise default to 0
        price = parseFloat(price) || 0;

        // Set the hidden item ID and display the selected item details in the appropriate fields
        $(`#item_id_${rowId}`).val(itemId);  // Set the item ID
        $(`#price_${rowId}`).val(price.toFixed(2));  // Set the price
        $(`#currency_${rowId}`).val(currency);  // Set the currency

        // Update the subtotal based on selected item and default quantity
        const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
        const subtotal = price * quantity;
        $(`#subtotal_${rowId}`).text(`${currency}${subtotal.toFixed(2)}`);

        // Clear the search results after an item is selected
        $(`#item-list-container_${rowId}`).empty();

        // Update the grand total
        updateGrandTotal();
    });

    // Update subtotal when quantity changes without affecting the search result box
    $(document).on('input', '.quantity-input', function() {
        const rowId = $(this).closest('tr').attr('id').split('row')[1];
        updateSubtotal(rowId);
        updateGrandTotal();
    });

    function updateSubtotal(rowId) {
        const price = parseFloat($(`#price_${rowId}`).val()) || 0;
        const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
        const currency = $(`#currency_${rowId}`).val();
        const subtotal = price * quantity;
        $(`#subtotal_${rowId}`).text(`${currency}${subtotal.toFixed(2)}`);
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        let currency = '';

        $('#dynamic_field tr').each(function() {
            const rowId = $(this).attr('id').split('row')[1];
            const price = parseFloat($(`#price_${rowId}`).val()) || 0;
            const quantity = parseInt($(`#quantity_${rowId}`).val()) || 1;
            const rowCurrency = $(`#currency_${rowId}`).val();

            grandTotal += price * quantity;

            if (currency === '') {
                currency = rowCurrency;
            }
        });

        $('#grand_total_display').text(`Grand Total: ${currency}${grandTotal.toFixed(2)}`);
        $('#total_amount').val(grandTotal.toFixed(2));
        $('#currency').val(`${currency}`);
    }

    
    });
</script>
