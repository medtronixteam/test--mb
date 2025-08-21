
@extends('layouts.warehouse')
@section('content')


    <div class="card mb-0">
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Pending <span
                            class="badge badge-white">{{ $pendingRefund }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Approved <span class="badge badge-primary">{{ $approvedRefunds }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rejected <span class="badge badge-primary">{{$cancelledRefunds}}</span></a>
                </li>
            </ul>
        </div>
    </div>


        <div class="card mt-1">
            <div class="card-header d-flex justify-content-between">
                <h3>Refunds List</h3>

            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Reason</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refunds as $p)
                                <tr>
                                    <td>{{ $p->return_id }}</td>

                                    <td>{{ $p->user->name ?? '' }}
                                        <br>
                                        {{ $p->user->number ?? '' }}
                                    </td>
                                    <td>{{ $p->refund_reason }}</td>
                                    <td>{{ $p->grand_total }}%</td>
                                    <td>{{ $p->status }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
