<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/produk/save" method="post" id="form_produk" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"  />
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="row">
                    <label for="foto_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="foto_produk" name="foto_produk" />
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <div class="row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="harga" name="harga" onkeyup="formatRupiah(this)"/>
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
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" id="id_supplier" name="id_supplier">
                            <option value="">----pilih Supplier----</option>
                            <?php
                            $no = 1;
                            foreach ($data['supplier'] as $supplier) :
                            ?>
                                <option value="<?= $supplier['id_supplier'] ?>"><?= $supplier['nama_supplier'] ?> <?php endforeach; ?>
                        </select>
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