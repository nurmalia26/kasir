<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">
                <?php
                if ($_SESSION['user']['role'] === 'pegawai') :
                ?>

                    <a href="<?= APP_URL; ?>/transaksi/create" class="btn btn-primary">
                        <i class='fa fa-plus'></i> Tambah Data
                    </a>
                <?php
                endif;
                ?>
            </div>
        </div>
        <div class="card-body">
            <div class="modal fade" id="detailProdukModal" tabindex="-1" aria-labelledby="detailProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailProdukModalLabel">Detail Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="datatableTransaksi" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>No.</th>
                        <th>Id</th>
                        <th>Pelanggan</th>
                        <th>Pegawai</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data['transaksi'] as $transaksi) :
                    ?>
                        <tr align="center">
                            <td><?= $no++; ?></td>
                            <td><?= $transaksi['id_transaksi']; ?></td>
                            <td><?= $transaksi['id_pelanggan']; ?> - <?= $transaksi['nama_pelanggan']; ?></td>
                            <td><?= $transaksi['id_user']; ?> - <?= $transaksi['nama_user']; ?></td>
                            <td><?= $transaksi['tanggal']; ?></td>
                            <td> Rp <?= number_format((float) $transaksi['total_harga'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="#" class="btn btn-primary detailProdukTrigger" data-id="<?= $transaksi['id_transaksi']; ?>" data-toggle="modal" data-target="#detailProdukModal">Detail</a>
                                <?php if ($transaksi['status'] === 'order') : ?>
                                    <a href="<?= APP_URL; ?>/transaksi/statuspaid/<?= $transaksi['id_transaksi']; ?>" class="btn btn-success">Bayar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr align="center">
                        <th colspan="5">Subtotal</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>