@extends('theme.app')

@section('title', 'Payment| Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Payment Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Laundry</a>
                    <a class="breadcrumb-item" href="{{ route('payment.index') }}">Payment</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Payment</h4>
                <div class="m-t-25">
                    <form action="{{ route('payment.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Customer</label>
                            <div class="col-md-5">
                                <select class="form-control" id="customer-select" name="order_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($orders as $order)
                                    <option value="{{ $order->id }}" data-order-date="{{ $order->order_date }}" data-total-amount="{{ $order->total_amount }}">{{ $order->customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Order Date</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" id="order-date" placeholder="Pick a date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Amount</label>
                            <div class="input-group col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="sub_total" name="sub_total" placeholder="Enter a Sub Total" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Payment Date</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" id="payment-date" placeholder="Pick a date" name="payment_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Payment Method</label>
                            <div class="col-md-5">
                                <select class="form-control" name="payment_method" required>
                                    <option selected>Choose</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
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
                var totalAmount = selectedOption.data('total-amount');

                $('#order-date').val(orderDate);
                $('#sub_total').val(formatRupiah(totalAmount));
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
