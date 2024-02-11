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

$(function () {
  $(".select2").select2({
    theme: "bootstrap4",
  });

  $("#datatable")
    .DataTable({
      responsive: true,
      lengthChange: true,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#datatable_wrapper .col-md-6:eq(0)");

  $(".detailProdukTrigger").on("click", function () {
    const id = $(this).data("id");
    $.ajax({
      url: APP_URL + "/transaksi/getDetailByIdTransaksi/" + id,
      type: "get",
      dataType: "json",
      success: (data) => {
        console.log("data", data);
        let tabelDetail = `<table id="datatable" class="table table-bordered table-striped">
        <thead>
            <tr align="center" class="alert-dark">
                <th>No.</th>
                <th>id produk</th>
                <th>Jumlah produk</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>`;
        for (let i = 0; i < data.length; i++) {
          const element = data[i];
          tabelDetail += `<tr align="center">
            <td>${i+1}</td>
            <td>${data[i].id_produk}</td>
            <td>${data[i].jumlah_produk}</td>
            <td>${data[i].sub_total}</td>
        </tr>`;
        }
        tabelDetail += ` </tbody>
        </table>`;
        $('#detailProdukModal .modal-body').html(tabelDetail);
      },
    });
  });
});
