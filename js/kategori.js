    // Variable
    var save_method;
    var table;
    var base_url = '<?= base_url(); ?>'.replace(/\s+/g, ' '); ;
    $("#card_tambah").hide();

    // Datatable kategori Toko
    $(document).ready(function() {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [],
            ajax: {
                url: "kategori/loaddata",
                type: "POST"
            },
        });
    });

    function tambah() {
        save_method = 'tambah';
        $("#card_tambah").show();
        $("#card_table").hide();
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $("#tgltambah").show();
        $("#tglupdate").hide();
        $('.help-block').empty();
        $('.card-title').html('Tambah Data');
        $('#ikon-preview').hide();
    }

    function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $.ajax({
        url : "kategori/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nama_ktg"]').val(data.nama_ktg);
            $('[name="updated_date"]').val(data.updated_date);
            $("#card_tambah").show();
            $("#card_table").hide();
            $("#tgltambah").hide();
            $("#tglupdate").show();
            $('.card-title').text('Edit');

            $('#ikon-preview').show();

            if(data.ikon)
            {
                $('#ikon-preview div').text('');
                $('#ikon-preview div').append('<input type="checkbox" name="remove_ikon" value="'+data.ikon+'"/> Remove ikon when saving'); // remove ikon
            }
            else
            {
                $('#ikon-preview div').text('(Ikon kosong)');
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
            url = "kategori/tambah";
        } else {
            url = "kategori/update";
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
            url : "kategori/hapus/"+id,
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