<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Team Leader</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>add_team_leader/doAdd/<?php echo $event_selected; ?>">
						<input type="hidden" value="<?php echo $event_selected ?>" name="event"/>
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Handphone</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="hp" placeholder="Handphone" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="mail" placeholder="Email" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="address" placeholder="Address" required></textarea>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Gender</label>
						<div class="col-sm-10">
							<input type="radio" name="gender" value="Laki-laki" checked required>Laki-laki
							<input type="radio" name="gender" value="Perempuan" required>Perempuan
						</div>
						</div>
						<!--<div class="form-group">
						<label class="col-sm-2 control-label">Photo</label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
						</div>
						</div>
						<div class="form-group">
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
        <!-- /#page-wrapper -->