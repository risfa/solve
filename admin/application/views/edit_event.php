<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit Event</h1>
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
					<form class="form-horizontal" method="post" action="<?php echo base_url() ?>edit_event/doEdit/<?php echo $event_selected ?>" enctype="multipart/form-data">
						<?php if($data_event){ 
										$image = json_decode($data_event['image'],true);
						?>
						<div class="form-group">
						<label class="col-sm-2 control-label">Nama Event</label>
						<div class="col-sm-10">
							<label style="margin-top:7px;"><?php echo $data_event['event_name']; ?></label>
							<input type="hidden" class="form-control" name="namaEvent" placeholder="Nama Event" value="<?php echo $data_event['event_name']; ?>" required autofocus>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Start Date</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:200px">
								  <input type="text" name="startDate" id="datepicker" class="form-control" required placeholder="Start Date" value="<?php echo date("Y-m-d",strtotime($data_event['start_date'])); ?>">
								  <span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:200px">
								  <input type="text" name="endDate" id="datepicker2" class="form-control" required placeholder="End Date" value="<?php echo date("Y-m-d",strtotime($data_event['end_date'])); ?>">
								  <span class="input-group-addon" id="dating"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Banner Image</label>
							<div class="col-sm-10">
								<div class="input-group">
									<span><img width="20%" src="<?php echo base_url()."files/".$data_event['event_name']."/".$image['banner_image']; ?>"/></span>
								  <input type="file" name="banner_image" class="form-control">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<div class="input-group" style="margin-top:5px;">
								  <input type="color" name="color" value="<?php echo $data_event['color'] ?>" required>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Total Team Leader</label>
							<div class="col-sm-10">
								<div class="input-group" style="max-width:100px">
								  <input type="text" name="totalTL" class="form-control" required placeholder="ex: 1" value="<?php echo $data_event['total_tl']; ?>">
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
							- Change Password Admin - 
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<label style="margin-top:7px;"><?php echo $data_event['username']; ?></label>
							<input type="hidden" class="form-control" name="username" placeholder="Username" required value="<?php echo $data_event['username']; ?>">
							<input type="hidden" name="event" value="<?php echo $event_selected; ?>">
							<input type="hidden" name="id" value="<?php echo $data_event['event_id']; ?>">
							<input type="hidden" name="admin_id" value="<?php echo $data_event['admin_id']; ?>">
							<input type="hidden" name="password" value="<?php echo $data_event['password']; ?>">
							<input type="hidden" name="beforeUpdateImage" value="<?php echo $image['banner_image']; ?>">
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="newpassword" placeholder="Password">
						</div>
						</div>
						<?php } ?>
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
</div>