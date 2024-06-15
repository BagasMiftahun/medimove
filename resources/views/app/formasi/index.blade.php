@extends('theme.app')

@section('title', 'Formasi | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Formasi</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Service</a>
                    <span class="breadcrumb-item active">Formasi</span>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#create-formasi">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Formasi</span>
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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formasis as $key => $formasi)
                                <tr>
                                    <td>#{{ $loop->iteration }}</td>
                                    <td>{{ $formasi->kode }}</td>
                                    <td>{{ $formasi->nama }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#edit-formasi-{{ $formasi->id }}">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                        <!-- Delete Button with Form -->
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#DeleteCSformasiModal-{{ $formasi->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSformasiModal-{{ $formasi->id }}" tabindex="-1"
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
                                                <form action="{{ route('formasi.destroy', $formasi->id) }}"
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
                                <div class="modal fade" id="edit-formasi-{{ $formasi->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit formasi</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('formasi.update', $formasi->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit-name">formasi Name *</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" placeholder="Please input type nama"
                                                            value="{{ $formasi->nama }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-name">kode *</label>
                                                        <input type="text" name="kode" class="form-control"
                                                            id="nama" placeholder="Please input kode"
                                                            value="{{ $formasi->kode }}" required>
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
        <div class="modal fade" id="create-formasi">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('formasi.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type-name">Type Name *</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    placeholder="Please input nama" required>
                            </div>
                            <div class="form-group">
                                <label for="type-name">Kode *</label>
                                <input type="text" name="kode" class="form-control" id="kode"
                                    placeholder="Please input kode" required>
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
