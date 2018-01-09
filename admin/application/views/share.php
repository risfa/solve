<?php if($this->session->flashdata('message')){ ?>
<div class="alert alert-success" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('message'); ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
<?php } ?>
<?php if($this->session->flashdata('error_message')){ ?>
<div class="alert alert-danger" role="alert" onclick="javascript:$(this).hide();"><strong><?php echo $this->session->flashdata('error_message'); ?></strong><br/><span style="font-size:12px;">Klik box untuk menutup pesan!</span></div>
<?php } ?>

<h2 class="sub-header"><?php echo $video_title; ?></h2>
<form action="<?php echo base_url() ?>nimda/share/doEdit" role="form" method="post">
	<div class="form-group">
		<label>Video</label>&nbsp;&nbsp;&nbsp;&nbsp;
		<input class="form-control" name="video" type="text" placeholder="http://www.youtube.com/embed/XGSy3_Czz8k" value="<?php echo $content_video['video']; ?>" >
	</div>
	<div class="form-group"><button class="btn btn-success" type="submit">Edit</button></div>
</form>

<div class="add_button" style="float:right">
	<a href="<?php echo base_url(); ?>nimda/share/add" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</a>
</div>
<h2 class="sub-header"><?php echo $table_name; ?></h2>
<div class="table-responsive">
<!--Define data here using datatables-->
	<table id="listData" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Icon</th>
				<th>Title</th>
				<th>URL</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($content as $data){?>
			<tr>
				<td><img src="<?php echo base_url()."files".$data['icon_image']; ?>" width="100px" height="70px"></td>
				<td><?php echo $data["title"]; ?></td>
				<td><?php echo $data["url"]; ?></td>
				<td><?php if($data['aktif_status'] == 1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
				<td><a class="btn btn-success" href="<?php echo base_url(); ?>nimda/share/edit/<?php echo $data['socmed_id']; ?>">Edit</a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
