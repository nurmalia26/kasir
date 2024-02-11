<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">
                <a href="<?= APP_URL; ?>/pegawai/create" class="btn btn-primary">
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
                        <th>Username</th>
                        <th>Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data['pegawai'] as $pegawai) :
                    ?>
                        <tr align="center">
                            <td><?= $no++; ?></td>

                            <td><?= $pegawai['nama']; ?></td>
                            <td><?= $pegawai['username']; ?></td>
                            <td><?= $pegawai['role']; ?></td>
                            <!-- <td> <a class="btn btn-info" href="<?= APP_URL; ?>/produk/update">Edit</a>
                                <a class="btn btn-danger" href="<?= APP_URL; ?>/produk">Hapus</a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>