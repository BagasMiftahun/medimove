@extends('theme.app')

@section('title', 'Laundry Order| Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Laundry Order Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Laundry</a>
                    <a class="breadcrumb-item" href="{{ route('laundry-order.index') }}">Laundry Order</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Laundry Order</h4>
                <div class="m-t-25">
                    <form action="{{ route('laundry-order.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Customer</label>
                            <div class="col-md-5">
                                <select id="type_id" class="form-control" name="customer_id" required>
                                    <option selected>Choose</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Order Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="order_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Due Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="due_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Pickup Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="pickup_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Status *</label>
                            <div class="col-md-5">
                                <select id="status" class="form-control" name="status" required>
                                    <option selected>Choose</option>
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
@endsection
