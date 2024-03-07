<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/supplier/save" method="post" id="form_produk">
        <div class="card-body">
       
            <div class="form-group">
                <div class="row">
                    <label for="nama_supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" />
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
                    <label for="no_tlp" class="col-sm-2 col-form-label">Nomor Telpon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/supplier">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
</div>