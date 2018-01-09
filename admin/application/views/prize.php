<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Insert Prize</h1>
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
					<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>prize/doUpdate/<?php echo $event_selected; ?>" enctype="multipart/form-data">
						<input type="hidden" value="<?php echo $event_selected; ?>" name="event"/>
						<?php if(count($prize) > 0) { ?>
						<input type="hidden" value="<?php echo $prize['prize_id']; ?>" name="id"/>
						<?php } ?>
						<div id="form">
							<?php
								// print_r($prize);die;
								$loc = "";
								if(!empty($location) && $location != "") {
										foreach($location as $value) {
											$loc .= "<label class='col-sm-2 control-label'>Location</label><div class='col-sm-4'><div class='input-group' style='max-width:100px'><input type='text' name='locationTotalHadiah[]' class='form-control' value='".$value['location_name']."' required></div></div><label class='col-sm-2 control-label'>Total</label><div class='col-sm-4'><div class='input-group' style='max-width:80px'><input type='text' name='totalHadiah[]' class='form-control' required></div></div>";
										}
									}
								if(!empty($prize['prize']) && $prize['prize'] !== "") {
									$data = json_decode($prize['prize'],TRUE);
									// print_r($data);die;
									foreach($data as $key=>$value) {
										if(!empty($location) && $location != "") {
							?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Hadiah</label>
								<div class="col-sm-10">
									<input type="text" name="hadiah[]" class="form-control" value="<?php echo (isset($location)) ? $key : $k; ?>" required>
								</div>
							</div>
							<div class="form-group">
										<label class="col-sm-2"></label>
										<div class="col-sm-10 form-inline">
										
										<table class="table table-striped">
												<tr>
													<th>Location</th>
													<th>Total</th>
													<th>Redeem</th>
												</tr>
							<?php
										}
										foreach($value as $k=>$v) {
											// echo "<pre>";print_r($v);die;
											if($k !== "redeem") {
												if($location == "") {
							?>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Hadiah</label>
								<div class="col-sm-10">
									<input type="text" name="hadiah[]" class="form-control" value="<?php echo (isset($location)) ? $key : $k; ?>" required>
								</div>
							</div>
							
							
								<?php
												}
									if(!empty($location) && $location != "") {
										foreach($v as $x=>$y) {
											if($x != "redeem") {
								?>
													
													<tr>
														<td><input type="hidden" name="locationTotalHadiah[]" value="<?php echo $x; ?>"><?php echo $x; ?></td>
														<td><input type='text' name='totalHadiah[]' class='form-control input-sm' value="<?php echo $y?>" required></td>
														<td><?php echo $v['redeem']; ?></td>
													</tr>
											
											<!--<div class="form-group" style="padding:10px">
												<label>Location:</label>
												<label style="padding-right:70px"><?php //echo $x; ?></label>
											</div>
											<div class="form-group" style="padding:10px">
												<label>Total:</label>
												<input style="margin-right:70px" type='text' name='totalHadiah[]' class='form-control input-sm' value="<?php //echo $y?>" required>
											</div>
											<div class="form-group" style="padding:10px">
												<label>Redeem:</label>
												<label><?php //echo $v['redeem']; ?></label>
											</div>-->
											
									
								
								<?php
											}
										}
									} else {
								?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Total</label>
								<input type="text" name="totalHadiah[]" class="form-control" value="<?php echo $v; ?>" required>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Redeem</label>
								<label class="control-label"><?php echo $value['redeem'] ?></label>
							</div>
							
							<?php 
								} 
							?>
							
							
						
							<?php 
											}
										}
							?>
								</table>
								</div>
							</div>
							<?php
									}
								} else {
							?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Hadiah</label>
								<div class="col-sm-10">
									<input type="text" name="hadiah[]" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<?php 
									if(!empty($loc) && $loc != "") {
										echo $loc;
									} else {
								?>
								<label class="col-sm-2 control-label">Total</label>
								<div class="col-sm-10">
									<div class="input-group" style="max-width:80px">
										<input type="text" name="totalHadiah[]" class="form-control" required>
									</div>
								</div>
							</div>
							<?php
									}
								}
							?>
							
						</div>
						
						<!--<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
							<label style="color:red"><i>Error message here</i></label>
						</div>
						</div>-->
						<div class="form-group" id="buttonSubmit">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="button" onclick="add_fields()" class="btn btn-success">+ Add More Fields</button> 
							<button type="submit" class="btn btn-info">Submit</button> 
							<button onclick="goBack()" type="button" class="btn btn-default">Cancel</button>
						</div>
						</div>
					</form>
					<script>
								function add_fields() {
									var loc = "<?php echo $loc; ?>";
									var html = "";
									if(loc != "") {
										html += '<div class="form-group">'+
																	'<label class="col-sm-2 control-label">Nama Hadiah</label>'+
																	'<div class="col-sm-10">'+
																		'<input type="text" name="hadiah[]" class="form-control">'+
																	'</div>'+
																'</div>'+
																'<div class="form-group">'+
																	loc+
																'</div><hr>';
									} else {
										html = '<div class="form-group">'+
																'<label class="col-sm-2 control-label">Nama Hadiah</label>'+
																'<div class="col-sm-10">'+
																	'<input type="text" name="hadiah[]" class="form-control">'+
																'</div>'+
															'</div>'+
															'<div class="form-group">'+
																'<label class="col-sm-2 control-label">Total</label>'+
																'<div class="col-sm-10">'+
																	'<div class="input-group" style="max-width:80px">'+
																		'<input type="text" name="totalHadiah[]" class="form-control">'+
																	'</div>'+
																'</div>'+
															'</div><hr>';
									}
									// document.getElementById('form').innerHTML += html;
									$(html).insertBefore("#buttonSubmit");
								}
						</script>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->