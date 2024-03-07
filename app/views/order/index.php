<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME; ?></title>
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="<?= APP_URL; ?>/img/icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="<?= APP_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/nota.css">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <section class="section-products">
        <div class="container">
            <div class="modal fade" id="detailOrderModel" tabindex="-1" aria-labelledby="detailOrderModelLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="<?= APP_URL; ?>/order/checkout" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailOrderModelLabel">Detail Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="detail_transaksi" name="detail_transaksi" />
                                <input type="hidden" name="total_harga" id="total_harga">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['transaction']) && $_SESSION['transaction']['status']) : ?>
                <div class="modal fade" id="notaModal" tabindex="-1" aria-labelledby="notaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form action="<?= APP_URL; ?>/order/checkout" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notaModalLabel">Detail Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-nota">
                                        <div class="receipt-header">
                                            <h2><?= APP_NAME; ?></h2>
                                            <p>Rawa Geni, Jl.istiqomah 1 no 57 Ratu Jaya Cipayung <br>081297342612</p>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-3 col-form-label">Id Transaksi</label>
                                            <label for="nama" class="col-sm-9 col-form-label">: <?= $_SESSION['transaction']['detail'][0]['id_transaksi'] ?></label>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                            <label for="nama" class="col-sm-9 col-form-label">: <?= $_SESSION['transaction']['detail'][0]['tanggal'] ?></label>
                                        </div>


                                        <table class="receipt-table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>id Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Jumlah</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($_SESSION['transaction']['detail'] as $produk) :
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $produk['id_produk'] ?></td>
                                                        <td><?= $produk['nama_produk'] ?></td>
                                                        <td> Rp <?= number_format((float) $produk['harga'], 2, ',', '.'); ?></td>
                                                        <td><?= $produk['jumlah_produk'] ?></td>
                                                        <td> Rp <?= number_format((float) $produk['sub_total'], 2, ',', '.'); ?></td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="receipt-total">Total Harga</td>
                                                    <td class="receipt-total">Rp <?= number_format((float) $_SESSION['transaction']['detail'][0]['total_harga'], 2, ',', '.'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="receipt-total">Total bayar</td>
                                                    <td class="receipt-total">Rp <?= number_format((float) $_SESSION['transaction']['detail'][0]['bayar'], 2, ',', '.'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="receipt-total">Kembalian</td>
                                                    <td class="receipt-total">Rp <?= number_format((float) $_SESSION['transaction']['detail'][0]['bayar']-$_SESSION['transaction']['detail'][0]['total_harga'], 2, ',', '.'); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <p>Thank you for your purchase!</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <a id="cartButton" href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailOrderModel"><i class="fas fa-shopping-cart"></i></a>
            <div class="row">
                <!-- Single Product -->
                <?php
                foreach ($data['produk'] as $produk) :
                ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1" style="background: url('<?= APP_URL; ?>/<?= $produk['foto_produk'] ?>') no-repeat center;background-size: cover;transition: all 0.3s;">
                                <ul data-harga="<?= $produk['harga'] ?>" data-nama="<?= $produk['nama_produk'] ?>">
                                    <li><a data-id="<?= $produk['id_produk'] ?>" data-operator="minus"><i class="fas fa-minus"></i></a></li>
                                    <li><a style="cursor: default;">0</a></li>
                                    <li><a data-id="<?= $produk['id_produk'] ?>" data-max="<?= $produk['stok'] ?>" data-operator="plus"><i class="fas fa-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?= $produk['nama_produk'] ?></h3>
                                <h4 class="product-price">RP <?= number_format((float)$produk['harga'], 2, ',', '.'); ?></h4>
                            </div>
                        </div>
                    </div>

                <?php
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?= APP_URL; ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= APP_URL; ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- jquery-validation -->
    <script src="<?= APP_URL; ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= APP_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- JQVMap -->
    <script src="<?= APP_URL; ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= APP_URL; ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- moment -->
    <script src="<?= APP_URL; ?>/plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= APP_URL; ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= APP_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Summernote -->
    <script src="<?= APP_URL; ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= APP_URL; ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= APP_URL; ?>/dist/js/adminlte.js"></script>
    <!-- Select2 -->
    <script src="<?= APP_URL; ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- Sweetalart -->
    <script src="<?= APP_URL; ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- DataTables -->
    <script src="<?= APP_URL; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Custom Javascript -->
    <script src="<?= APP_URL; ?>/js/order.js"></script>
    <?php Flasher::flash() ?>

    <?php if (isset($_SESSION['transaction']) && $_SESSION['transaction']) : ?>
        <script>
            $(document).ready(function() {
                $('#notaModal').modal('show');
            });
        </script>
    <?php endif; ?>
</body>

</html>