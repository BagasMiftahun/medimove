@extends('theme.app')

@section('title', 'Order Item| Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Order Item Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Laundry</a>
                    <a class="breadcrumb-item" href="{{ route('order-item.index') }}">Order Item</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Order Item</h4>
                <div class="m-t-25">
                    <form action="{{ route('order-item.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Customer</label>
                            <div class="col-md-5">
                                <select class="form-control" id="customer-select" name="order_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($orders as $order)
                                    <option value="{{ $order->id }}" data-order-date="{{ $order->order_date }}">{{ $order->customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Order Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" id="order-date" placeholder="Pick a date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Service</label>
                            <div class="col-md-5">
                                <select class="form-control" name="service_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->item->name ?? ''}} {{  $service->serviceType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Quantity *</label>
                            <div class="input-group col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kg / Item</span>
                                </div>
                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter a Quantity" required>
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
            $('#customer-select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var orderDate = selectedOption.data('order-date');
                $('#order-date').val(orderDate);
            });

            // Tangkap perubahan pada elemen select service_id dan input quantity
            $('select[name="service_id"], #quantity').on('input', function() {
                // Dapatkan nilai service_id dan quantity
                var serviceId = $('select[name="service_id"]').val();
                var quantity = $('#quantity').val();

                // Periksa apakah kedua nilai tersebut telah diisi
                if (serviceId && quantity) {
                    // Request ke server untuk mendapatkan harga unit
                    $.ajax({
                        url: '/services/' + serviceId + '/unit-price', // Anda perlu menyesuaikan URL ini dengan endpoint yang sesuai
                        type: 'GET',
                        success: function(response) {
                            var unitPrice = response.unit_price;
                            // Hitung dan tampilkan subtotal
                            var subtotal = unitPrice * parseFloat(quantity);
                            $('#sub_total').val(formatRupiah(subtotal));
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
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
