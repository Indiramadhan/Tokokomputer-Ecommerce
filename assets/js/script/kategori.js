var save_method;
var table;
var base_url = '<?= base_url(); ?>'.replace(/\s+/g, ' '); ;

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