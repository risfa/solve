<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Team Leader</h1>
			<?php if($this->session->flashdata('message')){ ?>
			<div class="alert alert-<?php echo $this->session->flashdata('message')[0]; ?>" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message')[1]; ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
			<?php } ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>harga/doUpdate/<?php echo $event_selected; ?>" enctype="multipart/form-data">
						<?php if($harga){ ?>
						<input type="hidden" value="<?php echo $harga['event_id']; ?>" name="id"/>
						<input type="hidden" value="<?php echo $event_selected; ?>" name="event"/>
						<div class="form-group">
						<label class="col-sm-2 control-label">Harga per paket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="harga" placeholder="example: 30000" value="<?php echo $harga['harga']; ?>">
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
<!-- /#page-wrapper -->