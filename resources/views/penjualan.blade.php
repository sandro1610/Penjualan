@extends('layouts.layout')
@section('title', 'Data Penjualan')
@section('style')
    <!-- MULAI STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        
    <!-- AKHIR STYLE CSS -->

@endsection
@section('content')
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <!-- MULAI TOMBOL TAMBAH -->
                <div class="row">
                <a href="javascript:void(0)" class="btn btn-info" id="tombol-tambah">Tambah Penjualan</a>
                &nbsp;
                <a href="/penjualan/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a>
            </div>
                <br><br>
                <!-- AKHIR TOMBOL -->
                <!-- MULAI TABLE -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-lg" id="table_penjualan">
                        <thead>
                            <tr>
                                <th>No Produk</th>
                                <th>Nama Produk</th>
                                <th>Kardus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- AKHIR TABLE -->
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
    <!-- AKHIR CONTAINER -->

    <!-- MULAI MODAL FORM TAMBAH/EDIT-->
    <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">

                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-12 control-label">Produk</label>
                                    <div class="col-sm-12">
                                        <select class="selectpicker form-control" size="5" id="produk_id" name="produk_id"  data-live-search="true">
                                            @foreach ($produks as $produk) 
                                            <option value="{{$produk -> id}}"  data-tokens="({{$produk -> no_produk}}){{$produk -> nama_produk}}">({{$produk -> no_produk}}){{$produk -> nama_produk}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="kardus" class="col-sm-12 control-label">Kardus</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="kardus" name="kardus"
                                            value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                    value="create">Simpan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR MODAL -->

    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Jika menghapus Penjualan maka</b></p>
                    <p>*data produk tersebut hilang selamanya, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <!-- LIBARARY JS -->
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

    <script type="text/javascript" language="javascript"
    src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script type="text/javascript" language="javascript"
        src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"
        integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>


    <!-- AKHIR LIBARARY JS -->

    <!-- JAVASCRIPT -->
    <script>
        //CSRF TOKEN PADA HEADER
        //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        //TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function() {
            $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah penjualans Baru"); //valuenya tambah penjualans baru
            $('#tambah-edit-modal').modal('show'); //modal tampil
        });
        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function() {
            $('#table_penjualan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "{{ route('penjualans.index') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'no_produk',
                        name: 'no_produk'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'kardus',
                        name: 'kardus'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: []
            });
        });
        //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function(form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('penjualans.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        success: function(data) { //jika berhasil 
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#tambah-edit-modal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_penjualan').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable
                            iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Berhasil Disimpan',
                                message: '{{ Session('
                                                                                                success ') }}',
                                position: 'bottomRight'
                            });
                        },
                        error: function(data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }
        //TOMBOL EDIT DATA PER penjualans DAN TAMPIKAN DATA BERDASARKAN ID penjualans KE MODAL
        //ketika class edit-post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('penjualans/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Post");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#produk_id').val(data.produk_id);
                $('#kardus').val(data.kardus);
            })
        });
        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function() {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function() {
            $.ajax({
                url: "penjualans/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function(data) { //jika sukses
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_penjualan').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                                                                        delete ') }}',
                        position: 'bottomRight'
                    });
                }
            })
        });
    </script>
@endsection
