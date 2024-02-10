<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">
                <a href="<?= APP_URL;?>/produk/create" class="btn btn-primary">
                    <i class='fa fa-plus'></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>No.</th>
                        <th>Id</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data['produk'] as $produk) :
                    ?>
                        <tr align="center">
                            <td><?= $no++; ?></td>
                            <td><?= $produk['id_produk']; ?></td>
                            <td><?= $produk['nama_produk']; ?></td>
                            <td>RP <?= number_format((float)$produk['harga'], 2, ',', '.'); ?></td>
                            <td><?= $produk['stok']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>