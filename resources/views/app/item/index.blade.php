@extends('theme.app')

@section('title', 'Items | Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Item</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Service</a>
                    <span class="breadcrumb-item active">Service Type</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10">
                                {{-- <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#create-item">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Item</span>
                        </button>
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
                    <table class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#edit-item-{{ $item->id }}">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                        <!-- Delete Button with Form -->
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#DeleteCSTypeModal-{{ $item->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSTypeModal-{{ $item->id }}" tabindex="-1"
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
                                                <form action="{{ route('item.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit service Type Modal -->
                                <div class="modal fade" id="edit-item-{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Item</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('item.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit-name">Item Name *</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" placeholder="Please input item name"
                                                            value="{{ $item->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        {{-- Create service Type  --}}
        <div class="modal fade" id="create-item">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Item</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('item.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="item-name">Item Name *</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Please input name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/e-commerce-order-list.js') }}"></script>
@endsection
