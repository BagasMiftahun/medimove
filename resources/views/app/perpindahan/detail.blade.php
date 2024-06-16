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
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Perpindahan Obat</a>
                    <a class="breadcrumb-item" href="{{ route('perpindahan.index') }}">Perpindahan</a>
                    <span class="breadcrumb-item active">Detail</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <h4>Perpindahan #{{ $pindahs->nomor }}</h4>
                        <p>Formasi Awal : {{$pindahs->formasiAsal->nama}}</p>
                        <p>Formasi Akhir : {{$pindahs->formasiTujuan->nama}}</p>
                        <p>Keterangan : {{$pindahs->keterangan}}</p>
                    </div>
                    <div class="col-lg-4 text-right">
                        <h3>Tanggal : {{ $pindahs->created_at }}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="customerTable" class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Kuantitas</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalSemua = 0;
                            @endphp
                            @foreach ($pindahs->detailPerpindahan as $key => $pindah)
                                <tr>
                                    <td>#{{ $key + 1 }}</td>
                                    <td>{{ $pindah->obat->kode }}</td>
                                    <td>{{ $pindah->obat->nama }}</td>
                                    <td>{{ $pindah->obat->satuan }}</td>
                                    <td>{{ $pindah->kuantitas}}</td>
                                    <td>Rp {{ number_format(sprintf("%.2f", $pindah->obat->harga), 2, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $totalHarga = 0;
                                            $hargaObat = $pindah->obat->harga;
                                            $totalHarga = $hargaObat * $pindah->kuantitas;
                                            $totalSemua += $totalHarga;
                                        @endphp
                                        Rp {{ number_format(sprintf("%.2f", $totalHarga), 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
                                    <td><strong>Rp {{ number_format($totalSemua, 2, ',', '.') }}</strong></td>
                                </tr>
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
