<link rel="stylesheet" href="<?= APP_URL; ?>/css/tanggal.css">

<div class="container">
    <h2>Pilih Tanggal Cetak</h2>
    <form action="<?= APP_URL; ?>/transaksi/laporan" method="post">
        <label for="tanggal_awal"> Dari Tanggal:</label>
        <input type="date" id="tanggal_awal" name="tanggal_awal" required>
        <br><br>
        <label for="tanggal_akhir">Sampai:</label>
        <input type="date" id="tanggal_akhir" name="tanggal_akhir" required>
        <br><br>
        <input type="submit">
    </form>
</div>
