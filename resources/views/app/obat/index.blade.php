@extends('theme.app')

@section('title', 'Obat | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Obat</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Obat</a>
                    <span class="breadcrumb-item active">Obat</span>
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
                                    <option value="tablet">Tablet</option>
                                    <option value="capsul">Capsul</option>
                                    <option value="botol">Botol</option>
                                    <option value="box">Box</option>
                                </select> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#create-obat">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Obat</span>
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
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $index => $obat)
                                <tr>
                                    <td>#{{ $index+1 }}</td>
                                    <td>{{ $obat->kode }}</td>
                                    <td>{{ $obat->nama }}</td>
                                    <td>{{ $obat->satuan }}</td>
                                    <td>{{ $obat->harga }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#edit-obat-{{ $obat->id }}">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                        <!-- Delete Button with Form -->
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#DeleteCSTypeModal-{{ $obat->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>                                            
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSTypeModal-{{ $obat->id }}" tabindex="-1"
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
                                                <form action="{{ route('obat.destroy', $obat->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Obat Modal -->
                                <div class="modal fade" id="edit-obat-{{ $obat->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Obat</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit-type-name">Nama obat *</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="edit-type-name" placeholder="Please input type name"
                                                            value="{{ $obat->nama }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Satuan</label>
                                                        <div class="">
                                                            <select id="satuan" class="form-control" name="satuan" required>
                                                                <option disabled>Choose</option>
                                                                <option value="TABLET" {{ $obat->satuan == 'TABLET' ? 'selected' : '' }}>Tablet</option>
                                                                <option value="CAPSUL" {{ $obat->satuan == 'CAPSUL' ? 'selected' : '' }}>Capsul</option>
                                                                <option value="BOTOL" {{ $obat->satuan == 'BOTOL' ? 'selected' : '' }}>Botol</option>
                                                                <option value="BOX" {{ $obat->satuan == 'BOX' ? 'selected' : '' }}>Box</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="">Harga *</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter a Harga" value="{{ $obat->harga }}" required>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="edit-description">Description</label>
                                                        <textarea type="text" id="description" name="description" class="form-control" placeholder="">{{ $obat->description }}</textarea>
                                                    </div> --}}
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

        {{-- Create Obat  --}}
        <div class="modal fade" id="create-obat">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Obat</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('obat.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type-name">Nama obat *</label>
                                <input type="text" name="nama" class="form-control" id="type-name"
                                    placeholder="Please input type name" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <div class="">
                                    <select id="satuan" class="form-control" name="satuan" required>
                                        <option selected>Choose</option>
                                        <option value="TABLET">Tablet</option>
                                        <option value="CAPSUL">Capsul</option>
                                        <option value="BOTOL">Botol</option>
                                        <option value="BOX">Box</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Harga *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter a Harga" required>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" name="description" class="form-control" placeholder=""></textarea>
                            </div> --}}
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
