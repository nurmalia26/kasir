<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">
                <a href="<?= APP_URL; ?>/pelanggan/create" class="btn btn-primary">
                    <i class='fa fa-plus'></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data['pelanggan'] as $pelanggan) :
                    ?>
                        <tr align="center">
                            <td><?= $no++; ?></td>

                            <td><?= $pelanggan['nama']; ?></td>
                            <td><?= $pelanggan['alamat']; ?></td>
                            <td><?= $pelanggan['no_telpon']; ?></td>
                          
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>