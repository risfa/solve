<script>
	function doDelete(username,url){
		if (confirm('Are you sure you want to delete '+username+'?')) {
		    location.href=url;
		}
	}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Insert & Edit Team Leader</h1>
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
				<div class="panel-heading">Team Leaders</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Username</th>
									<th>Last Login</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									// echo "<pre>";print_r($all_tl);die;
									foreach($all_tl as $value){
								?>
								<tr class="odd gradeX">
									<td><?php echo $value['username']; ?></td>
									<td><?php echo $value['last_login']; ?></td>
									<td>
										<a href="<?php echo base_url("/edit_team_leader/".$value['admin_id']); ?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
										<a href="javascript:void(0)"><button type="button" class="btn btn-danger btn-xs" onclick="return doDelete('<?php echo $value['username']; ?>','<?php echo base_url("/add_team_leader/doDelete/".$value['admin_id']); ?>')">Delete</button></a>
									</td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
						<?php if(count($all_tl) < $this->config->item("max_tl")){ ?>
						<a href="<?php echo base_url("/add_team_leader/"); ?>" class="btn btn-info btn-md"> + Add Team Leader</a>
						<?php } ?>
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
		