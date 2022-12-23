    // Variable
    var save_method;
    var table;
    $("#card_tambah").hide();

    // Datatable kategori Toko
    $(document).ready(function() {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [],
            ajax: {
                url: "produk/loaddata",
                type: "POST"
            },
            columnDefs: [
                { width: 335, targets: 1}
            ],
            fixedColumns: true,
            
        });
    });

    function tambah() {
        save_method = 'tambah';
        $("#card_tambah").show();
        $("#card_table").hide();
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $(".tgltambah").show();
        $(".tglupdate").hide();
        $('.help-block').empty();
        $('.card-title').html('Tambah Data');
        $('#gambar-preview').hide();
    }

    function edit(id)
    {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $.ajax({
        url : "produk/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nama_brg"]').val(data.nama_brg);
            $('[name="spesifikasi"]').val(data.spesifikasi);
            $('[name="stok"]').val(data.stok);
            $('[name="nick"]').val(data.nick);
            $('[name="harga_jual"]').val(data.harga_jual);
            $('[name="harga_beli"]').val(data.harga_beli);
            $('[name="id_ktg"]').val(data.id_ktg);
            $('[name="updated_date"]').val(data.updated_date);
            $("#card_tambah").show();
            $("#card_table").hide();
            $(".tgltambah").hide();
            $(".tglupdate").show();
            $('.card-title').text('Edit data');

            $('#gambar1-preview').show();

            if(data.gambar1)
            {
                $('#gambar1-preview div').text('');
                $('#gambar1-preview div').append('<input type="checkbox" name="remove_gambar1" value="'+data.gambar1+'"/> Hapus saat disimpan');
            }
            else
            {
                $('#gambar1-preview div').text('(Gambar 1 kosong)');
            }

            if(data.gambar2)
            {
                $('#gambar2-preview div').text('');
                $('#gambar2-preview div').append('<input type="checkbox" name="remove_gambar2" value="'+data.gambar2+'"/> Hapus saat disimpan');
            }
            else
            {
                $('#gambar2-preview div').text('(Gambar 2 kosong)');
            }

            if(data.gambar3)
            {
                $('#gambar3-preview div').text('');
                $('#gambar3-preview div').append('<input type="checkbox" name="remove_gambar3" value="'+data.gambar3+'"/> Hapus saat disimpan');
            }
            else
            {
                $('#gambar3-preview div').text('(Gambar 3 kosong)');
            }

            if(data.gambar4)
            {
                $('#gambar4-preview div').text('');
                $('#gambar4-preview div').append('<input type="checkbox" name="remove_gambar4" value="'+data.gambar4+'"/> Hapus saat disimpan');
            }
            else
            {
                $('#gambar4-preview div').text('(Gambar 4 kosong)');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function simpan() {
        $('#btnsimpan').text('menyimpan...');
        $('#btnsimpan').attr('disabled', true);
        var url;

        if (save_method == 'tambah') {
            url = "produk/tambah";
        } else {
            url = "produk/update";
        }

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) {
                    reload_table();
                    $("#card_table").show();
                    $("#card_tambah").hide();

                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnsimpan').text('simpan');
                $('#btnsimpan').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error pada saat tambah / edit data ');
                $('#btnsimpan').text('Coba lagi');
                $('#btnsimpan').attr('disabled', false);
            }
        });
    }

    function hapus(id)
{
    if(confirm('Yakin ingin menghapus data ?'))
    {
        $.ajax({
            url : "produk/hapus/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menghapus data');
            }
        });

    }
}
    
    $(document).ready(function() {
        $("#back").click(function() {
            $("#card_table").show();
            $("#card_tambah").hide();
        });
    });