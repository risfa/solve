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
                   
				   <?php if($this->session->flashdata('message')){ ?>
					<div class="alert alert-<?php echo $this->session->flashdata('message')[0]; ?>" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message')[1]; ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
					<?php } ?>
				   
					<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>add_team_leader/doAdd/">
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?=$username?>" name="username" placeholder="Username" required autofocus>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Retype Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="cpassword" placeholder="Retype Password" required>
                            </div>
                        </div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Submit</button> 
							<button onclick="goBack()" type="button" class="btn btn-default">Back</button>
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