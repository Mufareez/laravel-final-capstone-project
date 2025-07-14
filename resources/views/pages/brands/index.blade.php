@extends('layout.app')
@section('content')
    <div class="content container-fluid">



        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success("{{ session('success') }}", 'Success');
                });
            </script>
        @endif


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
                                        <th>Brand Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($values as $brand)
                                    <tbody>
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td>{{ $brand->description ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary">Edit</a>
                                                <form id="deleteRecord-{{ $brand->id }}" action="{{ route('brands.destroy', $brand) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete({{ $brand->id}})" class="btn btn-danger">Delete</button>
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
