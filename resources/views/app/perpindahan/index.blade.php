use App\Http\Controllers\StokObatController;
@extends('theme.app')

@section('title', 'Perpindahan | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Perpindahan</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-schedule m-r-5"></i>MediMove</a>
                    <span class="breadcrumb-item active">Perpindahan</span>
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
                            {{-- <div class="m-b-10">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="{{ route('perpindahan.create') }}" class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Perpindahan</span>
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
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Formasi Asal</th>
                                <th>Formasi Tujuan</th>
                                <th>Keterangan</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pindahs as $key => $pindah)
                                <tr>
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $pindah->nomor }}</td>
                                    <td>{{ $pindah->created_at }}</td>
                                    <td>{{ $pindah->formasiAsal->nama ?? ''}}</td>
                                    <td>{{ $pindah->formasiTujuan->nama ?? ''}}</td>
                                    <td>{{ $pindah->keterangan}}</td>
                                    <td>
                                        @php
                                            $totalHarga = 0;
                                            foreach ($pindah->detailPerpindahan as $detail) {
                                                $hargaObat = $detail->obat->harga;
                                                $totalHarga += $hargaObat * $detail->kuantitas;
                                            }
                                        @endphp
                                        Rp {{ number_format(sprintf("%.2f", $totalHarga), 2, ',', '.') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('perpindahan.show', ['perpindahan' => $pindah->id]) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                    <i class="anticon anticon-profile"></i>
                                            </button>                             
                                        </a>
                                        <a href="{{ route('perpindahan.edit', ['perpindahan' => $pindah->id]) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                    <i class="anticon anticon-edit"></i>
                                            </button>                             
                                        </a>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal" data-target="#DeleteCSModal-{{ $pindah->id }}">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="DeleteCSModal-{{ $pindah->id }}" tabindex="-1"
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
                                                <form action="{{ route('perpindahan.destroy', $pindah->id) }}"
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
    {{-- <script>
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
        
    </script> --}}
@endsection
