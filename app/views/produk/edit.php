<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/produk/update/<?= $data['produk']['id_produk']; ?>" method="post" id="form_produk">
        <div class="card-body">

            <div class="form-group">
                <div class="row">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $data['produk']['nama_produk']; ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="harga" name="harga" value="Rp <?= number_format($data['produk']['harga'], 0, ',', '.'); ?>" onkeyup="formatRupiah(this)" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= $data['produk']['stok']; ?>" />
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
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </div>
            </div>
        </div>
    </form>
</div>