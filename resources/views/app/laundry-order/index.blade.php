@extends('theme.app')

@section('title', 'Laundry Order | Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Laundry Order</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Laundry</a>
                    <span class="breadcrumb-item active">Laundry Order</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            {{-- <div class="m-b-10 mr-15">
                                <select id="filterType" class="custom-select" style="min-width: 180px;">
                                    <option value="">All Types</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>                                    
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="m-b-10">
                                <select id="statusFilter" class="custom-select" style="min-width: 180px;">
                                    <option value="all">Choose</option>
                                    <option value="received">Received</option>
                                    <option value="in_process">In Process</option>
                                    <option value="washing">Washing</option>
                                    <option value="drying">Drying</option>
                                    <option value="ironing">Ironing</option>
                                    <option value="completed">Completed</option>
                                    <option value="ready_for_pickup">Ready for Pickup</option>
                                    <option value="out_for_delivery">Out for Delivery</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="on_hold">On Hold</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="{{ route('laundry-order.create') }}" class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Order</span>
                        </a>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-primary alert-dismissible fade show">
                        <p>{{ session('success') }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="customerTable" class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Order Date</th>
                                <th>Due Date</th>
                                <th>Pickup Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr class="orderRow" data-status="{{ $order->status }}">
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->due_date }}</td>
                                    <td>{{ $order->pickup_date }}</td>
                                    <td>
                                        @if ($order->orderitems->isEmpty())
                                            <a href="{{ route('order-item.index') }}">
                                                <button class="btn btn-warning btn-tone m-r-5">Set Amount</button>
                                            </a>
                                        @else
                                            Rp {{ number_format($order->totalAmount, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($order->status == 'received')
                                                <div class="badge badge-success badge-dot m-r-10"></div>
                                                <div>Received</div>
                                            @elseif($order->status == 'in_process')
                                                <div class="badge badge-warning badge-dot m-r-10"></div>
                                                <div>In Process</div>
                                            @elseif($order->status == 'washing')
                                                <div class="badge badge-info badge-dot m-r-10"></div>
                                                <div>Washing</div>
                                            @elseif($order->status == 'drying')
                                                <div class="badge badge-primary badge-dot m-r-10"></div>
                                                <div>Drying</div>
                                            @elseif($order->status == 'ironing')
                                                <div class="badge badge-secondary badge-dot m-r-10"></div>
                                                <div>Ironing</div>
                                            @elseif($order->status == 'completed')
                                                <div class="badge badge-light badge-dot m-r-10"></div>
                                                <div>Completed</div>
                                            @elseif($order->status == 'delivered')
                                                <div class="badge badge-dark badge-dot m-r-10"></div>
                                                <div>Delivered</div>
                                            @elseif($order->status == 'cancelled')
                                                <div class="badge badge-success badge-dot m-r-10"></div>
                                                <div>Cancelled</div>
                                            @elseif($order->status == 'on_hold')
                                                <div class="badge badge-danger badge-dot m-r-10"></div>
                                                <div>On Holed</div>
                                            @else
                                                <div class="badge badge-secondary badge-dot m-r-10"></div>
                                                <div>Unknown</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('laundry-order.edit', ['laundry_order' => $order->id]) }}" class="btn btn-icon btn-hover btn-sm btn-rounded">
                                            <i class="anticon anticon-edit"></i>
                                        </a>                             
                                        <!-- Delete Button with Form -->
                                        {{-- <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#DeleteCSModal-{{ $order->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button> --}}
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal" data-target="#DeleteCSModal-{{ $order->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSModal-{{ $order->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this data?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <form action="{{ route('laundry-order.destroy', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/e-commerce-order-list.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#statusFilter').change(function(){
                var status = $(this).val();
                if(status === 'all'){
                    $('.orderRow').show();
                } else {
                    $('.orderRow').hide();
                    $('.orderRow[data-status="' + status + '"]').show();
                }
            });
        });
        
    </script>
@endsection
