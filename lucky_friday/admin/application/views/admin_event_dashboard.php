<?php
$pesertaJSON=array(array('Nama','Email','noHP','Merk','Produk','Nominal','Hadiah'));
foreach ($peserta as $p){
	$pesertaJSON[]=array($p->nama,$p->email,$p->noHP,$p->merkKendaraan,$p->produk,$p->nominal,$p->hadiah);
}
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="/solve/global_assets/datepicker/js/bootstrap-datepicker.js"></script>
<style>
td.details-control {
    background: url('../admin/assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../admin/assets/images/details_close.png') no-repeat center center;
}
</style>
<script>
	google.load("visualization", "1", {packages:["corechart,table"]});
	var dataSPBU = <?php echo $spbu; ?>;
	function format(d) {
		var html = 	'<table class="table table-condensed"><tr><thead><th>TL</th><th>Hadiah</th><th>Total</th></thead></tr>';
		$.each(d.data, function(x,y) {
			html += '<tr><tbody>';
			html += '<td>'+y.tl_name+'</td>';
			html += '<td>'+y.hadiah+'</td>';
			html += '<td>'+y.jumlah_hadiah+'</td>';
			html += '</tbody></tr>';
		});
    html += '</table>';
		return html;
	}
	
    $(document).ready(function(){
			var table = $("#dataSPBU").DataTable({
				data: dataSPBU,
				columns: [
					{
						"className":      'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
					},
					{"data": "nomer"},
					{"data": "nama"},
					{"data": "total"},
				],
				// "columnDefs": [
					// {
						// "render": function ( data, type, row ) {
								// return "<a href='https://google.co.id/maps/search/SPBU "+data+"' target='_blank'>"+data;
						// },
						// "targets": 1
					// },
				// ],
				"order": [[1, 'asc']]
			});
			
			$("#dataSPBU tbody").on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
			});
        // setInterval(function () {
            // api_get_data(0);
        // },60000);
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
            title: "Jumlah Konsumen Per Produk",
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
            title: "Total Konsumen Per Produk (Rp.)",
            bar: { groupWidth: '75%' },
            isStacked: false
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart-tl-tp"));
        chart.draw(data,options);
        // Tabel nya
        var table = new google.visualization.Table(document.getElementById('table-tl-tp'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        //Tabel Hadiah
        var data = google.visualization.arrayToDataTable(resp['j_h']);
        var table = new google.visualization.Table(document.getElementById('table-jh'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});

        //Tabel Peserta
        var data = google.visualization.arrayToDataTable(<?=json_encode($pesertaJSON)?>);
        var table = new google.visualization.Table(document.getElementById('table-p'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        $('#hadiah').html(resp['t_h']);
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
                    Data Konsumen Berdasarkan Produk
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
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Peserta
                </div>
                <div class="panel-body" style="background-color:#ecf0f5">
                    <div id="table-p" style="width: 100%;height:200px"></div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Konsumen Berdasarkan Kendaraan
                </div>
                <div class="panel-body">
                    <div id="chart-kdr-jp" style="width: 100%;height:350px"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Data Konsumen Berdasarkan Produk
            </div>
            <div class="panel-body">
                <div id="chart-prd-jp" style="width: 100%;height:350px"></div>
            </div>
        </div>
    </div>
    </div>
		
	<div class="row">
		<div class="col-sm-12 col-md-5">
			<div class="panel panel-primary">
				<div class="panel-heading">
						Data Hadiah
				</div>
				<div class="panel-body" style="background-color:#ecf0f5">
					<div class="col-sm-12">
						<div class="info-box">
							<span class="info-box-icon bg-red"><i class="fa fa-gift"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Total Hadiah Keluar</span>
								<span class="info-box-number" style="font-size:43px" id="hadiah"></span>
							</div>
						<!-- /.info-box-content -->
						</div>
						<br/>
						<div id="table-jh" style="width: 100%;"></div>
					</div>                   
				</div>
			</div>
		</div>
		
		<div class="col-sm-12 col-md-7">
			<div class="panel panel-primary">
				<div class="panel-heading">
						Data SPBU
				</div>
				<div class="panel-body" style="max-height:350px;overflow:auto;background-color:#ecf0f5">
					<div class="col-sm-12">
						<table id="dataSPBU" class="table table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>SPBU</th>
									<th>Alamat</th>
									<th>Total</th>
								</tr>
							</thead>
							<!--<tbody>
								<?php foreach($spbu as $val) { ?>
								<tr data-toggle="collapse" data-target="#<?php echo $val['nomer'] ?>" class="accordion-toggle">
									<td><?php echo $val['nomer'] ?></td>
									<td><?php echo $val['nama'] ?></td>
									<td><?php echo $val['total'] ?></td>
								</tr>
								<tr>
									<td colspan="3" class="hiddenRow">
										<div class="accordian-body collapse" id="<?php echo $val['nomer'] ?>">
											<table class="table table-condensed">
												<thead>
													<tr>
														<th>Hadiah</th>
														<th>Total</th>
														<th>TL</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($val["data"] as $v) { ?>
												<tr>
													<td><?php echo $v["hadiah"] ?></td>
													<td><?php echo $v["jumlah_hadiah"] ?></td>
													<td><?php echo $v["tl_name"] ?></td>
												</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>-->
						</table>
					</div>                   
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- /#page-wrapper -->