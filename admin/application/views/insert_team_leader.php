<script>
	function doDelete(id,username){
		if (confirm('Are you sure you want to delete '+username+'?')) {
			return true;
		}else{
			return false;
		}
	}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Insert Team Leader</h1>
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
				<div class="panel-heading">Team Leaders</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>No. Handphone</th>
									<th>Email</th>
									<th>Adress</th>
									<th>Gender</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									// print_r($total_tl);die;
									foreach($all_tl as $value){
										$data = json_decode($value['misc'],true);
								?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $value['username']; ?></td>
									<td><?php echo $data['hp']; ?></td>
									<td><?php echo $data['email']; ?></td>
									<td><?php echo $data['alamat']; ?></td>
									<td><?php echo $data['gender']; ?></td>
									<td>
										<a href="<?php echo base_url("/edit_team_leader/".$value['admin_id']."/".$event_selected); ?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
										<a href="<?php echo base_url("/insert_team_leader/doDelete/".$value['admin_id']); ?>"><button type="button" class="btn btn-danger btn-xs" onclick="return doDelete(<?php echo $value['admin_id']; ?>,'<?php echo $value['username']; ?>')">Delete</button></a>
									</td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
						<?php if(count($all_tl) < $total_tl){ ?>
						<a href="<?php echo base_url("/add_team_leader/".$event_selected); ?>" class="btn btn-info btn-md"> + Add Team Leader</a>
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
		