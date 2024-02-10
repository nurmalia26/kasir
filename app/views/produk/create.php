<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/produk/save" method="post" id="form_produk">
        <div class="card-body">
        <div class="form-group">
                <div class="row">
                    <label for="id_produk" class="col-sm-2 col-form-label">Id Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_produk" name="id_produk" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga" name="harga" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stok" name="stok" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/produk">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
</div>