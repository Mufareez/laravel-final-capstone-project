@extends('layout.app')
@section('content')
    <div class="content container-fluid">


        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Brand Records</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brand Records</li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-2">Brand Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Supplier Name</th>
                                        <th>Purchase Date</th>
                                        <th>View More</th>
                                    </tr>
                                </thead>
                                @foreach ($purchases as $purchase)
                                    <tbody>
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->supplier->supplier_name }}</td>
                                            <td>{{ $purchase->purchase_date }}</td>
                                            <td>
                                                <button  class="btn btn-primary btn-sm show-items" data-supplier='@json($purchase->supplier->supplier_name)' data-items='@json($purchase->purchasItems)' >View</button>
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
<div class="modal fade" id="purchaseItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="supplierName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Max Retail Price</th>
                    <th>Expire Date</th>
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
            let suppliers = $(this).data('supplier');

            $('#supplierName').text(suppliers);

            let tbody = $('#modalItems');
            tbody.empty();

            items.forEach((item, indexNo) => {
                let row = `<tr>
                    <td>${indexNo + 1}</td>
                    <td>${item.product?.product_name ?? 'N/A'}</td>
                    <td>${item.quantity}</td>
                    <td>${item.cost_price}</td>
                    <td>${item.selling_price}</td>
                    <td>${item.expire_date}</td>
                </tr>`;
                tbody.append(row);
            });

            $('#purchaseItemModal').modal('show');
        });
    });
</script>

@endsection
