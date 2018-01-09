<?php
	$pattern = "/samsung.*/i";
	$start_date = date("Y-m-d",strtotime($event['start_date']));
	$today = date("Y-m-d");
	$end_date = $today;
	if(strtotime($event['end_date']) == strtotime($today)){
		$end_date = date("Y-m-d",strtotime($event['end_date']));
	}
	$soal_jawaban = array();
	if(preg_match($pattern,$event_selected)) {
		$jawaban = array();
		foreach($all_member as $value) {
			if($value['jawaban'] != ""){
				$data_jawaban = json_decode($value['jawaban']);
			}
			foreach($data_jawaban as $v) {
				if(isset($jawaban[$v])) $jawaban[$v] += 1;
				else $jawaban[$v] = 1;
			}
		}
		
		// $soal_jawaban = array();
		foreach($all_soal as $value) {
			foreach($all_jawaban as $val) {
				$tmp_jawaban = json_decode($val['jawaban'],true);
				if($value['soal_id'] == $val['soal_id']) {
					foreach($tmp_jawaban as $v){
						$soal_jawaban[$value['pertanyaan']][$v] = 0;
					}
				}
			}
		}
		foreach($jawaban as $ans => $total) {
			foreach($soal_jawaban as $key => $value) {
				foreach($value as $k => $v) {
					if($ans === $k) {
						$soal_jawaban[$key][$k] = $total;
					}
				}
			}
		}
	}
?>

<script type="text/javascript">
	var start_date,end_date,
				event_selected = '<?php echo $event_selected; ?>',
				pattern = <?php echo $pattern; ?>,
				soal = <?php echo json_encode($soal_jawaban) ?>,
				show_paket_harga = <?php echo $show_paket_harga ?>;
	$(document).ready(function(){
		$("#datepicker").val("<?php echo $start_date ?>");
		$("#datepicker2").val("<?php echo $end_date ?>");
		start_date = $("#datepicker").val();
		end_date = $("#datepicker2").val();
		api_get_data(start_date,end_date,0);
		// setInterval(function(){ api_get_data(start_date,end_date,0); }, 4000);
		api_get_data(start_date,end_date,0);
		$("#submit").click(function(){
			start_date = $("#datepicker").val();
			end_date = $("#datepicker2").val();
			api_get_data(start_date,end_date,0);
		});
		$("#export").on("click",function(){
			api_get_data(start_date,end_date,1);
		})
	});
	
	function change(time) {
    var r = time.match(/^\s*([0-9]+)\s*-\s*([0-9]+)\s*-\s*([0-9]+)(.*)$/);
    return r[1]+r[2]+r[3];
	}
		
	function api_get_data(start_date,end_date,flag){
		var event_name = "<?php echo $event['event_name']; ?>";
		$.ajax({
			url: "<?php echo base_url() ?>api_get_data/"+encodeURIComponent(event_name)+"/"+encodeURIComponent(start_date)+"/"+encodeURIComponent(end_date)+"/admin",
			success: function(resp){
				if(flag == 0) {
					graph(resp);
					// member(resp);
					gender(resp);
					if(event_selected == "Lesehan Enduro") {
						product(resp);
						paket(resp);
					} else {
						if(pattern.test(event_selected)) {
							// console.log(2);return;
							var question = JSON.stringify(soal);
							soal(question);
						} else {
							paket(resp);
						}
					}
				} else {
					download(resp);
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
	
	function download(json){
		var tmp = $.parseJSON(json);
		if(event_selected == "Lesehan Enduro") {
			var data = {leader_name: tmp['leader_name'],leader_data: tmp['leader_data'],paket_total_harga: tmp['paket_total_harga'],total_gender: tmp['total_gender'], total_leader: tmp['total_leader'], user: '<?php echo $_SESSION['username'] ?>', event: '<?php echo $event['event_name'] ?>', start_date: encodeURIComponent(start_date), end_date: encodeURIComponent(end_date), product_name: tmp['product_name'], product: tmp['product']};
		} else {
			var data = {leader_name: tmp['leader_name'],leader_data: tmp['leader_data'],paket_total_harga: tmp['paket_total_harga'],total_gender: tmp['total_gender'], total_leader: tmp['total_leader'], user: '<?php echo $_SESSION['username'] ?>', event: '<?php echo $event['event_name'] ?>', start_date: encodeURIComponent(start_date), end_date: encodeURIComponent(end_date)};
		}
		var startDate = change(start_date);
		var endDate = change(end_date);
		var filename = '<?php echo $_SESSION['username'] ?>'+"_"+'<?php echo $event['event_name'] ?>'+"_"+startDate+"_"+endDate+".xls"
		$.ajax({
			type: 'POST',
			data: data,
			url: "<?php echo base_url() ?>export_excel",
			success: function(resp){
				// e.preventDefault();  //stop the browser from following
				window.location.replace('/solve/admin/files/Lesehan Enduro/'+filename);
			}
		});
	}
	
	function soal(json){
		var result = $.parseJSON(json);
		var i = 0;
		$.each(result,function(x,y) {
			var finalobject = new Array();
			var counter = 0;
			finalobject[0] = ['Jawaban','Total'];
			$.each(y,function(k,v) {
				counter += 1;
				finalobject[counter] = [k,typeof(v)!="undefined"?parseInt(v):0];
			});
			var options = {
        title: x,
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total',
          minValue: 0
        },
        vAxis: {
          title: 'Answer'
        }
      };
			var data = google.visualization.arrayToDataTable(finalobject);
			
			var chart = new google.visualization.BarChart(document.getElementById('soal'+i));
      chart.draw(data, options);
			i += 1;
		});
	}
	
	function member(json) {
		var result = $.parseJSON(json);
		var html = "";
		var dataObject = result['all_member'];
		var i = 1;
		$.each(dataObject,function(x,y){
			html += '<tr class="odd gradeX">'+
										'<td style="display:none" align="center">'+i+'</td>'+
										'<td>'+y['name']+'</td>'+
										'<td>'+y['email']+'</td>'+
										'<td>'+y['ktp']+'</td>'+
										'<td>'+y['gender']+'</td>'+
										'<td>'+y['phone']+'</td>'+
										'<td>'+y['prize']+'</td>'+
										'<td>'+y['twitter']+'</td>'+
										'<td>'+y['lokasi']+'</td>'+
									'</tr>';
			i += 1;
		});
		$("#all_member").html(html);
	}
	
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
		
		// console.log(finalobject);return;
		
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
		
		// console.log(options);return;
		
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
						<!--<div class="col-sm-7">
							<div class="input-group" style="max-width:200px">
								<input type="button" value="Submit" id="submit" />
							</div>
						</div>-->
						<div class="col-sm-4" style="padding-left:30px"> <input type="button" value="Submit" id="submit" /></div>
						<div class="col-sm-8"><input type="button" value="Export to Excel" id="export" /></div>
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
															<th>Lokasi</th>
															<!--<th>Poin</th>-->
													</tr>
											</thead>
		
											<tbody id="all_member">
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
													<td><?php echo preg_replace("/tl/","",$value['leader_name']); ?></td>
													<!--<td><?php echo $value['poin']; ?></td>-->
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
		
		<?php if($event['event_name'] == "Samsung Store") { for($i=0;$i<count($soal_jawaban);$i++){ ?>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="soal<?php echo $i; ?>" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<?php }} ?>
		
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