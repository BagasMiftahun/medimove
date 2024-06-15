@extends('theme.app')

@section('title', 'Service | Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Service</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Service</a>
                    <span class="breadcrumb-item active">Service</span>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#create-service">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Service</span>
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
                                <th>Item</th>
                                <th>Type</th>
                                <th>Unit Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $key => $service)
                                <tr>
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $service->item->name ?? '-' }}</td>
                                    <td>{{ $service->serviceType->name }}</td>
                                    <td>Rp {{ number_format($service->unit_price, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#edit-service-{{ $service->id }}">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                        <!-- Delete Button with Form -->
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal"
                                            data-target="#DeleteCSTypeModal-{{ $service->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSTypeModal-{{ $service->id }}" tabindex="-1"
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
                                                <form action="{{ route('service.destroy', $service->id) }}"
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
                                <div class="modal fade" id="edit-service-{{ $service->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit service</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('service.update', $service->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="item">Item *</label>
                                                        <select id="item_id" class="form-control" name="item_id">
                                                            <option selected>Choose</option>
                                                            @foreach ($items as $item)
                                                                @if ($item->id == $service->item_id)
                                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                                @else
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="item">Type *</label>
                                                        <select id="type_id" class="form-control" name="type_id">
                                                            <option selected>Choose</option>
                                                            @foreach ($types as $type)
                                                                @if ($type->id == $service->type_id)
                                                                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                                                @else
                                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Unit Price *</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="rupiah form-control" id="unit_price" name="unit_price" placeholder="Enter a Unit Price" value="{{ $service->unit_price }}" required>
                                                        </div>
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
        <div class="modal fade" id="create-service">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Service</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('service.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="item">Item *</label>
                                <select id="item_id" class="form-control" name="item_id">
                                    <option selected value="">Choose</option>
                                    @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="item">Type *</label>
                                <select id="type_id" class="form-control" name="type_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Unit Price *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="rupiah form-control" id="unit_price" name="unit_price" placeholder="Enter a Unit Price" required>
                                </div>
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
    <script>
        $(document).ready(function() {
            // Fungsi untuk memformat input Sub Total menjadi format Rupiah
            $('.rupiah').on('input', function() {
                // Hapus semua karakter selain angka
                var subTotal = $(this).val().replace(/\D/g, '');
                // Format angka menjadi format Rupiah
                $(this).val(formatRupiah(subTotal));
            });
            
            // Fungsi untuk memformat angka menjadi format Rupiah
            function formatRupiah(angka) {
                var number_string = angka.toString().replace(/\D/g, '');
                var split = number_string.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);
                
                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }
        });
    </script>
@endsection
