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
                url: "app/loaddata",
                type: "POST"
            },
            columnDefs: [
                { width: 100, targets: 1, targets: 4, }
            ],
            fixedColumns: true,
            
        });
    });

    // Fungsi accept transaksi
    function accept(kode_checkout) {
        save_method = 'accept';
        $('#formaccept')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "app/getprogress/" + kode_checkout,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="kode_checkout"]').val(data.kode_checkout);
                $('[name="id_brg"]').val(data.id_brg);
                $('[name="qty"]').val(data.stok - data.qty);
                $('[name="status"]').val(2);
                $('.modal-title').html('Lanjutkan transaksi ?');
                $('#nama_pnrm').html(data.nama_pnrm);
                $('#created_date').html(data.created_date);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    // Fungsi kirim barang
    function kirim(kode_checkout) {
        save_method = 'kirim';
        $('#formkirim')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url: "app/getprogress/" + kode_checkout,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="kode_checkout"]').val(data.kode_checkout);
                $('[name="status"]').val(3);
                $('[name="resi_pengiriman"]').val(data.resi_pengiriman);
                $('.modal-judul').html('Form Pengiriman ?');
            },
            error: function(jqXHR, textStatus, errorThrown) {
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

    if (save_method == 'accept') {
        url = "app/teruskan";
        var formData = new FormData($('#formaccept')[0]);
    } else if (save_method == 'kirim'){
        url = "app/kirim";
        var formData = new FormData($('#formkirim')[0]);
    }
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

    $(document).ready(function() {
        initgrafik();
    });

    function initgrafik() {
        $(".init-grafik-loading grafik");
        grafik();
    }

    function grafik() {
        $.ajax({
            url: "app/data_grafik",
            dataType: "json",
            success: function(data) {
                barChart(data, "grafik");
            }
        })
    }

    function barChart(data, chartdiv) {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create(chartdiv, am4charts.XYChart);
        chart.data = data;
        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "nick";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.inside = false;
        categoryAxis.start = 0;

        categoryAxis.renderer.grid.template.disabled = true;
        var label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 160;
        label.tooltipText = "{category}";

        categoryAxis.events.on("sizechanged", function(ev) {
            var axis = ev.target;
            var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
            if (cellWidth < axis.renderer.labels.template.maxWidth) {
                axis.renderer.labels.template.rotation = -75;
                axis.renderer.labels.template.horizontalCenter = "right";
                axis.renderer.labels.template.verticalCenter = "middle";
            } else {
                axis.renderer.labels.template.rotation = 0;
                axis.renderer.labels.template.horizontalCenter = "middle";
                axis.renderer.labels.template.verticalCenter = "top";
            }
        });

        var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis1.extraMax = 0.1;
        valueAxis1.min = 0;
        var series1 = chart.series.push(new am4charts.ColumnSeries());
        series1.dataFields.valueY = "stok";
        series1.dataFields.categoryX = "nick";
        series1.yAxis = valueAxis1;
        series1.columns.template.tooltipText = "{valueY.value}";

        chart.cursor = new am4charts.XYCursor();
        am4core.color("#8F3985");
    }

    $(document).ready(function() {
        $(".init-pie-loading pie");
        initpie();
    });

    function initpie() {
        pie();
    }

    function pie() {
        $.ajax({
            url: "app/data_pie",
            dataType: "json",
            success: function(data) {
                pieChart(data, "pie");
            }
        })
    }

    function pieChart(data, piediv) {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create(piediv, am4charts.PieChart);
        chart.data = data;

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "harga_beli";
        pieSeries.dataFields.category = "nick";

        pieSeries.ticks.template.disabled = true;
        pieSeries.alignLabels = false;
        pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
        pieSeries.labels.template.radius = am4core.percent(-40);
        pieSeries.labels.template.fill = am4core.color("white");
    }

    $(document).ready(function(){
   setInterval('updateClock()', 1000);
});

function updateClock (){
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  	
  	
   	$("#clock").html(currentTimeString);	  	
 }