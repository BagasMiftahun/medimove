@extends('theme.app')

@section('title', 'Laundry Order| Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Laundry Order Edit</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Laundry</a>
                    <a class="breadcrumb-item" href="{{ route('laundry-order.index') }}">Laundry Order</a>
                    <span class="breadcrumb-item active">Edit</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Laundry Order</h4>
                <div class="m-t-25">
                    <form action="{{ route('laundry-order.update', $order->id) }}" method="POST" id="form-validation">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Customer</label>
                            <div class="col-md-5">
                                <select id="type_id" class="form-control" name="customer_id" required>
                                    <option disabled>Choose</option>
                                    @foreach ($customers as $customer)
                                        @if ($customer->id == $order->customer_id)
                                            <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                                        @else
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Order Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="order_date" value="{{ $order->order_date }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Due Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="due_date" value="{{ $order->due_date }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Pickup Date *</label>
                            <div class="col-md-5">
                                <div class="input-affix m-b-10">
                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                    <input type="text" class="form-control datepicker-input" placeholder="Pick a date" name="pickup_date" value="{{ $order->pickup_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Status *</label>
                            <div class="col-md-5">
                                <select id="status" class="form-control" name="status" required>
                                    <option value="">Choose</option>
                                    <option value="received" {{ $order->status == 'received' ? 'selected' : '' }}>Received</option>
                                    <option value="in_process" {{ $order->status == 'in_process' ? 'selected' : '' }}>In Process</option>
                                    <option value="washing" {{ $order->status == 'washing' ? 'selected' : '' }}>Washing</option>
                                    <option value="drying" {{ $order->status == 'drying' ? 'selected' : '' }}>Drying</option>
                                    <option value="ironing" {{ $order->status == 'ironing' ? 'selected' : '' }}>Ironing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="ready_for_pickup" {{ $order->status == 'ready_for_pickup' ? 'selected' : '' }}>Ready for Pickup</option>
                                    <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="on_hold" {{ $order->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
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
