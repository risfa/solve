
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
                    <?php if($this->session->flashdata('message')){ ?>
					<div class="alert alert-<?php echo $this->session->flashdata('message')[0]; ?>" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message')[1]; ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
					<?php } ?>
					<form class="form-horizontal" method="post" action="<?php echo base_url() ?>edit_team_leader/doEdit/" enctype="multipart/form-data">
						<?php 
							if($data_tl){ 
						?>
						<input type="hidden" name="id" value="<?php echo $data_tl['admin_id']; ?>">
						<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $data_tl['username']; ?>" required autofocus>
                            <input type="hidden" class="form-control" placeholder="Username" name="username_old" value="<?php echo $data_tl['username']; ?>" required autofocus>
                        </div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">New Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" placeholder="If you do not want to set New Password, leave this filed blank" name="password" value="">
						</div>
						</div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Retype Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="cpassword" placeholder="Retype password if you set new password">
                                    </div>
                                </div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Submit</button> 
							<button onclick="goBack()" type="button" class="btn btn-default">Back</button>
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
		