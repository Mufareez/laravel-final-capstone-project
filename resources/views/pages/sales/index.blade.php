@extends('layout.app')
@section('content')
    <div class="content container-fluid">


        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Sale Records</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sale Records</li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-2">Sale Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice No</th>
                                        <th>Customer Name</th>
                                        <th>Sale Date</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Final Total</th>
                                        <th>View More</th>
                                    </tr>
                                </thead>
                                @foreach ($sales as $sale)
                                    <tbody>
                                        <tr>
                                            <td>{{ $sale->id }}</td>
                                            <td>{{ $sale->invoice_number }}</td>
                                            <td>{{ $sale->customer->customer_name }}</td>
                                            <td>{{ $sale->sale_date}}</td>
                                            <td>{{ $sale->total}}</td>
                                            <td>{{ $sale->final_discount}}</td>
                                            <td>{{ $sale->final_total}}</td>
                                            <td>
                                                <button  class="btn btn-primary btn-sm show-items"  data-items='@json($sale->saleItems)' >View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="saleItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Sellig Price</th>
                    <th>Discount</th>
                    <th>Final Price</th>
                </tr>
            </thead>
            <tbody id="modalItems">
                <!-- Items will be populated here -->
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(function () {
        $('.show-items').click(function () {
            let items = $(this).data('items');

            let tbody = $('#modalItems');
            tbody.empty();

            items.forEach((item, indexNo) => {
                let row = `<tr>
                    <td>${indexNo + 1}</td>
                    <td>${item.product?.product_name ?? 'N/A'}</td>
                    <td>${item.quantity}</td>
                    <td>${item.selling_price}</td>
                    <td>${item.discount}</td>
                    <td>${item.final_price}</td>
                </tr>`;
                tbody.append(row);
            });

            $('#saleItemModal').modal('show');
        });
    });
</script>

@endsection
