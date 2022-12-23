$(document).ready(function(){
    $('.btn-tambah-qty').click(function(){
        var id_cart = $(this).data("id");
        var id_brg = $(this).data("idbrg");
        var quantity = $(this).data("quantity");
        var harga = $(this).data("harga");
        var qty     = $('#tmbh' + id_brg).val();
        $.ajax({
            url : "updatetambah",
            method : "POST",
            data : {id_cart:id_cart, id_brg:id_brg, quantity: quantity, qty: qty, harga: harga},
            success: window.location.reload()
        });
    });

    $('.btn-kurang-qty').click(function(){
        var id_cart = $(this).data("id");
        var id_brg = $(this).data("idbrg");
        var quantity = $(this).data("quantity");
        var harga = $(this).data("harga");
        var qty     = $('#krng' + id_brg).val();
        $.ajax({
            url : "updatekurang",
            method : "POST",
            data : {id_cart:id_cart, id_brg:id_brg, quantity: quantity, qty: qty, harga: harga},
            success: window.location.reload()
        });
    });
});

function hapus(id)
{
    if(confirm('Yakin ingin menghapus barang dari keranjang ?'))
    {
        $.ajax({
            url : "hapus/"+id,
            type: "POST",
            dataType: "JSON",
            success: window.location.reload(),
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menghapus data dari keranjang');
            }
        });
    }
}

$(document).ready(function(){
    $('.btn-kembalikan').click(function(){
        var id_cart = $(this).data("idcart");
        var id_brg = $(this).data("idbrg");
        var stokbrg = $(this).data("stokbrg");
        $.ajax({
            url : "updatekembali",
            method : "POST",
            data : {id_cart:id_cart, id_brg:id_brg, stokbrg: stokbrg},
            success: window.location.reload()
        });
    });
});