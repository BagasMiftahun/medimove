@extends('theme.app')

@section('title', 'Customer Type | Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Customer Type</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Customer</a>
                    <span class="breadcrumb-item active">Customer Type</span>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#create-customer-type">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Type</span>
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
                            @foreach ($types as $key => $type)
                                <tr>
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $type->type_name }}</td>
                                    <td>
                                        @if ($type->type_name != 'Baru' && $type->type_name != 'Tetap')
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                                data-target="#edit-customer-type-{{ $type->id }}">
                                                <i class="anticon anticon-edit"></i>
                                            </button>
                                            <!-- Delete Button with Form -->
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                                data-target="#DeleteCSTypeModal-{{ $type->id }}">
                                                <i class="anticon anticon-delete"></i>
                                            </button>                                            
                                        @endif
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSTypeModal-{{ $type->id }}" tabindex="-1"
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
                                                <form action="{{ route('customer-type.destroy', $type->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Customer Type Modal -->
                                <div class="modal fade" id="edit-customer-type-{{ $type->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Customer Type</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('customer-type.update', $type->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit-type-name">Type Name *</label>
                                                        <input type="text" name="type_name" class="form-control"
                                                            id="edit-type-name" placeholder="Please input type name"
                                                            value="{{ $type->type_name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-description">Description</label>
                                                        <textarea type="text" id="description" name="description" class="form-control" placeholder="">{{ $type->description }}</textarea>
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

        {{-- Create Customer Type  --}}
        <div class="modal fade" id="create-customer-type">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('customer-type.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type-name">Type Name *</label>
                                <input type="text" name="type_name" class="form-control" id="type-name"
                                    placeholder="Please input type name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" name="description" class="form-control" placeholder=""></textarea>
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
