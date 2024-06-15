@extends('theme.app')

@section('title', 'Stok Obat | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Stok Obat Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Stok Obat</a>
                    <a class="breadcrumb-item" href="{{ route('stok-obat.index') }}">Stok Obat</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Stok Obat</h4>
                <div class="m-t-25">
                    <form action="{{ route('stok-obat.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Formasi</label>
                            <div class="col-md-5">
                                <select class="form-control" name="formasi_id" required>
                                    <option selected>Choose</option>
                                    {{-- @foreach ($formasis as $formasi)
                                    <option value="{{ $formasi->id }}" data-order-date="{{ $order->order_date }}">{{ $order->customer->name }}</option>
                                    @endforeach --}}
                                    @foreach ($formasis as $formasi)
                                    <option value="{{ $formasi->id }}">{{ $formasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Obat</label>
                            <div class="col-md-5">
                                <select class="form-control" id="obat-select" name="obat_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Harga *</label>
                            <div class="input-group col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="harga" placeholder="Enter a Harga" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Stok *</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Enter a Stok" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Sub Total *</label>
                            <div class="input-group col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="sub_total" name="sub_total" placeholder="Enter a Sub Total" required disabled>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-elements.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#obat-select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var harga = parseFloat(selectedOption.data('harga'));
                $('#harga').val(formatRupiah(harga));
                calculateSubtotal();
            });

            $('#stok').on('input', function() {
                calculateSubtotal();
            });

            function calculateSubtotal() {
                var harga = parseFloat($('#harga').val().replace(/[^0-9,-]+/g,"").replace(",", "."));
                var stok = parseFloat($('#stok').val());

                if (!isNaN(harga) && !isNaN(stok)) {
                    var subtotal = harga * stok;
                    $('#sub_total').val(formatRupiah(subtotal));
                }
            }

            function formatRupiah(angka) {
                var parts = angka.toFixed(2).split('.');
                var integerPart = parts[0];
                var decimalPart = parts[1];
                var sisa = integerPart.length % 3;
                var rupiah = integerPart.substr(0, sisa);
                var ribuan = integerPart.substr(sisa).match(/\d{3}/g);
                
                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return 'Rp. ' + rupiah + ',' + decimalPart;
            }
        });
    </script>
@endsection
