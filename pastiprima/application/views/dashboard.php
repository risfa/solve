<link rel="stylesheet" href="<?=base_url('assets/theme/css/dataTables.bootstrap.min.css')?>"/>
<h1 class="page-header">Dashboard
    <spa class="pull-right" style="font-size: 12px">
        <a class="btn btn-success" href="<?=site_url("export")?>" id="export">Export Data</a>
    </spa>
</h1>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Customer</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div style="width: 100%;height: 400px" id="customer-perday"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div style="width: 100%;height: 400px" id="customer-perday-money"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div style="width: 100%;height: 400px" id="customer-fuel"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div style="width: 100%;height: 400px" id="customer-perday-single"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Ruffle Summary</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div style="width: 100%;height: 400px" id="ruffle-summary"></div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <table class="table table-striped table-bordered dataTable no-footer" id="table-customer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Hadiah</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/theme/js/echarts.min.js')?>"></script>
<script src="<?=base_url('assets/theme/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/theme/js/dataTables.bootstrap.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        chartCustomerPerDay();
        chartCustomerPerDaySingle();
        chartCustomerPerDayMoney();
        chartCustomerFuel();
        ruffleSummary();
        initTable();
        $('#export').click(function () {

        });
    });
    function chartCustomerPerDay() {
        var myChart = echarts.init(document.getElementById('customer-perday'));

        // specify chart configuration item and data
        var option = {
            title : {
                text: 'Customer per Day',
                subtext: 'how many customer join event per day'
            },
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
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
                    data : <?=json_encode($spg_sum_date)?>,
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
                    name:'Jumlah Customer Ruffle',
                    type:'bar',
                    barWidth: '60%',
                    data:<?=json_encode($spg_sum_jml)?>
                }
            ]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    }
    function chartCustomerPerDaySingle() {
        var myChart = echarts.init(document.getElementById('customer-perday-single'));

        // specify chart configuration item and data
        var option = {
            title : {
                text: 'Customer <?=($status=="tl")? "SPG" : "TL"?> per Day',
                subtext: 'how many customer join event per day per <?=($status=="tl")? "spg" : "tl"?>'
            },
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
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
                    data : <?=json_encode($spg_sum_date)?>,
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
            series : <?=json_encode($spg_sum_jml_single)?>
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    }
    function chartCustomerPerDayMoney() {
        var myChart = echarts.init(document.getElementById('customer-perday-money'));

        // specify chart configuration item and data
        var option = {
            title : {
                text: 'Customer per Day',
                subtext: 'how much nominal per day'
            },
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
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
                    data : <?=json_encode($spg_sum_date)?>,
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
                    data:<?=json_encode($spg_sum_money)?>
                }
            ]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    }
    function chartCustomerFuel() {
        var myChart = echarts.init(document.getElementById('customer-fuel'));

        // specify chart configuration item and data
        var option = {
            title : {
                text: 'Sold Product',
                subtext: 'min. 200.000 IDR per ruffle in SPBU',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: <?=json_encode($spg_produk_legend)?>
            },
            series : [
                {
                    name: 'Sold Product',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:<?=json_encode($spg_produk)?>,
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
    }
    function  ruffleSummary() {
        var myChart = echarts.init(document.getElementById('ruffle-summary'));

        // specify chart configuration item and data
        var option = {
            title : {
                text: 'Gift Prize',
                subtext: 'total prize gift to customer',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: <?=json_encode($spg_hadiah_legend)?>
            },
            series : [
                {
                    name: 'Gift Prize',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:<?=json_encode($spg_hadiah)?>,
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
    }
    function initTable() {
        $("#table-customer").DataTable({
            "ajax" : '<?=($status=="tl")? site_url('admin/getRuffleTable') : site_url('admin/getRuffleTableAll')?>'
        });
    }
</script>