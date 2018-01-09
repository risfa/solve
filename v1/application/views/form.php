<link href="<?=base_url("assets/theme/css/bootstrap-tagsinput.css")?>" rel="stylesheet"/>
<style type="text/css">
    .bootstrap-tagsinput{
        width: 100% !important;
    }
</style>
<form method="post" id="form-field">
    <h1 class="page-header">Form
        <span class="pull-right">
            <select class="form-control" name="event_id" id="event-id">
                <?php
                foreach ($events as $e){
                  echo '<option value="'.$e->event_id.'">'.$e->event_name.'</option>';
                }
                ?>
            </select>
        </span>
    </h1>
    <style type="text/css">
        #add-field{
            margin-bottom: 10px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Form for Field Officer</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-success" id="add-field">Add field</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class='text-error' id="message"></div>
                            <table class="table table-striped table-bordered dataTable no-footer" id="table-form">
                                <thead>
                                <tr>
                                    <th width="25%">Name</th>
                                    <th width="20%">PlaceHolder</th>
                                    <th width="10%">Type</th>
                                    <th width="20%">Values</th>
                                    <th width="15%">Order</th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="form-fo"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-block" id="save-field">Save All Fields</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?=base_url("assets/theme/js/bootstrap-tagsinput.js")?>"></script>
<script type="text/javascript">
    var id=0;
    var urutan=1;
    $(document).ready(function () {
        $("#save-field").click(function () {
            saveField();
        });
        $("#add-field").click(function () {
            var html="<tr id='row-"+id+"'>" +
                "<td>" +
                "<input class='form-control' placeholder='name/label' name='name[]' id='name-"+id+"'/>" +
                "</td>" +
                "<td>" +
                "<input class='form-control' placeholder='placeholder' name='placeholder[]' id='placeholder-"+id+"'/>" +
                "</td>" +
                "<td>" +
                "<select class='form-control'  name='type[]' id='type-"+id+"'>" +
                "<option value='text'>text</option>" +
                "<option value='email'>email</option>" +
                "<option value='phone'>phone</option>" +
                "<option value='number'>number</option>" +
                "<option value='select'>select</option>" +
                "</select>" +
                "</td>" +
                "<td>" +
                "<input class='form-control' data-role='tagsinput' placeholder='fill for select input' name='values[]' id='values-"+id+"'/>" +
                "</td>" +
                "<td>" +
                "<input class='form-control' placeholder='order' name='order[]' id='order-"+id+"' value='"+urutan+"'/>" +
                "</td>" +
                "<td>" +
                "<button type='button' class='btn btn-danger delete' data-row='"+id+"' id='delete-"+id+"'><span class='glyphicon glyphicon-minus-sign'></span></button>" +
                "</td>" +
                "</tr>";
            $('#form-fo').append(html);
            $('#values-'+id).tagsinput({
                allowDuplicates: false
            });
            urutan++;
            id++;
        });
        $('#event-id').on('change',function () {
            getField($(this).val());
        });
        $("#form-fo").on('click','.delete',function () {
           var row=$(this).data('row');
            $('#values-'+row).tagsinput('destroy');
            $('#row-'+row).remove();
        });
        getField($('#event-id').val());
    });
    function getField(event_id) {
        $.ajax({
           url : '<?=site_url("/events/getField")?>/'+event_id,
           type : 'get',
           success : function (resp) {
               var json=JSON.parse(resp);
               if(json.status){
                   urutan=1;
                   $('#form-fo').html("");
                   $.each(json.data,function (key,val) {
                       
                       var html="<tr id='row-"+id+"'>" +
                           "<td>" +
                           "<input class='form-control' value='"+val.field_name+"' placeholder='name/label' name='name[]' id='name-"+id+"'/>" +
                           "</td>" +
                           "<td>" +
                           "<input class='form-control' value='"+val.field_placeholder+"' placeholder='placeholder' name='placeholder[]' id='placeholder-"+id+"'/>" +
                           "</td>" +
                           "<td>" +
                           "<select class='form-control'  name='type[]' id='type-"+id+"'>" +
                           "<option value='text'>text</option>" +
                           "<option value='email'>email</option>" +
                           "<option value='phone'>phone</option>" +
                           "<option value='number'>number</option>" +
                           "<option value='select'>select</option>" +
                           "</select>" +
                           "</td>" +
                           "<td>" +
                           "<input class='form-control' value='"+val.field_values+"' data-role='tagsinput' placeholder='fill for select input' name='values[]' id='values-"+id+"'/>" +
                           "</td>" +
                           "<td>" +
                           "<input class='form-control' value='"+urutan+"' placeholder='order' name='order[]' id='order-"+id+"'/>" +
                           "</td>" +
                           "<td>" +
                           "<button type='button' class='btn btn-danger delete' data-row='"+id+"' id='delete-"+id+"'><span class='glyphicon glyphicon-minus-sign'></span></button>" +
                           "</td>" +
                           "</tr>";
                       $('#form-fo').append(html);
                       $('#values-'+id).tagsinput({
                           allowDuplicates: false
                       });
                       $('#type-'+id).val(val.field_type);
                       id++;
                       urutan++;
                   });
               }
           }
        });
    }
    function saveField() {
        $.ajax({
            url: '<?=site_url("/events/savefield")?>/',
            type: 'post',
            data : $('#form-field').serialize(),
            success: function (resp) {
                var json=JSON.parse(resp);
                if(json.status){
                    $('#form-fo').html("");
                    $("#message").hide();
                    alert(json.message);
                    getField($('#event-id').val());
                }else{
                    $("#message").show();
                    $("#message").html(json.message);
                }
            }
        });
    }
</script>