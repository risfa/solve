<?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<h1 class="page-header"><?=$title?></h1>
<div class="row">
    <div class="col-sm-12">
        <?php echo $output; ?>
    </div>
</div>

