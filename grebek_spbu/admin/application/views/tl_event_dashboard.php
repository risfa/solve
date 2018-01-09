<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="/solve/global_assets/datepicker/js/bootstrap-datepicker.js"></script>
<script>
	google.load("visualization", "1", {packages:["corechart,table"]});
	var start_date;
	var end_date;
	$(document).ready(function(){
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            forceParse: false
        });
        $('#datepicker2').datepicker({
            format: "yyyy-mm-dd",
            forceParse: false
        });
		start_date = $("#datepicker").val();
		end_date = $("#datepicker2").val();
		api_get_data(start_date,end_date,0);
		// setInterval(function(){ api_get_data(start_date,end_date,0); }, 4000);
		$("#submit").click(function(){
			start_date = $("#datepicker").val();
			end_date = $("#datepicker2").val();
			api_get_data(start_date,end_date,0);
		});
		$("#export").on("click",function(){
			api_get_data(start_date,end_date,1);
		})
	});
	
	function api_get_data(start_date,end_date,flag) {
		$.ajax({
			url: "<?php echo base_url() ?>api_get_data/",
			type: "POST",
			data: {
				start_date: encodeURIComponent(start_date),
				end_date: encodeURIComponent(end_date),
				status: "<?php echo $this->session->userdata("status") ?>"
			},
			success: function(resp){
				if(flag == 0) {
					user(resp);
					data_user(resp);
					pie_user(resp);
					merchant(resp);
					data_merchant(resp);
					pie_merchant(resp);
				} else {
					download(resp);
				}
			},
		});
	}
	
	function data_user(resp) {
		var result = JSON.parse(resp);
		var html;
		var json = [];
		if(result.data_user.length > 0) {
			$.each(result.data_user,function(key,val) {
				json.push(val);
			});
      $('#dataTables').dataTable({
				"aaData": json,
				"aoColumns": [
					{"mDataProp": "created"},
					{"mDataProp": "created_by"},
					{"mDataProp": "hp"},
					{"mDataProp": "top_up"}, 
					{"mDataProp": "no_serial"},
					{
						"mDataProp": "gimmick",
						"render": function( mData ) {
							if(mData == 1) {
								return "Yes";
							} else {
								return "No";
							}
            }
					}
				]
			});
		} else {
			html += '<tr class="odd gradeX">'+
								'<td colspan="5" align="center">There\'s no data</td>'+
							'</tr>';
			$("#all_user").html(html);
		}
	}
	
	function data_merchant(resp) {
		var result = JSON.parse(resp);
		var html;
		var json = [];
		if(result.data_merchant.length > 0) {
			$.each(result.data_merchant,function(key,val) {
				json.push(val);
			});
			$('#dataTables2').dataTable({
				"aaData": json,
				"aoColumns": [
					{"mDataProp": "created"},
					{"mDataProp": "created_by"},
					{"mDataProp": "nama_toko"}, 
					{"mDataProp": "kategori"}, 
					{"mDataProp": "nama_pemilik"},
					{"mDataProp": "hp"},
					{"mDataProp": "ktp"},
					{	
						"mDataProp": "tertarik",
						"render": function( mData ) {
							if(mData == 1) {
								return "Yes";
							} else {
								return "No";
							}
            }
					}
				]
			});
		} else {
			html += '<tr class="odd gradeX">'+
								'<td colspan="7" align="center">There\' no data</td>'+
							'</tr>';
			$("#all_merchant").html(html);
		}
	}
	
	function pie_user(resp) {
		var result = JSON.parse(resp);
		var finalobject = new Array();
		var counter = 0;
		if(result.data_user.length > 0) {
			finalobject[0] = ['Top Up','Total'];
			$.each(result.top_up,function(key,val) {
				counter++;
				finalobject[counter] = [key,(typeof(val) != "undefined"?parseInt(val):0)];
			});
			var data = google.visualization.arrayToDataTable(finalobject);
			
			var options = {
				title: 'Top Up'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_topup'));

			chart.draw(data, options);
		} else {
			$("#piechart_topup").html("There's no data")
		}
	}
	
	function pie_merchant(resp) {
		var result = JSON.parse(resp);
		var finalobject = new Array();
		var counter = 0;
		if(result.data_merchant.length > 0) {
			finalobject[0] = ['Kategory','Total'];
			$.each(result.kategori,function(key,val) {
				counter++;
				finalobject[counter] = [key,(typeof(val) != "undefined"?parseInt(val):0)];
			});
			var data = google.visualization.arrayToDataTable(finalobject);
			
			var options = {
				title: 'Kategori'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_kategori'));

			chart.draw(data, options);
		} else {
			$("#piechart_kategori").html("There's no data");
		}
	}
	
	function user(resp) {
		var result = JSON.parse(resp);
		var finalobject = new Array();
		var counter = 0;
		finalobject[0] = ['Date'];
		if(result.data_user.length > 0){
			$.each(result.data_tl,function(key,value){																					
				finalobject[0].push(value);						
			});
			$.each(result.user,function(key,val) {
				counter++;
				finalobject[counter] = [key];
				$.each(val,function(x,y) {
					finalobject[counter].push(typeof(y)!="undefined"?parseInt(y):0);
				});
			});
			// console.log(finalobject);
			var data = google.visualization.arrayToDataTable(finalobject);
			
			var dataTable = google.visualization.arrayToDataTable(finalobject);
			
			var options = {
				title : 'User',
				vAxis: {title: "Total User"},
				hAxis: {title: "Daily"},
				seriesType: "bars",
				series: ""
			};
			
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_user'));
			chart.draw(data, options);
			
			var table = new google.visualization.Table(document.getElementById('table_div_user'));
			table.draw(dataTable,{width: "100%",page:'enable',pageSize:10});
		} else {
			$("#chart_div_user").html("There's no data");
		}
	}
	
	function merchant(resp) {
		var result = JSON.parse(resp);
		var finalobject = new Array();
		var counter = 0;
		finalobject[0] = ['Date'];
		if(result.data_merchant.length > 0) {
			$.each(result.data_tl,function(key,value){																					
				finalobject[0].push(value);						
			});
			$.each(result.merchant,function(key,val) {
				counter++;
				finalobject[counter] = [key];
				$.each(val,function(x,y) {
					finalobject[counter].push(typeof(y)!="undefined"?parseInt(y):0);
				});
			});
			// console.log(finalobject);
			var data = google.visualization.arrayToDataTable(finalobject);
			
			var dataTable = google.visualization.arrayToDataTable(finalobject);
			
			var options = {
				title : 'Merchant',
				vAxis: {title: "Total Merchant"},
				hAxis: {title: "Daily"},
				seriesType: "bars",
				series: ""
			};
			
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_merchant'));
			chart.draw(data, options);
			
			var table = new google.visualization.Table(document.getElementById('table_div_merchant'));
			table.draw(dataTable,{width: "100%",page:'enable',pageSize:10});
		} else {
			$("#chart_div_merchant").html("There's no data");
		}
	}
    function download(data) {
        $.ajax({
            type: 'POST',
            data: {data : data},
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
                        <div class="col-sm-4" style="padding-left:30px"> <input type="button" class="btn btn-primary" value="Submit" id="submit" /></div>
                        <div class="col-sm-8"><input type="button" value="Export to Excel" id="export" class="btn btn-success"/></div>
                    </div>
                </div>
                <br>

            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="chart_div_user" style="width: 100%; height: 400px;"></div>
				<div id="table_div_user" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		
		
		
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
						Data User
				</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
							<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables">
											<thead>
													<tr>
														<th>Date</th>
														<th>SPG Name</th>
														<th>No. Handphone</th>
														<th>Top Up</th>
														<th>No Serial Sticker</th>
														<th>Gimmick</th>
													</tr>
											</thead>
		
											<tbody id="all_user">
												
											</tbody>
									</table>
							</div>
							<!-- /.table-responsive -->
							
					</div>
					<!-- /.panel-body -->
			</div>
			<!-- /.panel -->			
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="piechart_topup" style="width: 100%;height:350px"></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="piechart_kategori" style="width: 100%;height:350px"></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="chart_div_merchant" style="width: 100%; height: 400px;"></div>
				<div id="table_div_merchant" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		
		<br><br>
		
		
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
						Data Merchant
				</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
							<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables2">
											<thead>
													<tr>
														<th>Date</th>
														<th>SPG Name</th>
														<th>Nama Toko</th>
														<th>Kategory</th>
														<th>Nama Pemilik</th>
														<th>No. Handphone</th>
														<th>No KTP</th>
														<th>Tertarik / Tidak</th>
													</tr>
											</thead>
		
											<tbody id="all_merchant">
												
											</tbody>
									</table>
							</div>
							<!-- /.table-responsive -->
							
					</div>
					<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		
		
		
		
	</div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->