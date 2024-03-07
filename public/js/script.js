const APP_URL = "http://localhost/kasir/public";

// Konfigurasi Toast menggunakan SweetAlert2.mixin
var Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});

// Objek untuk memformat nilai numerik menjadi format mata uang Rupiah Indonesia (IDR)
const rupiahIndonesia = new Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
});

function formatRupiah(input) {
  // Menghapus karakter yang bukan angka
  var angka = input.value.replace(/\D/g, '');
  
  // Mengformat angka menjadi format rupiah
  var formattedRupiah = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  
  // Menambahkan simbol Rupiah
  input.value = "Rp " + formattedRupiah;
}

//SCRIPT MENAMBAHKAN PRODUK ATAU DETAIL PRODUK

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

// Fungsi untuk menampilkan kembalian saat inputan bayar berubah
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
  tampilKembali(); // Memanggil fungsi untuk menampilkan kembalian
});

$("#id_produk").on("change", function () {
  let selectedOption = $("option:selected", this);
  let datastok = selectedOption.data("stok");  
  $("#qty").attr("max", datastok); 
  addDetailProduk(); 
});

$("#qty").on("keyup", function () {
  addDetailProduk(); // Memanggil fungsi untuk menambah detail produk
});
$("#qty").on("blur", function () {
  addDetailProduk(); // Memanggil fungsi untuk menambah detail produk
});

