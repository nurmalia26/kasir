<link rel="stylesheet" href="<?= APP_URL; ?>/css/nota.css">
<div class="container-nota">
    <div class="receipt-header">
        <h2><?= APP_NAME; ?></h2>
        <p>Rawa Geni, Jl.istiqomah 1 no 57 Ratu Jaya Cipayung <br>081297342612</p>
    </div>
    <div class="row">
        <label for="nama" class="col-sm-3 col-form-label">Id Transaksi</label>
        <label for="nama" class="col-sm-9 col-form-label">: <?= $data['cetak'][0]['id_transaksi'] ?></label>
    </div>
    <div class="row">
        <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
        <label for="nama" class="col-sm-9 col-form-label">: <?= $data['cetak'][0]['tanggal'] ?></label>
    </div>

    <table class="receipt-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>id Produk</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalHarga = 0; // Initialize total price variable
            foreach ($data['cetak'] as $produk) :
                $totalHarga += $produk['sub_total']; // Add the subtotal of each product to the total price
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $produk['id_produk'] ?></td>
                    <td><?= $produk['nama_produk'] ?></td>
                    <td> Rp <?= number_format((float) $produk['harga'], 2, ',', '.'); ?></td>
                    <td><?= $produk['jumlah_produk'] ?></td>
                    <td> Rp <?= number_format((float) $produk['sub_total'], 2, ',', '.'); ?></td>
                </tr>

            <?php
            endforeach;
            $totalBayar = (float)$data['cetak'][0]['bayar'];

            // Calculate the kembalian
            $kembalian = $totalBayar - $totalHarga;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="receipt-total">Total Harga</td>
                <td class="receipt-total">Rp <?= number_format((float) $totalHarga, 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="5" class="receipt-total">Total bayar</td>
                <td class="receipt-total">Rp <?= number_format((float)$totalBayar,  2, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="5" class="receipt-total">Kembalian</td>
                <td class="receipt-total">Rp <?= number_format((float)$kembalian, 2, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <p>Terimakasih Atas Pembelian anda!</p>
    <a href="<?= APP_URL; ?>/transaksi/converttopdf/<?= $data['cetak'][0]['id_transaksi'] ?>" class="btn btn-primary" target="_blank">cetak</a>

</div>