<script>
	function doDelete(username){
		if (confirm('Are you sure you want to delete Event '+username+'?')) {
			return true;
		}else{
			return false;
		}
	}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Create Event</h1>
			<?php if($this->session->flashdata('message')){ ?>
			<div class="alert alert-<?php echo $this->session->flashdata('message')[0]; ?>" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message')[1]; ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
			<?php } ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url() ?>home/addEvent" enctype="multipart/form-data">
						<div class="form-group">
						<label class="col-sm-2 control-label">Nama Event</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="namaEvent" placeholder="Nama Event" required autofocus>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Start Date</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:200px">
								  <input type="text" name="startDate" id="datepicker" class="form-control" required placeholder="Start Date">
								  <span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:200px">
								  <input type="text" name="endDate" id="datepicker2" class="form-control" required placeholder="End Date">
								  <span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Banner Image</label>
							<div class="col-sm-10">
								<div class="input-group">
								  <input type="file" name="banner_image" class="form-control" required>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<div class="input-group" style="margin-top:5px;">
								  <input type="color" name="color" required>
								</div>
							</div>
						</div>
						
						<!--<div class="form-group">
							<label class="col-sm-2 control-label">Background Image</label>
							<div class="col-sm-10">
								<div class="input-group">
								  <input type="file" name="bg_image" class="form-control" required>
								</div>
							</div>
						</div>-->
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Total Team Leader</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
								  <input type="text" name="totalTL" class="form-control" required placeholder="ex: 1">
								  <span class="input-group-addon" id="dating"><i class="fa fa-user"></i></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Max SPG / TL</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
								  <input type="text" name="maxspg" class="form-control" required placeholder="ex: 1">
								  <span class="input-group-addon" id="dating"><i class="fa fa-user"></i></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Location</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
									<input type="checkbox" name="location">
								  <!--<input type="text" name="maxspg" class="form-control" required placeholder="ex: 1">
								  <span class="input-group-addon" id="dating"><i class="fa fa-user"></i></span>-->
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Hadiah / Location</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
									<input type="checkbox" name="location">
								  <!--<input type="text" name="maxspg" class="form-control" required placeholder="ex: 1">
								  <span class="input-group-addon" id="dating"><i class="fa fa-user"></i></span>-->
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Teaser</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
									<input type="checkbox" name="teaser">
								  <!--<input type="text" name="maxspg" class="form-control" required placeholder="ex: 1">
								  <span class="input-group-addon" id="dating"><i class="fa fa-user"></i></span>-->
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-12">
								<hr>
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
							- Create Admin - 
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Username" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
						</div>
						<!--<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
							<label style="color:red"><i>Error message here</i></label>
						</div>
						</div>-->
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Submit</button> 
							<button onclick="goBack()" type="button" class="btn btn-default">Cancel</button>
						</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					DataTables Advanced Tables
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="display:none">#</th>
									<th>Event Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Harga per Paket</th>
									<th>Total TL</th>
									<th>Image</th>
									<th>Color</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
											$today = date("Y/m/d");
											foreach($event as $k=>$v){ 
												$image = json_decode($v['image'],TRUE);
												if(strtotime($today) >= strtotime($v['start_date']) && strtotime($today) <= strtotime($v['end_date'])) {
													$status = "<a class='btn btn-info btn-xs'>".ucfirst($v['event_status'])."</a>";
												} else if (strtotime($today) < strtotime($v['start_date'])) {
													$status = "<a class='btn btn-default btn-xs'>Waiting for Event</a>";
												} else if (strtotime($today) > strtotime($v['end_date'])){
													$status = "<a class='btn btn-default btn-xs'>Expired</a>";
												}
								?>
								<tr class="odd gradeX">
									<td style="display:none" align="center">1</td>
									<td><?php echo $v['event_name'] ?></td>
									<td><?php echo date("d F Y",strtotime($v['start_date'])); ?></td>
									<td><?php echo date("d F Y",strtotime($v['end_date'])); ?></td>
									<td class="center"><?php echo $v['harga']; ?></td>
									<td class="center"><?php echo $v['total_tl']; ?></td>
									<td class="center"><img width="80px" src="<?php echo base_url()."/files/".$v['event_name']."/".$image['banner_image']; ?>" /></td>
									<td class="center"><span width="20px" height="10px" style="background-color:<?php echo $v['color'] ?>"><?php echo $v['color'] ?></span></td>
									<td class="center"><?php echo $status ?></td>
									<td>
										<a href="<?php echo base_url("/edit_event/".$v['event_id']."/".$v['event_name']); ?>" class="btn btn-success btn-xs">Edit</a> 
										<a href="<?php echo base_url("/home/doDelete/".$v['event_id']); ?>"><button type="button" class="btn btn-danger btn-xs" onclick="return doDelete('<?php echo $v['event_name']; ?>')">Delete</button></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>