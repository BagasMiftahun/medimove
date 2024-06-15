@extends('theme.app')

@section('title', 'Perpindahan Obat | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Perpindahan Obat Create</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Perpindahan Obat</a>
                    <a class="breadcrumb-item" href="{{ route('perpindahan.index') }}">Perpindahan</a>
                    <span class="breadcrumb-item active">Create</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Perpindahan</h4>
                <div class="m-t-25">
                    <form action="{{ route('perpindahan.store') }}" method="POST" id="form-validation">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Formasi Awal</label>
                            <div class="col-md-5">
                                <select class="form-control" name="formasi_awal" id="formasi_awal" required>
                                    <option selected disabled>Choose</option>
                                    @foreach ($formasis as $formasi)
                                        <option value="{{ $formasi->id }}">{{ $formasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Formasi Tujuan</label>
                            <div class="col-md-5">
                                <select class="form-control" name="formasi_tujuan" required>
                                    <option selected disabled>Choose</option>
                                    @foreach ($formasis as $formasi)
                                        <option value="{{ $formasi->id }}">{{ $formasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Keterangan *</label>
                            <div class="col-md-5">
                                <textarea type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Enter a Keterangan" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Obat</label>
                            <div class="col-md-10">
                                <div id="obat-list">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Obat</th>
                                                <th>Kuantitas</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                <th>Total Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="obat-group">
                                                <td>
                                                    <select class="form-control obat-select" name="obat_id[]" required>
                                                        <option selected disabled>Choose Formasi Awal First</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control kuantitas" name="kuantitas[]" placeholder="Enter a Kuantitas" required disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control harga" name="harga[]" placeholder="Harga" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control satuan" name="satuan[]" placeholder="Satuan" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control total-harga" name="total_harga[]" placeholder="Total Harga" disabled>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger deleteObatBtn">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" id="addObatBtn" class="btn btn-primary mt-2">Add Obat</button>
                                </div>
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
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to toggle delete button visibility based on number of obat groups
            function toggleDeleteButtonVisibility() {
                $('.deleteObatBtn').toggle($('.obat-group').length > 1);
            }

            // Function to update total harga
            function updateTotalHarga(obatGroup) {
                var harga = parseFloat(obatGroup.find('.harga').val()) || 0;
                var kuantitas = parseFloat(obatGroup.find('.kuantitas').val()) || 0;
                var totalHarga = harga * kuantitas;
                obatGroup.find('.total-harga').val(totalHarga.toFixed(2));
            }

            // Initial toggle delete button visibility
            toggleDeleteButtonVisibility();

            // Formasi Awal change event
            $('#formasi_awal').change(function() {
                var formasi_id = $(this).val();
                if (formasi_id) {
                    $.ajax({
                        url: "{{ route('get.obat.by.formasi') }}",
                        type: "GET",
                        data: {
                            formasi_id: formasi_id
                        },
                        success: function(response) {
                            $('.obat-select').empty();
                            $('.obat-select').append('<option selected disabled>Choose</option>');
                            $.each(response, function(index, obat) {
                                $('.obat-select').append('<option value="' + obat.obat_id + '" data-stok="' + obat.stok + '" data-harga="' + obat.obat.harga + '" data-satuan="' + obat.obat.satuan + '">' + obat.obat.nama + '</option>');
                            });
                            $('.obat-select').prop('disabled', false);
                        }
                    });
                } else {
                    $('.obat-select').empty();
                    $('.obat-select').append('<option selected disabled>Choose Formasi Awal First</option>');
                    $('.kuantitas').val('');
                    $('.kuantitas').prop('disabled', true);
                }
            });

            // Add Obat button click event
            $('#addObatBtn').click(function() {
                var obatGroup = $('.obat-group').first().clone();
                obatGroup.find('.obat-select').val('');
                obatGroup.find('.kuantitas').val('');
                obatGroup.find('.harga').val('');
                obatGroup.find('.satuan').val('');
                obatGroup.find('.total-harga').val('');
                $('tbody').append(obatGroup);
                toggleDeleteButtonVisibility(); // Toggle delete button visibility
            });

            // Delete Obat button click event
            $(document).on('click', '.deleteObatBtn', function() {
                $(this).closest('.obat-group').remove();
                toggleDeleteButtonVisibility(); // Toggle delete button visibility
            });

            // Obat select change event
            $(document).on('change', '.obat-select', function() {
                var stok = $(this).find('option:selected').data('stok');
                var harga = $(this).find('option:selected').data('harga');
                var satuan = $(this).find('option:selected').data('satuan');
                var obatGroup = $(this).closest('.obat-group');
                obatGroup.find('.kuantitas').prop('disabled', false);
                obatGroup.find('.kuantitas').attr('max', stok);
                obatGroup.find('.harga').val(harga).prop('disabled', true);
                obatGroup.find('.satuan').val(satuan).prop('disabled', true);
                updateTotalHarga(obatGroup); // Update total harga
            });

            // Kuantitas input event
            $(document).on('input', '.kuantitas', function() {
                var kuantitas = $(this).val().trim();
                var stok = $(this).closest('.obat-group').find('.obat-select option:selected').data('stok');
                if (parseInt(kuantitas) > stok) {
                    alert('Kuantitas tidak boleh melebihi stok yang tersedia (' + stok + ')');
                    $(this).val(stok); // Set kuantitas to stok max value
                }
                updateTotalHarga($(this).closest('.obat-group')); // Update total harga
            });
        });
    </script>
@endsection
