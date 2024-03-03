<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><?= $data['judul'] ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/transaksi/save" method="post" id="form_transaksi">
        <div class="card-body">
            <input type="hidden" name="detail_transaksi" id="detail_transaksi">
            <input type="hidden" name="total_harga" id="total_harga">
            <div class="form-group">
                <label>Pelanggan</label>
                <select class="form-control select2" style="width: 100%; " id="id_pelanggan" name="id_pelanggan">
                    <option value="">----pilih pelanggan----</option>
                    <?php
                    $no = 1;
                    foreach ($data['pelanggan'] as $pelanggan) :
                    ?>
                        <option value="<?= $pelanggan['id_pelanggan'] ?>"><?= $pelanggan['nama'] ?> ( <?= $pelanggan['no_telpon'] ?> )</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="id_produk">Produk</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" style="width: 100%;" id="id_produk" name="id_produk">
                            <option value="">----Pilih Produk----</option>
                            <?php
                            $no = 1;
                            foreach ($data['produk'] as $produk) :
                            ?>
                                <option data-nama="<?= $produk['nama_produk'] ?>" data-harga="<?= $produk['harga'] ?>" data-stok="<?= $produk['stok'] ?>" value="<?= $produk['id_produk'] ?>"><?= $produk['id_produk'] ?> - <?= $produk['nama_produk'] ?> ( tersisa <?= $produk['stok'] ?> )</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="col col-form-label" for="kuantitas">Kuantitas</label>
                    <input type="number" class="form-control col" min="1" id="qty" name="qty">
                </div>
            </div>
            <button id="btnTambahProduk" class="btn btn-primary" type="button" disabled>Tambah Produk</button>
            <div id="detailProduk"></div>
            <div class="form-group mt-3">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Bayar</label>
                    <input type="number" class="form-control col" min="1" id="bayar" name="bayar">
                </div>
            </div>
            <div class="row d-none">
                <label class="col-sm-2 col-form-label">Kembalian</label>
                <label id="totalKembalian" class="col col-form-label"></label>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/transaksi">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
</div>