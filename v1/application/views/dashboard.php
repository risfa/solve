<link rel="stylesheet" href="<?=base_url('assets/theme/css/dataTables.bootstrap.min.css')?>"/>
<script src="<?=base_url('assets/theme/js/echarts.min.js')?>"></script>
<script src="<?=base_url('assets/theme/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/theme/js/dataTables.bootstrap.min.js')?>"></script>
<h1 class="page-header">Dashboard
    <spa class="pull-right" style="font-size: 12px">
        <a class="btn btn-success" href="<?=site_url("export")?>" id="export">Export Data</a>
    </spa>
</h1>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Summary</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <table class="table table-striped table-bordered dataTable no-footer" id="table-customer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Hadiah</th>									
									<!--<th>Nama SPG</th>-->									
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div id="data-hadiah" style="width: 100%;height: 300px"></div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div id="data-cglobal" style="width: 100%;height: 300px"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="data-c" style="width: 100%;height: 350px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dataCustomer=null;
    var status='<?=$status?>';
    var main_function='<?=$main_function?>';
    var dataHadiah={};
    var dataPesertaGlobal={};
    var dataPeserta={};
    var dataTemp=[];
    $(document).ready(function () {
        initTable();
        loadChart();
    });
    function initTable() {
        $("#table-customer").DataTable({
            "ajax" : '<?=($status=="tl")? site_url('admin/getCustomerTable') : site_url('admin/getCustomerTableAll')?>'
        });
    }
    function loadChart() {
        $.ajax({
            url : '<?=($status=="tl")? site_url('admin/getCustomerChart') : site_url('admin/getCustomerChartAll')?>',
            method : 'get',
            success : function (resp) {
                dataCustomer=JSON.parse(resp);
                if(main_function!==""){
                    var fn = window[main_function];
                    if (typeof fn === "function") fn();
                }
                /*
                chart grafik penjualan per hari
                 */
                dataHadiah={};
                dataPesertaGlobal={};
                dataPeserta={};
                $.each(dataCustomer.data,function (k,v) {
                   /*
                   add hadiah
                    */
                   if(typeof dataHadiah[v.hadiah]!=="undefined"){
                       dataHadiah[v.hadiah]++;
                   }else{
                       dataHadiah[v.hadiah]=1;
                   }
                    if(typeof dataPesertaGlobal[v.date_event]!=="undefined"){
                        dataPesertaGlobal[v.date_event]++;
                    }else{
                        dataPesertaGlobal[v.date_event]=1;
                        dataPeserta[v.date_event]={};
                    }
                    if(typeof dataPeserta[v.date_event]!=="undefined"){
                        var keyDP=(status==="tl")? v.spg_name : v.tl_name;
                        if(typeof dataPeserta[v.date_event][keyDP]!=="undefined"){
                            dataPeserta[v.date_event][keyDP]++;
                        }else{
                            dataPeserta[v.date_event][keyDP]=1;
                        }
                    }
                });
                $.each(dataCustomer.legend,function (k,v) {
                	var indexTemp=v.field;
                	dataTemp.push(indexTemp);
                });
                console.log(dataTemp);
                createPie('data-hadiah',dataHadiah);
                createColumn('data-cglobal',dataPesertaGlobal);
                createMultiColumn('data-c',dataPeserta);
            },
            failure : function (error) {
                setTimeout(loadChart,1000);
            }
        });
    }
    function createPie(id,data) {
        var legend=[];
        var chartdata=[];
        $.each(data,function (k,v) {
           legend.push(k);
           var chartPart={};
           chartPart.name=k;
           chartPart.value=v;
           chartdata.push(chartPart);
        });
        var myChart = echarts.init(document.getElementById(id));

        // specify chart configuration item and data
        var option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series : [
                {
                    name: 'Sold Product',
                    type: 'pie',
                    radius : '70%',
                    center: ['50%', '60%'],
                    data: chartdata,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };


        // use configuration item and data specified to show chart
        myChart.setOption(option);
        console.log(data);
    }
    function createColumn(id,data) {
        var legend=[];
        var chartdata=[];
        $.each(data,function (k,v) {
            legend.push(k);
            chartdata.push(v);
        });
        var myChart = echarts.init(document.getElementById(id));

        // specify chart configuration item and data
        var option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {
                    type : 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : legend,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'Total',
                    type:'line',
                    data: chartdata
                }
            ]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    }
    function createMultiColumn(id,data) {
        var legend=[];
        var chartTmp={};
        var chartdata=[];
        console.log(data);
        $.each(data,function (k,v) {
            legend.push(k);
            for(var i=0;i<dataTemp.length;i++){
                var indexTemp=dataTemp[i];
                if (typeof v[indexTemp] === "undefined") {
                    if (typeof chartTmp[indexTemp] === "undefined") {
                        chartTmp[indexTemp] = [];
                    }
                    chartTmp[indexTemp].push(0);
                }
            }
            $.each(v,function (x,y) {
                if (typeof chartTmp[x] === "undefined") {
                    chartTmp[x] = [];
                }
                chartTmp[x].push(y);
            });
        });
        console.log(chartdata);
        $.each(chartTmp,function (k,v) {
            chartdata.push({name:k,type:'bar',data: v});
        });
        var myChart = echarts.init(document.getElementById(id));
        // specify chart configuration item and data
        var option = {
            tooltip : {
                trigger: 'axis',
                axisPointer : {
                    type : 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : legend,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : chartdata
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    }
</script>
<?php
if($custom_dashboard){
    include $view_file.'.php';
}
?>