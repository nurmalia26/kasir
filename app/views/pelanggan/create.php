<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/pelanggan/save" method="post" id="form_produk">
        <div class="card-body">
       
            <div class="form-group">
                <div class="row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="no_telpon" class="col-sm-2 col-form-label">Nomor Telpon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/pelanggan">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
</div>