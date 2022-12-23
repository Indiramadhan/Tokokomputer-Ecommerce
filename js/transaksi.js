function detail(kode_checkout)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $.ajax({
        url : "detail/" + kode_checkout,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="kode_checkout"]').val(data.kode_checkout);
            $('[name="id"]').val(data.id);
            $('#idpesanan').html(data.nick);
            $('#tglpesan').html(data.created_date);
            $('#noresi').html(data.resi_pengiriman);
            $('#harga').html(data.harga_jual);
            $('#pembayaran').html(data.pembayaran);
            $('#pengiriman').html(data.pengiriman);
            if (data.status == 1) {
                $('#proses').removeClass("active");
                $('#kirim').removeClass("active");
                $('#terima').removeClass("active"); }
                $('#btn-selesai').html('<button type="button" class="btn btn-danger disabled" onclick="simpan()">Selesaikan</button>');
           if (data.status == 2) {
                $('#proses').addClass("active");
                $('#kirim').removeClass("active");
                $('#terima').removeClass("active");
                $('#btn-selesai').html('<button type="button" class="btn btn-danger disabled" onclick="simpan()">Selesaikan</button>');
            } if (data.status == 3) {
                $('#proses').addClass("active");
                $('#kirim').addClass("active");
                $('#terima').removeClass("active");
                $('#btn-selesai').html('<button type="button" class="btn btn-danger" onclick="simpan()">Selesaikan</button>');
            } if(data.status == 4) {
                $('#proses').addClass("active");
                $('#kirim').addClass("active");
                $('#terima').addClass("active");
                $('#btn-selesai').html('<button type="button" class="btn btn-danger disabled" onclick="simpan()">Selesaikan</button>');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function simpan() {
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url: "update",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: window.location.reload(),
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error pada saat tambah / edit data ');
            $('#btnsimpan').text('Coba lagi');
            $('#btnsimpan').attr('disabled', false);
        }
    });
}