$(function () {
  // Menginisialisasi plugin Select2 untuk semua elemen dengan kelas 'select2'
  $(".select2").select2({
    theme: "bootstrap4",
  });

  $("#btnTambahProduk").on("click", function () {
    // Mengambil nilai dari input produk, nama produk, harga produk, dan kuantitas
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
                                  <td>${rupiahIndonesia.format(
                                    hargaProduk
                                  )}</td>
                                  <td>${rupiahIndonesia.format(subTotal)}</td>
                                  <td><a href="#" data-id="${idProduk}" data-subtotal="${subTotal}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                              </tr>
                          </tbody>
                          <tfoot>
                            <tr align="center" id="sumSubTotal">
                              <th colspan="4"> Total Harga</th>
                              <th>${rupiahIndonesia.format(subTotal)}
                  
                              </th>
                              <th></th>
                            </tr>
                          </tfoot>
                      </table>`;
      $("#detailProduk").append(tblDetail);
      $("#bayar").attr("min", subTotal);
    } else {
      // Jika sudah ada, menambahkan detail produk ke dalam tabel yang sudah ada
      // dan mengupdate total harga
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
      $("#bayar").attr("min", sumSubTotal);
    }
    // Menambahkan detail produk ke dalam array detailProduk
    detailProduk.push({
      id_produk: idProduk,
      jumlah_produk: qtyValue,
      sub_total: subTotal,
    });
    $("#detail_transaksi").val(JSON.stringify(detailProduk));
    addDetailProduk(); // Menjalankan fungsi untuk menambah detail produk
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
      $("#sumSubTotal th:nth-child(2)").html(
        rupiahIndonesia.format(totalHarga)
      );
    }
  });

  // $("#datatable")
  //   .DataTable({
  //     responsive: true,
  //     lengthChange: true,
  //     autoWidth: false,
  //     searching: false, // Menetapkan searching menjadi false
  //     buttons: ["copy", "excel", "pdf", "print", "colvis"],
  //   })
  //   .buttons()
  //   .container()
  //   .appendTo("#datatable_wrapper .col-md-6:eq(0)");

  // $("#datatableTransaksi")
  //   .DataTable({
  //     responsive: true,
  //     lengthChange: true,
  //     autoWidth: false,
  //     searching: false, // Menetapkan searching menjadi false
  //     buttons: ["copy", "excel", "pdf", "print", "colvis"],
  //     footerCallback: function () {
  //       let api = this.api();
  //       let totalHarga = api
  //         .column(5, {
  //           page: "current",
  //         })
  //         .data()
  //         .reduce(function (a, b) {
  //           return (
  //             Number(a) + Number(b.replace(/[^\d,]/g, "").replace(",", "."))
  //           );
  //         }, 0);
  //       $(api.column(5).footer()).html(
  //         totalHarga == 0 ? totalHarga : rupiahIndonesia.format(totalHarga)
  //       );
  //     },
  //   })
  //   .buttons()
  //   .container()
  //   .appendTo("#datatableTransaksi_wrapper .col-md-6:eq(0)");

  // //foto produk
  // $(document).on("click", ".fotoProdukTrigger", function () {
  //   const foto = $(this).data("foto");
  //   const imgProduk = `<img src="${APP_URL}/${foto}" class="product-image" alt="Product Image"/>`;
  //   $("#fotoProduk .modal-body").html(imgProduk);
  // });

  // $('[data-dismiss="modal"]').on("click", function () {
  //   $(".modal-body").html("");
  // });

  $(document).on("click", ".detailProdukTrigger", function () {
    const id = $(this).data("id");

    $.ajax({
        url: APP_URL + "/transaksi/getDetailByIdTransaksi/" + id, 
        type: "get", 
        dataType: "json", 
        success: (data) => { 
            console.log(data); 

           
            let totalHarga = 0;

           
            const totalBayar = Number(data[0].bayar);

            let tabelDetail = `<table id="datatableDetailProduk" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center" class="alert-dark">
                                        <th>No.</th>
                                        <th>id produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah produk</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>`;

            for (let i = 0; i < data.length; i++) {
                totalHarga += Number(data[i].sub_total);

                tabelDetail += `<tr align="center">
                                    <td>${i + 1}</td>
                                    <td>${data[i].id_produk}</td>
                                    <td>${data[i].nama_produk}</td>
                                    <td>${rupiahIndonesia.format(data[i].harga)}</td>
                                    <td>${data[i].jumlah_produk}</td>
                                    <td>${rupiahIndonesia.format(data[i].sub_total)}</td>
                                </tr>`;
            }

            const totalkembalian = Number(totalBayar - totalHarga);
            tabelDetail += `</tbody>
                            <tfoot>
                                <tr align="center">
                                    <th colspan="5">Total Harga</th>
                                    <th>${rupiahIndonesia.format(totalHarga)}</th>
                                </tr>
                                <tr align="center">
                                    <th colspan="5">Total Bayar</th>
                                    <th>${rupiahIndonesia.format(totalBayar)}</th>
                                </tr>
                                <tr align="center">
                                    <th colspan="5">Kembalian</th>
                                    <th>${rupiahIndonesia.format(totalkembalian)}</th>
                                </tr>
                            </tfoot>
                        </table>`;

            $("#detailProdukModal .modal-body").html(tabelDetail);

            $('[data-dismiss="modal"]').on("click", function () {
                $(".modal-body").html(""); 
            });
        

        // $("#datatableDetailProduk")
        //   .DataTable({
        //     responsive: true,
        //     lengthChange: true,
        //     autoWidth: false,
        //     searching: false, // Menetapkan searching menjadi false
        //     buttons: [
        //       {
        //         extend: "pdfHtml5",
        //         footer: true,
        //         customize: function (doc) {
        //           doc.content.splice(
        //             1,
        //             0,
        //             {
        //               margin: [0, 0, 0, 12], // adjust margins as needed
        //               alignment: "left",
        //               columns: [
        //                 { text: "Id Transaksi", width: 100 },
        //                 { text: ": " + data[0].id_transaksi },
        //               ],
        //             },
        //             {
        //               margin: [0, 0, 0, 12], // adjust margins as needed
        //               alignment: "left",
        //               columns: [
        //                 { text: "Tanggal", width: 100 },
        //                 { text: ": " + data[0].tanggal },
        //               ],
        //             },
        //             {
        //               margin: [0, 0, 0, 12], // adjust margins as needed
        //               alignment: "left",
        //               columns: [
        //                 { text: "Nama Pelanggan", width: 100 },
        //                 { text: ": " + data[0].nama_pelanggan },
        //               ],
        //             },
        //             {
        //               margin: [0, 0, 0, 12], // adjust margins as needed
        //               alignment: "left",
        //               columns: [
        //                 { text: "Nama Kasir", width: 100 },
        //                 { text: ": " + data[0].nama_kasir },
        //               ],
        //             }
        //           );
        //         },
        //       },
        //       {
        //         extend: "print",
        //         customize: function (win) {
        //           $(win.document.body)
        //             .find("table")
        //             .before(
        //               `<div class="row">
        //                   <label for="nama" class="col-sm-2 col-form-label">Id Transaksi</label>
        //                   <label for="nama" class="col-sm-10 col-form-label">: ${
        //                     data[0].id_transaksi == null
        //                       ? "-"
        //                       : data[0].id_transaksi
        //                   }</label>
        //               </div>
        //               <div class="row">
        //                   <label for="nama" class="col-sm-2 col-form-label">Tanggal</label>
        //                   <label for="nama" class="col-sm-10 col-form-label">: ${
        //                     data[0].tanggal == null ? "-" : data[0].tanggal
        //                   }</label>
        //               </div>
        //               <div class="row">
        //                   <label for="nama" class="col-sm-2 col-form-label">No Pelanggan</label>
        //                   <label for="nama" class="col-sm-10 col-form-label">: ${
        //                     data[0].no_telpon == null
        //                       ? "-"
        //                       : data[0].no_telpon
        //                   }</label>
        //               </div>
        //               <div class="row">
        //                   <label for="nama" class="col-sm-2 col-form-label">Nama Kasir</label>
        //                   <label for="nama" class="col-sm-10 col-form-label">: ${
        //                     data[0].nama_kasir == null
        //                       ? "-"
        //                       : data[0].nama_kasir
        //                   }</label>
        //               </div>`
        //             ).append(`<tfoot>
        //                       <tr align="center">
        //                         <th colspan="5">Total Harga</th>
        //                         <th>${rupiahIndonesia.format(totalHarga)}</th>
        //                       </tr>
        //                       <tr align="center">
        //                         <th colspan="5">Total Bayar</th>
        //                         <th>${rupiahIndonesia.format(totalBayar)}</th>
        //                       </tr>
        //                       <tr align="center">
        //                         <th colspan="5">Kembalian</th>
        //                         <th>${rupiahIndonesia.format(
        //                           totalkembalian
        //                         )}</th>
        //                       </tr>
        //                     </tfoot>`);
        //         },
        //       },
        //     ],
        //   })
          // .buttons()
          // .container()
          // .appendTo("#datatableDetailProduk_wrapper .col-md-6:eq(0)");
      },
    });
  });
});
