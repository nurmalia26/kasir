const APP_URL = "http://localhost/kasir/public";

var Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});

// formatting value to indonesian currency
// ex rupiahIndonesia.format(100000)
// output : Rp聽100.000,00
const rupiahIndonesia = new Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
});

let detailOrders = [];
$(document).on("click", "section ul li a", function (e) {
  e.preventDefault();
  const id = $(this).data("id");
  const operator = $(this).data("operator");
  let qty = Number($(this).closest("ul").find("li:eq(1)").text());
  const dataMax = $(this).data("max");
  const harga = Number($(this).parent().parent().data("harga"));
  const namaProduk = $(this).parent().parent().data("nama");
  const existingProductIndex = detailOrders.findIndex(
    (product) => product.id_produk === id
  );
  if (operator === "plus" && qty < dataMax) {
    qty += 1;
  } else if (operator === "minus" && qty > 0) {
    qty -= 1;
  }
  $(this)
    .closest("ul")
    .find("li:eq(1)")
    .html(`<a href="#" style="cursor: default;">${qty}</a>`);
  if (existingProductIndex !== -1) {
    // Update the quantity if the product already exists
    detailOrders[existingProductIndex].jumlah_beli = qty;
    detailOrders[existingProductIndex].harga_total = harga * qty;
  } else {
    detailOrders.push({
      id_produk: id,
      nama_produk: namaProduk,
      harga: harga,
      jumlah_beli: qty,
      harga_total: harga * qty,
    });
  }
});

function updateProductById(id, updatedFields) {
  products = products.map((product) => {
    if (product.id_produk === id) {
      return { ...product, ...updatedFields };
    }
    return product;
  });
}

$("#cartButton").on("click", function () {
  let tblDetail = "";
  if (detailOrders.length === 1) {
    $("#total_harga").val(detailOrders[0].harga_total);

    tblDetail = `<table id="tblOrders" class="table table-bordered table-striped mt-2">
          <thead>
              <tr align="center" class="alert-dark">
                  <th>Nama Produk</th>
                  <th>Kuantitas</th>
                  <th>Harga Satuan</th>
                  <th>Total Harga</th>
              </tr>
          </thead>
          <tbody>
              <tr align="center">
                  <td>${detailOrders[0].nama_produk}</td>
                  <td>${detailOrders[0].jumlah_beli}</td>
                  <td>${rupiahIndonesia.format(detailOrders[0].harga)}</td>
                  <td>${rupiahIndonesia.format(
                    detailOrders[0].harga_total
                  )}</td>
              </tr>
          </tbody>
          <tfoot>
            <tr align="center" id="sumSubTotal">
              <th colspan="3"> Total Harga</th>
              <th>${rupiahIndonesia.format(detailOrders[0].harga_total)}</th>
            </tr>
          </tfoot>
      </table>`;
  } else {
    let subTotal = 0;
    tblDetail = `<table id="tblOrders" class="table table-bordered table-striped mt-2">
                    <thead>
                        <tr align="center" class="alert-dark">
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>`;
    for (let i = 0; i < detailOrders.length; i++) {
      subTotal += detailOrders[i].harga_total;
      tblDetail += `<tr align="center">
                        <td>${detailOrders[i].nama_produk}</td>
                        <td>${detailOrders[i].jumlah_beli}</td>
                        <td>${rupiahIndonesia.format(
                          detailOrders[i].harga
                        )}</td>
                        <td>${rupiahIndonesia.format(
                          detailOrders[i].harga_total
                        )}</td>
                    </tr>`;
    }
    tblDetail += `</tbody>
                    <tfoot>
                    <tr align="center" id="sumSubTotal">
                        <th colspan="3"> Total Harga</th>
                        <th>${rupiahIndonesia.format(subTotal)}</th>
                    </tr>
                    </tfoot>
                </table>`;
    $("#total_harga").val(subTotal);
  }
  let fieldBayar = ` <div class="form-group mt-3">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Bayar</label>
                            <input type="number" class="form-control col" min="1" id="bayar" name="bayar">
                        </div>
                    </div>
                    <div class="row d-none">
                        <label class="col-sm-2 col-form-label">Kembalian</label>
                        <label id="totalKembalian" class="col col-form-label"></label>
                    </div>`;
  $("#detail_transaksi").val(JSON.stringify(detailOrders));
  $("#detailOrderModel .modal-body").html(tblDetail + fieldBayar);
  $("#bayar").attr("min", $("#total_harga").val());

  function tampilKembali() {
    const totalHarga = Number($("#total_harga").val());
    const totalBayar = Number($("#bayar").val());
    console.log("totalHarga", totalHarga);
    console.log("totalBayar", totalBayar);
    if (totalHarga > 0 && totalBayar > 0 && totalBayar >= totalHarga) {
      const totalkembalian = rupiahIndonesia.format(totalBayar - totalHarga);
      console.log("totalkembalian", totalkembalian);
      const htmlKembalian = `: <b>${totalkembalian}</b>`;
      $("#totalKembalian").parent().removeClass("d-none");
      $("#totalKembalian").html(htmlKembalian);
    }
  }

  $("#bayar").on("blur", function () {
    tampilKembali();
  });
});
