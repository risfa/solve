<h1 class="page-header">Setup Admin & Stocks</h1>
<style type="text/css">
    #add-field,#add-stock{
        margin-bottom: 10px;
    }
</style>
<form method="post" id="form-field">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Setup Event Admin & Stocks</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">Event that will be held</div>
                        <div class="col-sm-6 col-md-8">
                            <select class="form-control" name="event_id" id="event-id">
                                <?php
                                foreach ($events as $e){
                                    echo '<option value="'.$e->event_id.'">'.$e->event_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">Event Information </div>
                        <div class="col-sm-12 col-md-8">
                            <br/>
                            <table class="table table-striped table-bordered dataTable no-footer" id="table-info">
                                <tr>
                                    <td width="40%">Start Date</td>
                                    <td width="60%" id="start-date"></td>
                                </tr>
                                <tr>
                                    <td width="40%">End Date</td>
                                    <td width="60%" id="end-date"></td>
                                </tr>
                                <tr>
                                    <td width="40%">Using Raffle</td>
                                    <td width="60%" id="raffle"></td>
                                </tr>
                                <tr>
                                    <td width="40%">Stock Type</td>
                                    <td width="60%" id="stock"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        Note : stock will work if event uses raffle. probability = (prize stock/total prizes)*100%
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">Who Will Manage Event ?</div>
                        <div class="col-sm-6 col-md-8">
                            <select class="form-control" name="admin_id" id="admin-id">
                                <?php
                                foreach ($admins as $a){
                                    echo '<option value="'.$a->user_id.'">'.$a->fullname.' - '.$a->username.'</option>';
                                }
                                ?>
                            </select>
                            <br/>
                            <button type="button" class="btn btn-primary btn-block" id="set-admin">set admin</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">Stock for Prizes</div>
                        <div class="col-sm-12 col-md-8">
                            <div  id="stock-list">
                                <br/>
                                <button type="button" class="btn btn-success" id="add-stock">add stock</button>
                                <br/>
                                <table class="table table-striped table-bordered dataTable no-footer" id="table-stocks">
                                </table>
                                <br/>
                                <button type="button" class="btn btn-primary btn-block" id="generate-stock">Generate Stock For Event</button>
                            </div>
                            <div  id="stock-message" class="hidden">
                                <b>Can not generate event's stocks. it's already generated. </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var stock_id=0;
    $(document).ready(function () {
        $('#event-id').on('change',function () {
            getEventInfo($(this).val());
        });
        $("#set-admin").click(function () {
            setAdmin();
        });
        $("#generate-stock").click(function () {
            generateStocks();
        });
        $("#add-stock").click(function () {
            var html="<tr id='row-"+stock_id+"'>" +
                "<td>" +
                "<input class='form-control' placeholder='prize name' name='prize[]' id='prize-"+stock_id+"'/>" +
                "</td>" +
                "<td>" +
                "<input class='form-control' type='number' placeholder='total' name='total[]' id='total-"+stock_id+"'/>" +
                "</td>" +
                "<td>" +
                "<button class='btn btn-danger delete' data-row='"+stock_id+"'><span class='glyphicon glyphicon-minus-sign'></span></button>" +
                "</td>" +
                "</tr>";
            $('#table-stocks').append(html);
            stock_id++;
        });
        $("#table-stocks").on('click','.delete',function () {
            var row=$(this).data('row');
            $('#row-'+row).remove();
        });
        getEventInfo($('#event-id').val());
    });
    function getEventInfo(event_id) {
        $.ajax({
            url: '<?=site_url("/manage_admin/getInfoEvent")?>/'+event_id,
            type: 'get',
            success: function (resp) {
                var json=JSON.parse(resp);
                if(json.status){
                    var data=json.data;
                    $('#start-date').html(data.event_start);
                    $('#end-date').html(data.event_end);
                    $('#stock').html(data.stock_type);
                    $('#raffle').html(data.raffle);
                    getAddtionalInfo(event_id)
                }
            }
        });
    }
    function getAddtionalInfo(event_id) {
        $.ajax({
            url: '<?=site_url("/manage_admin/getAddtionalInfo")?>/'+event_id,
            type: 'get',
            success: function (resp) {
                var json=JSON.parse(resp);
                if(json.status){
                    var admin=json.data.admin_id;
                    if(admin!==false){
                        $('#admin-id').val(json.data.admin_id);
                    }else {

                    }
                    if(json.data.prize){
                        $('#stock-list').addClass('hidden');
                        $('#stock-message').removeClass('hidden');
                    }else{
                        $('#stock-list').removeClass('hidden');
                        $('#stock-message').addClass('hidden');
                    }
                }
            }
        });
    }
    function setAdmin() {
        $.ajax({
            url: '<?=site_url("/manage_admin/setAdmin")?>/'+$('#event-id').val()+'/'+$('#admin-id').val(),
            type: 'post',
            success: function (resp) {
                var json=JSON.parse(resp);
                if(json.status){
                    getEventInfo($('#event-id').val());
                    alert(json.message);
                }else{
                    alert(json.message);
                }
            }
        });
    }
    function generateStocks() {
        $.ajax({
            url: '<?=site_url("/manage_admin/generateStock")?>',
            type: 'post',
            data : $('#form-field').serialize(),
            success: function (resp) {
                var json=JSON.parse(resp);
                if(json.status){
                    alert(json.message);
                    getEventInfo($('#event-id').val());
                }else{
                   alert(json.message);
                }
            }
        });
    }
</script>