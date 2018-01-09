<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Change Password</h1>
			<?php if($this->session->flashdata('message')){ ?>
			<div class="alert alert-<?php echo $this->session->flashdata('message')[0]; ?>" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message')[1]; ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
			<?php
                $this->session->set_flashdata("message",array());
			} ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
        
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url() ?>change_password/doChangePassword/" enctype="multipart/form-data">
						<?php if($data_tl){ ?>
						<input type="hidden" name="id" value="<?php echo $data_tl['admin_id']; ?>" />
						<div class="form-group">
						<label class="col-sm-2 control-label">Old Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="oPassword" value="" required placeholder="Enter old password.." autofocus>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">New Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="nPassword" value="" required placeholder="Enter new password">
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Confirm New Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="cnPassword" value="" required placeholder="Re-type new password">
						</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Submit</button> 							
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