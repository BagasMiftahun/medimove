@extends('theme.app')

@section('title', 'Perpindahan Obat | MediMove')

@section('style')
    <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <style>
        .obat-group {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Perpindahan Obat Edit</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-user m-r-5"></i>Perpindahan Obat</a>
                    <a class="breadcrumb-item" href="{{ route('perpindahan.index') }}">Perpindahan</a>
                    <span class="breadcrumb-item active">Edit</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Perpindahan</h4>
                <div class="m-t-25">
                    <form action="{{ route('perpindahan.update', $pindah->id) }}" method="POST" id="form-validation">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Formasi Awal</label>
                            <div class="col-md-5">
                                <select class="form-control" name="formasi_awal" id="formasi_awal" required>
                                    <option selected disabled>Choose</option>
                                    @foreach ($formasis as $formasi)
                                        <option value="{{ $formasi->id }}" {{ $pindah->formasi_awal == $formasi->id ? 'selected' : '' }}>{{ $formasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Obat</label>
                            <div class="col-md-6">
                                @foreach ($pindah->detailPerpindahan as $obat)
                                <div id="obat-list">
                                    <div class="obat-group">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <select class="form-control obat-select" name="obat_id[]" required>
                                                    <option selected disabled>Choose Formasi Awal First</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control kuantitas" name="kuantitas[]" value="{{ $obat->kuantitas }}" placeholder="Enter a Kuantitas" required disabled>
                                            </div>
                                            <div class="col inline-buttons">
                                                <button type="button" class="btn btn-danger deleteObatBtn">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <button type="button" id="addObatBtn" class="btn btn-primary mt-2">Add Obat</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Formasi Tujuan</label>
                            <div class="col-md-5">
                                <select class="form-control" name="formasi_tujuan" required>
                                    <option selected disabled>Choose</option>
                                    @foreach ($formasis as $formasi)
                                        <option value="{{ $formasi->id }}" {{ $pindah->formasi_tujuan == $formasi->id ? 'selected' : '' }}>{{ $formasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label control-label">Keterangan *</label>
                            <div class="col-md-5">
                                <textarea type="text" id="keterangan" name="keterangan"  class="form-control" placeholder="Enter a Keterangan" required>{{ $pindah->keterangan }}</textarea>
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
    
            // Initial toggle delete button visibility
            toggleDeleteButtonVisibility();
    
            // Populate obat options and select the correct ones based on existing data
            function populateObatOptionsAndSelect(selectedObats) {
                var formasi_id = $('#formasi_awal').val();
                if (formasi_id) {
                    $.ajax({
                        url: "{{ route('get.obat.by.formasi') }}",
                        type: "GET",
                        data: {
                            formasi_id: formasi_id
                        },
                        success: function(response) {
                            $('.obat-group').each(function(index) {
                                var obat_select = $(this).find('.obat-select');
                                obat_select.empty().append('<option selected disabled>Choose</option>');
                                $.each(response, function(i, obat) {
                                    var option = $('<option>', {
                                        value: obat.obat_id,
                                        'data-stok': obat.stok,
                                        text: obat.obat.nama
                                    });
                                    if (selectedObats[index] && selectedObats[index].obat_id == obat.obat_id) {
                                        option.prop('selected', true);
                                    }
                                    obat_select.append(option);
                                });
                                if (selectedObats[index]) {
                                    $(this).find('.kuantitas').val(selectedObats[index].kuantitas).prop('disabled', false);
                                }
                            });
                            $('.obat-select').prop('disabled', false);
                        }
                    });
                } else {
                    $('.obat-select').empty().append('<option selected disabled>Choose Formasi Awal First</option>');
                    $('.kuantitas').val('').prop('disabled', true);
                }
            }
    
            // Formasi Awal change event
            $('#formasi_awal').change(function() {
                populateObatOptionsAndSelect([]);
            });
    
            // Populate obat options and select initially
            var selectedObats = [
                @foreach ($pindah->detailPerpindahan as $obat)
                    {
                        obat_id: {{ $obat->obat_id }},
                        kuantitas: {{ $obat->kuantitas }}
                    },
                @endforeach
            ];
            populateObatOptionsAndSelect(selectedObats);
    
            // Add Obat button click event
            $('#addObatBtn').click(function() {
                var obatGroup = $('.obat-group').first().clone();
                obatGroup.find('.obat-select').val('');
                obatGroup.find('.kuantitas').val('');
                $('#obat-list').append(obatGroup);
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
                $(this).closest('.obat-group').find('.kuantitas').prop('disabled', false).attr('max', stok);
            });
    
            // Kuantitas input event
            $(document).on('input', '.kuantitas', function() {
                var kuantitas = $(this).val().trim();
                var stok = $(this).closest('.obat-group').find('.obat-select option:selected').data('stok');
                if (parseInt(kuantitas) > stok) {
                    alert('Kuantitas tidak boleh melebihi stok yang tersedia (' + stok + ')');
                    $(this).val(stok); // Set kuantitas to stok max value
                }
            });
    
            // Form validation submit event
            $('#form-validation').submit(function() {
                var valid = true;
                $('.obat-group').each(function() {
                    var kuantitas = $(this).find('.kuantitas').val();
                    var stok = $(this).find('.obat-select option:selected').data('stok');
                    if (parseInt(kuantitas) > stok) {
                        alert('Kuantitas tidak boleh melebihi stok yang tersedia (' + stok + ')');
                        valid = false;
                        return false; // Exit the loop early
                    }
                });
                return valid;
            });
        });
    </script>
@endsection

