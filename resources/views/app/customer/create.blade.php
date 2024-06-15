@extends('theme.app')

@section('title', 'Customer List | Laundry')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Customer Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Customer</a>
                    <a class="breadcrumb-item" href="{{ route('customer.index') }}">Customer List</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Customer</h4>
                <div class="m-t-25">
                    <form action="{{ route('customer.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Name *</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="name" placeholder="Enter a Customer Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Customer Type</label>
                            <div class="col-md-5">
                                <select id="type_id" class="form-control" name="type_id">
                                    <option selected>Choose</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Phone Number *</label>
                            <div class="input-group col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" class="form-control" id="basic-url" name="phone_number" placeholder="Enter a Phone Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Address *</label>
                            <div class="col-md-5">
                                <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter a Address" required></textarea>
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
@endsection
