<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">

                <a href="<?= APP_URL; ?>/produk/create" class="btn btn-primary">
                    <i class='fa fa-plus'></i> Tambah Data
                </a>

            </div>
        </div>

        <div class="card-body">
            <div class="modal fade" id="fotoProduk" tabindex="-1" aria-labelledby="fotoProdukLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fotoProdukLabel">Foto Produk</h5>
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
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>No.</th>
                        <th>Id</th>
                        <th>Nama Produk</th>
                        <!-- <th>Foto Produk</th> -->
                        <th>Harga</th>
                        <th>Stok</th>
                        
                            <th>Action</th>
                       

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
                            <!-- <td>
                              
                                <a href="#" class="btn btn-primary fotoProdukTrigger" data-foto="<?= $produk['foto_produk']; ?>" data-toggle="modal" data-target="#fotoProduk">Lihat gambar</a>
                            </td> -->
                            <td>RP <?= number_format((float)$produk['harga'], 2, ',', '.'); ?></td>
                            <td><?= $produk['stok']; ?></td>

                          
                                <td> <a class="btn btn-info" href="<?= APP_URL; ?>/produk/edit/<?= $produk['id_produk']; ?>">Edit</a></td>
                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>