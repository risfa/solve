
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit Team Leader</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
        
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url() ?>edit_team_leader/doEdit/<?php echo $_SESSION['event'][0]; ?>" enctype="multipart/form-data">
						<?php 
							if($data_tl){ 
								$data = json_decode($data_tl['misc'],true);
						?>
						<input type="hidden" name="id" value=<?php echo $data_tl['admin_id']; ?>/>
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $data_tl['username']; ?>" required autofocus>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $data_tl['password']; ?>" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Handphone</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Handphone" name="hp" value="<?php echo $data['hp']; ?>" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Email" name="mail" value="<?php echo $data['email']; ?>" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<textarea class="form-control" placeholder="Address" name="address" required><?php echo $data['alamat']; ?></textarea>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Gender</label>
						<div class="col-sm-10">
							<input type="radio" name="gender" value="Laki-laki" <?php echo ($data['gender']=="Laki-laki")? "checked":""; ?>>Laki-laki
							<input type="radio" name="gender" value="Perempuan" <?php echo ($data['gender']=="Perempuan")? "checked":""; ?>>Perempuan
						</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Submit</button> 
							<button onclick="goBack()" type="button" class="btn btn-default">Cancel</button>
						</div>
						</div>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
        <!-- /#page-wrapper -->
		