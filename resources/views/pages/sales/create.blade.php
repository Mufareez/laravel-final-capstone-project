@extends('layout.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Add Sales</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Sale</a></li>
                            <li class="breadcrumb-item active">Add Sale</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

         @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('{{ session('success') }}', 'Success');
                });
            </script>
        @endif

         @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('{{ session('error') }}', 'Error');
                });
            </script>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form action="{{ route('purchases.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Sale Information <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span></h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Customer <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="customer_id">
                                            <option selected disabled>Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Purchase Date <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" name="purchase_date" type="text"
                                            placeholder="DD-MM-YYYY">
                                    </div>
                                </div>

                                <hr>
                                <table class="table" id="purchaseItemsTable">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Selling Price</th>
                                            <th>Discount</th>
                                            <th>Final Price</th>
                                            <th>
                                                <button id="addRowBtn" type="button"
                                                    class="btn btn-primary add-product-btn"><i
                                                        class="feather-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <select class="form-control" name="product_id[]">
                                                    <option selected disabled>Select Product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            <td>
                                                <input type="number" class="form-control" name="quantity[]"
                                                    placeholder="Quantity">
                                            </td>

                                            <td>
                                                <input type="number" class="form-control" name="selling_price[]"
                                                    placeholder="Selling Price">
                                            </td>

                                             <td>
                                                <input type="number" class="form-control" name="discount[]"
                                                    placeholder="Cost Price">
                                            </td>

                                            <td>

                                                <input class="form-control" name="final_price[]" type="number">
                                            </td>
                                            <td>

                                                <button type="button" class="btn btn-danger removeRowBtn">
                                                    <i class="feather-trash-2"></i></button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- JavaScript --}}

    <script>
        $(document).ready(function() {

            $('#addRowBtn').on('click', function() {
                let newRow = $('#purchaseItemsTable tbody tr:first').clone();
                newRow.find('input, select').val('');
                $('#purchaseItemsTable tbody').append(newRow);
            });

            $(document).on('click', '.removeRowBtn', function() {
                if ($('#purchaseItemsTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                }
            });

        });
    </script>
@endsection
