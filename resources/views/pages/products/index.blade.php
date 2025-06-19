@extends('layout.app')
@section('content')
    <div class="content container-fluid">



        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('{{ session('success') }}', 'Success');
                });
            </script>
        @endif


        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Product Records</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Records</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-2">Product Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SKU</th>
                                        <th>Product Name</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Brand Name</th>
                                        <th>Category Name</th>
                                        <th>Product Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $product)
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->cost_price }}</td>
                                            <td>{{ $product->selling_price }}</td>
                                            <td>{{ $product->brand->brand_name }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>
                                                @if ($product->product_image)
                                                    <img src="{{ asset('images/product/' . $product->product_image) }}"
                                                        alt="Product Image" width="50px" height="50px">
                                                @else
                                                    <img src="{{ asset('images/product/default-img.png') }}"
                                                        alt="No Image" width="50px" height="50px">

                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit</a>
                                                <form id="deleteRecord-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete({{ $product->id}})" class="btn btn-danger">Delete</button>
                                                </form>
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

    <script>
        function confirmDelete(id) {
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
               document.getElementById('deleteRecord-'+id).submit();
            }
            });
        }
    </script>

@endsection
