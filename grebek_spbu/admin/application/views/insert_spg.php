<script>
	function doDelete(username){
		if (confirm('Are you sure you want to delete SPG '+username+'?')) {
			return true;
		}else{
			return false;
		}
	}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Insert & Edit SPG</h1>
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
					<div class="panel-heading">
							SPG (Sales Promotion Girl)
					</div>
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
									<?php foreach($data_spg as $value){ ?>
									<tr class="odd gradeX">
										<td><?php echo $value['username']; ?></td>
										<td><?php echo $value['last_login']; ?></td>
										<td>
											<a href="<?php echo base_url("/edit_spg/".$value['spg_id']."/"); ?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
											<a href="<?php echo base_url("/insert_spg/doDelete/".$value['spg_id']); ?>"><button type="button" class="btn btn-danger btn-xs" onclick="return doDelete('<?php echo $value['username']; ?>')">Delete</button></a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<a href="<?php echo base_url("/add_spg/"); ?>" class="btn btn-info btn-md"> + Add SPG</a>
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