<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="/solve/global_assets/datepicker/js/bootstrap-datepicker.js"></script>
<script>
    google.load("visualization", "1", {packages:["corechart,table"]});
    $(document).ready(function(){
        setInterval(function () {
            api_get_data(0);
        },60000);
        api_get_data();
        $('#export').click(function () {
            api_get_data(1);
        });
    });
    function api_get_data(flag=0) {
        $.ajax({
            url: "<?php echo base_url() ?>api_get_data/",
            type: "POST",
            data: {
                status: "<?php echo $this->session->userdata("status") ?>"
            },
            success: function(resp){
                if(flag == 0) {
                    chart(resp);
                } else {
                    download(resp);
                }
            }
        });
    }
    function chart(resp) {
        resp=JSON.parse(resp);
        // Jumlah Penjualan
        // Chartnya
        var data = google.visualization.arrayToDataTable(resp['jp_tl']);
        var options = {
            title: "Jumlah Penjualan Per FO",
            bar: { groupWidth: '75%' },
            isStacked: false
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart-tl-jp"));
        chart.draw(data,options);
        // Tabel nya
        var table = new google.visualization.Table(document.getElementById('table-tl-jp'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});

        //Total Penjualan
        //Chartnya
        var data = google.visualization.arrayToDataTable(resp['tp_tl']);
        var options = {
            title: "Total Penjualan Per FO (Rp.)",
            bar: { groupWidth: '75%' },
            isStacked: false
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart-tl-tp"));
        chart.draw(data,options);
        // Tabel nya
        var table = new google.visualization.Table(document.getElementById('table-tl-tp'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});

        //Chart Kendaraan
        var data = google.visualization.arrayToDataTable(resp['jp_k']);
        var options = {
            title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart-kdr-jp'));
        chart.draw(data, options);
        // Chart Produk
        var data = google.visualization.arrayToDataTable(resp['jp_p']);
        var options = {
            title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart-prd-jp'));
        chart.draw(data, options);
    }
    function download(resp) {
        $.ajax({
            type: 'POST',
            data: {data : resp},
            url: "<?php echo base_url() ?>export_excel",
            success: function(resp){
                console.log(resp);
                // e.preventDefault();  //stop the browser from following
                location.target = "_blank";
                location.href='<?php echo base_url(); ?>files/'+resp;
            }
        });
    }
</script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <div class="col-xs-12 col-md-12" style="text-align: right">
            <button class="btn btn-success" id="export">Export To Excel</button>
            <p></p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Penjualan Berdasarkan FO
                </div>
                <div class="panel-body">
                    <div id="chart-tl-jp" style="width: 100%;height:350px"></div>
                    <div id="table-tl-jp" style="width: 100%;height:150px"></div>
                    <div id="chart-tl-tp" style="width: 100%;height:350px"></div>
                    <div id="table-tl-tp" style="width: 100%;height:150px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Penjualan Berdasarkan Kendaraan
                </div>
                <div class="panel-body">
                    <div id="chart-kdr-jp" style="width: 100%;height:350px"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Penjualan Berdasarkan Produk
                </div>
                <div class="panel-body">
                    <div id="chart-prd-jp" style="width: 100%;height:350px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->