<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <div class="mb-5 row justify-content-center">
                <div class="col-12">
                    <div class="card " id="basic-info">
                        <div class="card-header">
                            <h5>Add Transaction</h5>
                        </div>
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <div class="pt-0 card-body">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group mb-0">
                                            <label for="propertyFormControlSelect1">Property</label>
                                            <span class="ms-2 text-xs font-italic">*Please select property below</span>
                                            @php
                                            $selected = old('property_id') ?? '-';
                                            @endphp
                                            <select name="property_id" class="form-control mb-0" id="propertyFormControlSelect1">
                                                @foreach($properties as $property)
                                                <option value="{{ $property->id }}" {{ $property->id == $selected ? 'selected' : '' }}>{{ $property->name }} (${{ number_format( $property->price, 2, '.', ',') }})</option>
                                                @endforeach
                                            </select>
                                        </div> @error('property_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3" id="sale_lease_price">
                                        <label for="price">Sale/Lease Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-body">$</span>
                                            <input type="price" required autocomplete="off" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="Example value 100,909.00">
                                        </div>
                                        @error('price')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <style>
                                        .div-style {
                                            display: flex;
                                            align-items: center;
                                            width: 100%;
                                            padding: 0.6875rem 0.75rem;
                                            font-size: 0.875rem;
                                            font-weight: 400;
                                            color: #495057;
                                            background-color: #fff;
                                            background-clip: padding-box;
                                            appearance: none;
                                        }
                                    </style>
                                    <div class="col-12" name="div-available-salesperson">
                                        <div class="form-group">
                                            <label for="salesPersonFormControlSelect1">Available Salesperson</label>
                                            <span class="ms-2 text-xs font-italic">*Please select salesperson to add commission</span>
                                            <div id="available-salesperson-list">
                                                @foreach($users as $user)
                                                <div class="div-style" name="button-available-salesperson" data-user-id="{{ $user->id }}">
                                                    <span class="me-2">{{ $user->name }}</span>
                                                    <button type="button" class="btn mb-0 btn-sm btn-outline-primary add-salesperson-btn">+</button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3" name="div-selected-salesperson">
                                        <label>Selected Salesperson</label>
                                        <div id="selected-salesperson-list">
                                            <!-- Selected salesperson will be added here -->
                                        </div>
                                        @error('commissions')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <a href="{{ route('transactions.index') }}" class="mt-6 mb-0 btn btn-danger btn-sm">Cancel</a>
                                <button type="submit" class="mt-6 mb-0 btn btn-success btn-sm float-end">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateAvailableSalespersons() {
                if ($("#available-salesperson-list .div-style").length === 0) {
                    $("#available-salesperson-list").append('<div class="div-style">None</div>');
                } else {
                    $("#available-salesperson-list .div-style:contains('None')").remove();
                }
            }

            $(document).on('click', '.add-salesperson-btn', function() {
                var userDiv = $(this).closest("[name='button-available-salesperson']");
                var userId = userDiv.data('user-id');
                var userName = userDiv.find("span").text();

                // Add to selected salesperson list
                var selectedSalespersonHtml = `
                    <div class="input-group mb-3" data-user-id="${userId}">
                        <span class="input-group-text text-body">${userName}</span>
                        <input type="number" name="commissions[${userId}]" class="form-control" placeholder="Fill in the commission in percentage (%)" min="0" max="100" step="0.01" required>
                        <button name="remove-button" type="button" class="btn mb-0 btn-sm btn-outline-danger remove-salesperson-btn">Remove</button>
                    </div>
                `;
                $("#selected-salesperson-list").append(selectedSalespersonHtml);

                // Remove from available salesperson list
                userDiv.remove();
                updateAvailableSalespersons();
            });

            $(document).on('click', '.remove-salesperson-btn', function() {
                var selectedDiv = $(this).closest(".input-group");
                var userId = selectedDiv.data('user-id');
                var userName = selectedDiv.find(".input-group-text").text();

                // Add back to available salesperson list
                var availableSalespersonHtml = `
                    <div class="div-style" name="button-available-salesperson" data-user-id="${userId}">
                        <span class="me-2">${userName}</span>
                        <button type="button" class="btn mb-0 btn-sm btn-outline-primary add-salesperson-btn">+</button>
                    </div>
                `;
                $("#available-salesperson-list").append(availableSalespersonHtml);

                // Remove from selected salesperson list
                selectedDiv.remove();
                updateAvailableSalespersons();
            });

            // Initial call to update available salespersons
            updateAvailableSalespersons();
        });
    </script>

</x-app-layout>