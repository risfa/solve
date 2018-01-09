<?php 
	$pattern = "/samsung.*/i";
	$start_date = date("Y-m-d",strtotime($event['start_date']));
	$today = date("Y-m-d");
	$end_date = $today;
	if(strtotime($event['end_date']) == strtotime($today)){
		$end_date = date("Y-m-d",strtotime($event['end_date']));
	}
?>

<script type="text/javascript">
	var start_date,end_date,
			event_selected = '<?php echo $event_selected; ?>',
			pattern = <?php echo $pattern; ?>;
	$(document).ready(function(){
		$("#datepicker").val("<?php echo $start_date ?>");
		$("#datepicker2").val("<?php echo $end_date ?>");
		start_date = $("#datepicker").val();
		end_date = $("#datepicker2").val();
		// setInterval(function(){ api_get_data(start_date,end_date); }, 4000);
		api_get_data(start_date,end_date);
		$("#submit").click(function(){
			start_date = $("#datepicker").val();
			end_date = $("#datepicker2").val();
			api_get_data(start_date,end_date);
		});
	});
	
	
	function api_get_data(start_date,end_date){
		var event_name = "<?php echo $event['event_name']; ?>";
		$.ajax({
			url: "<?php echo base_url() ?>api_get_data/"+encodeURIComponent(event_name)+"/"+encodeURIComponent(start_date)+"/"+encodeURIComponent(end_date)+"/tl",
			success: function(resp){
				graph(resp);
				gender(resp);
				if(event_selected == "Lesehan Enduro") {
						product(resp);
						paket(resp);
				} else {					
					if(pattern.test(event_selected) == false) {
						paket(resp);
					}
				}
			},
		});
	}
	
	//event lesehan enduro
	
	function product(json) {
		var result = $.parseJSON(json);
		var finalobject = new Array();
		var counter = 0;
		var dataProductName = result['product_name'];
		var dataProduct = result['product'];
		var total_product = result['total_product'];
		finalobject[0] = ["Date"];
		$.each(dataProductName,function(x,y) {
			finalobject[0].push(y);
		});
		$.each(dataProduct,function(x,y) {
			counter += 1;
			finalobject[counter] = [x];
			$.each(y,function(k,v) {
				finalobject[counter].push(typeof(v)!="undefined"?parseInt(v):0);
			});
		});
		// console.log(finalobject);return;
		var data = google.visualization.arrayToDataTable(finalobject);
		
		var dataTable = google.visualization.arrayToDataTable(finalobject);
		
		var options = {
			title : 'Daily Sales per Product',
			vAxis: {title: "Package"},
			hAxis: {title: "Daily"},
			seriesType: "bars",
			series: ""
		};
		obj = {};
		obj[total_product] = {type: "line"};
		// options.isStacked = true;
		options.series = obj;
		
		// console.log(options);return;
		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_product'));
		chart.draw(data, options);
		
		var table = new google.visualization.Table(document.getElementById('table_div_product'));
		table.draw(dataTable,{width: "100%",page:'enable',pageSize:10});
	}
	
	//end event lesehan enduro
	
	function graph(json){
		var result = $.parseJSON(json);
		var finalobject = new Array();
		var counter = 0;
		var dataObject = result['leader_data'];					
		var total_leader = result['total_leader'];
		finalobject[0] = ['Date'];
		$.each(result['leader_name'],function(key,value){																					
			finalobject[0].push(value);						
		});
		
		if(pattern.test(event_selected) == false) {
			finalobject[0].push("Rata-rata");
		}
		
		$.each(dataObject,function(k,v) {
			counter += 1;
			finalobject[counter] = [k];
			$.each(v,function(x,y) {
				if(pattern.test(event_selected)) {
					if(x != "rata-rata"){
						finalobject[counter].push(typeof(y)!="undefined"?parseInt(y):0)
					}
				} else {
					finalobject[counter].push(typeof(y)!="undefined"?parseInt(y):0)
				}
			});
		});
		
		var data = google.visualization.arrayToDataTable(finalobject);
		
		var dataTable = google.visualization.arrayToDataTable(finalobject);
		
		var options = {
			title : 'Daily Sales',
			vAxis: {title: "Package"},
			hAxis: {title: "Daily"},
			seriesType: "bars",
			series: ""
		};
		obj = {};
		obj[total_leader] = {type: "line"};
		if(pattern.test(event_selected)) {
			options.isStacked = true;
			options.title = "Daily Usage";
		}
		options.series = obj;
		
		if(pattern.test(event_selected)) {
			var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
		} else {
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		}
		chart.draw(data, options);
		
		var table = new google.visualization.Table(document.getElementById('table_div'));
		table.draw(dataTable,{width: "100%",page:'enable',pageSize:10});
	}
	
	function gender(json){
		var result = $.parseJSON(json);
		var finalobject = new Array();
		var counter = 0;
		var dataObject = result['total_gender'];					
		
		finalobject[0] = ['Task', 'Hours per Day'];
		
		$.each(dataObject,function(k,v) {
			counter += 1;
			finalobject[counter] = [k,typeof(v)!="undefined"?parseInt(v):0];
		});
		
		var data = google.visualization.arrayToDataTable(finalobject);
		
		var options = {
			title: 'Gender'
		};
		
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
	}
	
	function paket(json){
		var result = $.parseJSON(json);
		var data = result['paket_total_harga'];
		var total_paket = 0;
		var total_harga = 0;
		$.each(data,function(k,v){		
			total_paket = typeof(v['total_paket'])!="undefined"?numberWithCommas(parseInt(v['total_paket'])):0
			total_harga = typeof(v['total_harga'])!="undefined"?numberWithCommas(parseInt(v['total_harga'])):0
		});
		
		document.getElementById('total_harga').innerHTML = total_harga;
		document.getElementById('total_paket').innerHTML = total_paket;
		$(".fromtodate").html(start_date+" s/d "+end_date);
	}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
			
	<div class="row">
		<div class="col-lg-12">
			<form class="form-horizontal" method="post" action="<?php echo base_url() ?>#">
				<div class="form-inline">
					<div class="form-group">
						<label class="col-sm-5 control-label">Start Date</label>
						<div class="col-sm-7">
							<div class="input-group" style="max-width:200px">
								<input type="text" name="startDate" id="datepicker" class="form-control" required placeholder="Start Date">
								<span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-5 control-label">End Date</label>
						<div class="col-sm-7">
							<div class="input-group" style="max-width:200px">
								<input type="text" name="endDate" id="datepicker2" class="form-control" required placeholder="End Date">
								<span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-7">
							<div class="input-group" style="max-width:200px">
								<input type="button" value="Submit" id="submit" />
							</div>
						</div>
					</div>
				</div>
				<br>
				
			</form>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
			
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="chart_div" style="width: 100%; height: 400px;"></div>
				<div id="table_div" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<?php if($event_selected == "Lesehan Enduro") { ?>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="chart_div_product" style="width: 100%; height: 400px;"></div>
				<div id="table_div_product" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<?php } ?>
				
		<br><br>
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
						Data Pelanggan
				</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
							<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
													<tr>
															<th style="display:none">#</th>
															<th>Nama</th>
															<th>Email</th>
															<th>KTP</th>
															<th>Gender</th>
															<th>Telepon</th>
															<th>Hadiah</th>
															<th>Twitter</th>
													</tr>
											</thead>
		
											<tbody>
												<?php $x = 1;foreach($all_member as $value) { ?>
												<tr class="odd gradeX">
													<td style="display:none" align="center"><?php echo $x; ?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['email']; ?></td>
													<td><?php echo $value['ktp']; ?></td>
													<td><?php echo $value['gender']; ?></td>
													<td><?php echo $value['phone']; ?></td>
													<td><?php echo $value['prize']; ?></td>
													<td><?php echo $value['twitter']; ?></td>
												</tr>
												<?php $x++;} ?>
												<!--<tr class="odd gradeX">
													<td style="display:none" align="center">1</td>
													<td>Adi</td>
													<td>adi@adi.com</td>
													<td>30039938377181</td>
													<td>Laki-laki</td>
													<td>08975761496</td>
													<td>Maaf anda belum beruntung</td>
													<td>@adiadiadi</td>
												</tr>
												
												<tr class="odd gradeX">
													<td style="display:none" align="center">1</td>
													<td>Tommy</td>
													<td>tommy@heros.com</td>
													<td>30039938377181</td>
													<td>Laki-laki</td>
													<td>08975761496</td>
													<td>Maaf anda belum beruntung</td>
													<td>@tommy</td>
												</tr>-->
											</tbody>
									</table>
							</div>
							<!-- /.table-responsive -->
							
					</div>
					<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="piechart" style="width: 100%;"></div>
				</div>
			</div>
			
		</div>
		<?php if(!preg_match($pattern,$event_selected)) { ?>
		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-body" style="padding-bottom:0px">
					<div class="col-md-12 col-sm-6 col-xs-12" style="padding:0px">
						<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Total Paket</span>
							<span class="info-box-number" id="total_paket"></span>
							<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description fromtodate"></span>
						</div><!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</div>
					
					<div class="col-md-12 col-sm-6 col-xs-12" style="padding:0px">
						<div class="info-box bg-green">
						<span class="info-box-icon"><i class="fa fa-money"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Total Harga</span>
							<span class="info-box-number" id="total_harga"></span>
							<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description fromtodate"></span>
						</div><!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		