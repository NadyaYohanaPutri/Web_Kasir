<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>

    <!-- Menyertakan jQuery -->
    <script src="<?= base_url('asset/jquery-3.7.1.min.js') ?>"></script>

    <!-- Menyertakan CSS Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap-5.0.2-dist/css/bootstrap.min.css') ?>">

    <!-- Menyertakan CSS Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
<div class="container mt-5">
    <div class="row mt-3">
        <div class="col-12">
            <h3 class="text-center">Data Produk</h3>
            <!-- Tombol untuk membuka modal tambah produk -->
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                <i class="fa-solid fa-cart-plus"></i> Tambah Data
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <!-- Tabel untuk menampilkan data produk -->
                <table class="table table-bordered" id="produkTabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data produk akan dimasukkan melalui AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk tambah produk -->
    <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalTambahProdukLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input data produk -->
                    <form id="formProduk">
                        <input type="hidden" id="produkId" name="produkId"> <!-- Hidden input untuk ID produk -->
                        <div class="row mb-3">
                            <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProduk" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" id="hargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stokProduk">
                            </div>
                        </div>
                        <button type="button" id="simpanProduk" class="btn btn-primary float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk edit produk -->
    <div class="modal fade" id="modalEditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalEditProdukLabel">Edit Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input data produk -->
                    <form id="formEditProduk">
                        <input type="hidden" id="produkIdEdit" name="produkIdEdit"> <!-- Hidden input untuk ID produk -->
                        <div class="row mb-3">
                            <label for="namaProdukEdit" class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaProdukEdit" name="namaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProdukEdit" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" id="hargaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProdukEdit" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stokProdukEdit">
                            </div>
                        </div>
                        <button type="button" id="editProduk" class="btn btn-primary float-end">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Menyertakan JS Bootstrap dan Font Awesome -->
    <script src="<?= base_url('asset/bootstrap-5.0.2-dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('asset/fontawesome-free-6.6.0-web/js/all.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            // Panggil fungsi tampilProduk saat halaman dimuat
            tampilProduk();

            // Reset modal saat membuka modal untuk tambah produk
            $('#modalTambahProduk').on('show.bs.modal', function() {
                $('#modalTambahProdukLabel').text('Tambah Produk'); // Set label modal ke "Tambah Produk"
                $('#produkId').val(''); // Reset hidden input ID
                $('#namaProduk').val(''); // Reset nama produk
                $('#hargaProduk').val(''); // Reset harga produk
                $('#stokProduk').val(''); // Reset stok produk
            });

            // Event handler untuk tombol simpan produk
            $("#simpanProduk").on("click", function() {
                var formData = {
                    nama_produk: $("#namaProduk").val(),
                    harga: $('#hargaProduk').val(),
                    stok: $('#stokProduk').val()
                };

                $.ajax({
                    url: '<?= base_url('produk/simpan'); ?>',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahProduk').modal("hide");
                            $('#formProduk')[0].reset();
                            tampilProduk();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data produk berhasil disimpan.',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menyimpan data: ' + JSON.stringify(hasil.errors),
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan!',
                            text: 'Kesalahan: ' + error,
                        });
                    }
                });
            });

            // Event handler untuk tombol hapus produk
            $('#produkTabel').on('click', '.hapusProduk', function() {
                var produkId = $(this).data('id');
                var konfirmasi = confirm("Apakah Anda yakin ingin menghapus produk ini?");
                
                if (konfirmasi) {
                    $.ajax({
                        url: '<?= base_url('produk/hapus'); ?>/' + produkId,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                tampilProduk();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Produk berhasil dihapus.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus data.',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Kesalahan: ' + error,
                            });
                        }
                    });
                }
            });

            // Event handler untuk tombol edit produk
            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                
                // Ambil data produk berdasarkan ID
                $.ajax({
                    url: '<?= base_url('produk/detail/') ?>' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            // Isi form dengan data produk
                            $('#produkIdEdit').val(data.produk.produk_id);
                            $('#namaProdukEdit').val(data.produk.nama_produk);
                            $('#hargaProdukEdit').val(data.produk.harga);
                            $('#stokProdukEdit').val(data.produk.stok);

                            // Ubah label modal menjadi "Edit Produk"
                            $('#modalEditProdukLabel').text('Edit Produk');

                            // Tampilkan modal edit
                            $('#modalEditProduk').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal mengambil data produk.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan!',
                            text: 'Kesalahan: ' + error,
                        });
                    }
                });
            });

            // Event handler untuk tombol edit produk di modal edit
            $("#editProduk").on("click", function() {
                var formData = {
                    produkId: $("#produkIdEdit").val(),
                    nama_produk: $("#namaProdukEdit").val(),
                    harga: $('#hargaProdukEdit').val(),
                    stok: $('#stokProdukEdit').val()
                };
                
                $.ajax({
                    url: '<?= base_url('produk/update'); ?>',  
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalEditProduk').modal("hide");
                            tampilProduk();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data produk berhasil diperbarui.',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal mengedit data: ' + JSON.stringify(hasil.errors),
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan!',
                            text: 'Kesalahan: ' + error,
                        });
                    }
                });
            });
        });

        // Fungsi untuk menampilkan data produk
        function tampilProduk() {
            $.ajax({
                url: '<?= base_url('produk/tampil'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var produkList = '';
                    $.each(data.produk, function(index, produk) {
                        produkList += '<tr>';
                        produkList += '<td>' + (index + 1) + '</td>';
                        produkList += '<td>' + produk.nama_produk + '</td>';
                        produkList += '<td>' + produk.harga + '</td>';
                        produkList += '<td>' + produk.stok + '</td>';
                        produkList += '<td><button type="button" class="btn btn-warning btn-edit" data-id="' + produk.produk_id + '"><i class="fa fa-pencil-alt"></i>Edit</button> ';
                        produkList += '<button type="button" class="btn btn-danger hapusProduk" data-id="' + produk.produk_id + '"><i class="fa fa-trash-alt"></i>Hapus</button></td>';
                        produkList += '</tr>';
                    });
                    $('#produkTabel tbody').html(produkList);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        text: 'Kesalahan: ' + error,
                    });
                }                
            });
        }
        </script>
        </div>
    </body>
</html>