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

let detailProduk = [];

function addDetailProduk() {
  let produkValue = $("#id_produk").val();
  let qtyValue = $("#qty").val();
  let maxQtyValue = $("#qty").attr("max");
  if (
    produkValue === "" ||
    Number(qtyValue) < 1 ||
    Number(qtyValue) > Number(maxQtyValue)
  ) {
    $("#btnTambahProduk").attr("disabled", true);
  } else {
    $("#btnTambahProduk").removeAttr("disabled");
  }
}

$("#id_produk").on("change", function () {
  let selectedOption = $("option:selected", this);
  let datastok = selectedOption.data("stok");
  $("#qty").attr("max", datastok);
  addDetailProduk();
});

$("#qty").on("keyup", function () {
  addDetailProduk();
});

$("#qty").on("blur", function () {
  addDetailProduk();
});

$(function () {
  $(".select2").select2({
    theme: "bootstrap4",
  });

  $("#btnTambahProduk").on("click", function () {
    let idProduk = $("#id_produk").val();
    let namaProduk = $("option:selected", "#id_produk").data("nama");
    let hargaProduk = Number($("option:selected", "#id_produk").data("harga"));
    let qtyValue = Number($("#qty").val());
    let subTotal = hargaProduk * qtyValue;
    $("#id_produk option[value='" + idProduk + "']").prop("disabled", true);
    $("#id_produk").val("").trigger("change");
    $("#qty").val("");
    if (detailProduk.length === 0) {
      $("#total_harga").val(subTotal);
      let tblDetail = ` <table id="tblDetailProduk" class="table table-bordered table-striped mt-2">
                          <thead>
                              <tr align="center" class="alert-dark">
                                
                                  <th>Id</th>
                                  <th>Nama Produk</th>
                                  <th>Kuantitas</th>
                                  <th>Harga Satuan</th>
                                  <th>Total Harga</th>
                                  <th>Aksi</th>
                                  
                              </tr>
                          </thead>
                          <tbody>
                              <tr align="center">
                                  <td>${idProduk}</td>
                                  <td>${namaProduk}</td>
                                  <td>${qtyValue}</td>
                                  <td>${rupiahIndonesia.format(hargaProduk)}</td>
                                  <td>${rupiahIndonesia.format(subTotal)}</td>
                                  <td><a href="#" data-id="${idProduk}" data-subtotal="${subTotal}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                              </tr>
                          </tbody>
                          <tfoot>
                            <tr align="center" id="sumSubTotal">
                              <th colspan="4"> Total Harga</th>
                              <th>${rupiahIndonesia.format(subTotal)}</th>
                              <th></th>
                            </tr>
                          </tfoot>
                      </table>`;
      $("#detailProduk").append(tblDetail);
    } else {
      const sumSubTotal =
        detailProduk
          .map((obj) => obj.sub_total)
          .reduce(
            (accumulator, currentvalue) => accumulator + currentvalue,
            0
          ) + subTotal;
      $("#total_harga").val(sumSubTotal);
      let tbodyTblDetail = ` 
          <tr align="center">
          <td>${idProduk}</td>
          <td>${namaProduk}</td>
          <td>${qtyValue}</td>
          <td>${rupiahIndonesia.format(hargaProduk)}</td>
          <td>${rupiahIndonesia.format(subTotal)}</td>
          <td><a href="#" data-id="${idProduk}" data-subtotal="${subTotal}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
      </tr>`;
      let tfootTblDetail = ` 
         <tr align="center" id="sumSubTotal">
         <th colspan="4"> Total Harga</th>
         <th>${rupiahIndonesia.format(sumSubTotal)}</th>
         <th></th>
       </tr>`;
      $("#sumSubTotal").remove();
      $("#detailProduk tbody").append(tbodyTblDetail);
      $("#detailProduk tfoot").append(tfootTblDetail);
    }
    detailProduk.push({
      id_produk: idProduk,
      jumlah_produk: qtyValue,
      sub_total: subTotal,
    });
    $("#detail_transaksi").val(JSON.stringify(detailProduk));
    addDetailProduk();
  });

  $(document).on("click", "#detailProduk tbody tr td a", function () {
    const id = $(this).data("id");
    const subTotal = $(this).data("subtotal");
    let totalHarga = $("#total_harga").val();
    $(this).parent().parent().remove();
    $("#id_produk option[value='" + id + "']").prop("disabled", false);
    detailProduk = detailProduk.filter((obj) => obj.id_produk !== id);
    $("#detail_transaksi").val(JSON.stringify(detailProduk));
    if (detailProduk.length === 0) {
      $("#tblDetailProduk").remove();
      $("#total_harga").val("");
    } else {
      totalHarga = Number(totalHarga) - Number(subTotal);
      $("#total_harga").val(totalHarga);
      $("#sumSubTotal th:nth-child(2)").html(rupiahIndonesia.format(totalHarga));
    }
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

  $("#datatableTransaksi")
    .DataTable({
      responsive: true,
      lengthChange: true,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      footerCallback: function () {
        let api = this.api();

        let totalHarga = api
          .column(5, {
            page: "current",
          })
          .data()
          .reduce(function (a, b) {
            return (
              Number(a) + Number(b.replace(/[^\d,]/g, "").replace(",", "."))
            );
          }, 0);
        $(api.column(5).footer()).html(
          totalHarga == 0 ? totalHarga : rupiahIndonesia.format(totalHarga)
        );
      },
    })
    .buttons()
    .container()
    .appendTo("#datatableTransaksi_wrapper .col-md-6:eq(0)");

  $(".detailProdukTrigger").on("click", function () {
    const id = $(this).data("id");
    $.ajax({
      url: APP_URL + "/transaksi/getDetailByIdTransaksi/" + id,
      type: "get",
      dataType: "json",
      success: (data) => {
        let totalHarga = 0
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
          totalHarga += Number(data[i].sub_total);
          const element = data[i];
          tabelDetail += `<tr align="center">
            <td>${i + 1}</td>
            <td>${data[i].id_produk}</td>
            <td>${data[i].jumlah_produk}</td>
            <td>${rupiahIndonesia.format(data[i].sub_total)}</td>
        </tr>`;
        }
        tabelDetail += ` </tbody>
        <tfoot>
        <tr>
        <th colspan="3">Total Harga</th>
        <th>${rupiahIndonesia.format(totalHarga)}</th>
        </tr></tfoot>
        
        </table>`;
        $("#detailProdukModal .modal-body").html(tabelDetail);
      },
    });
  });
});
