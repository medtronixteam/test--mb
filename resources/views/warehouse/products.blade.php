@extends('layouts.warehouse')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Product Lists</h3>
        </div>
        <div class="card-body mt-4">

            <div class="table-responsive">
                <table class="datatable table  table-bordered ">

                    <thead >
                        <tr>
                            <th>Name</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->mainCategory->name ?? '-' }}</td>
                                <td>{{ $p->subCategory->name ?? '-' }}</td>
                                <td>{{ $p->brand->name ?? '-' }}</td>
                                <td>{{ $p->price }}</td>
                                <td>{{ $p->discount }}%</td>
                                <td>{{ $p->isActive ? 'Yes' : 'No' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                responsive: true,
                pageLength: 10,
                // order: [[0, 'asc']],
            });
        });
    </script> --}}
