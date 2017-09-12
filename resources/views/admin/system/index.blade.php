@extends("admin.index")

@section("content")

    <div class="container">
        {{--<div class="row">--}}
        <h5>系统信息</h5>
        {{--</div>--}}
        {{--<div class="row"></div>--}}
        {{--<div class="row">--}}
        {{--<div class="col m4 s4">系统</div>--}}
        {{--<div class="col m8 s8">windows</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="col m4 s4">内存</div>--}}
        {{--<div class="col m8 s8">4G/16G</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="col m4 s4">磁盘</div>--}}
        {{--<div class="col m8 s8">1000G/2000G</div>--}}
        {{--</div>--}}
        <div id="get_charts_url" hidden data-url="{{ route('admin.systeminfo') }}"></div>
        <div class="row">
            <div class="col m6 s12">
                <div hidden id="div_CPU_id" data-all="100" data-current="80"></div>
                <div id="CPU_chart_id" style="height: 400px; width: 550px;">
                </div>
            </div>
            <div class="col m6 s12">
                <div hidden id="div_RAM_id" data-all="100" data-current="80"></div>
                <div id="RAM_chart_id" style="height: 400px; width: 550px;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12">
                <div hidden id="div_disk_id" data-all="100" data-current="80"></div>
                <div id="disk_chart_id" style="height: 400px; width: 550px;">
                </div>
            </div>
            <div class="col m6 s12">
                <div hidden id="div_SWAP_id" data-all="100" data-current="80"></div>
                <div id="SWAP_chart_id" style="height: 400px; width: 550px;">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    @parent

    <script>

        var myRAMChart = echarts.init(document.getElementById('RAM_chart_id'));
        var myCPUChart = echarts.init(document.getElementById('CPU_chart_id'));
        var myDiskChart = echarts.init(document.getElementById('disk_chart_id'));
        var mySWAPChart = echarts.init(document.getElementById('SWAP_chart_id'));
        option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                feature: {
//                    restore: {},
//                    saveAsImage: {}
                }
            },
            series: [
                {
                    name: '业务指标',
                    type: 'gauge',
                    detail: {formatter: '50%'},
                    data: [{value: 50, name: '内存'}]
                }
            ]
        };

        updateCharts = function () {
            $.get($("#get_charts_url").data('url'), function (data, status) {
                console.log(data);
                console.log(status);
                if (status == 'success') {
                    var RAM = data.RAM;
                    var Disk = data.Disk;
                    var SWAP = data.SWAP;
                    var CPU = data.CPU;

                    if (CPU.state == 0) {
                        option.series[0].data[0].value = (CPU['current'] * 100 / CPU['all']).toFixed(2);
                        option.series[0].data[0].name = '内存使用';
                        option.series[0].detail.formatter = (CPU['current'] * 100 / CPU['all']).toFixed(2) + "%";
                        myCPUChart.setOption(option, true);
                    }
                    if (RAM.state == 0) {
                        option.series[0].data[0].value = (Disk['current'] * 100 / Disk['all']).toFixed(2);
                        option.series[0].data[0].name = '内存使用';
                        option.series[0].detail.formatter = (RAM['current'] * 100 / RAM['all']).toFixed(2) + "%";
                        myRAMChart.setOption(option, true);
                    }
                    if (Disk.state == 0) {
                        option.series[0].data[0].value = (Disk['current'] * 100 / Disk['all']).toFixed(2);
                        option.series[0].data[0].name = '磁盘空间';
                        option.series[0].detail.formatter = (Disk['current'] * 100 / Disk['all']).toFixed(2) + "%";
                        myDiskChart.setOption(option, true);
                    }
                    if (SWAP.state == 0) {
                        option.series[0].data[0].value = (SWAP['current'] * 100 / SWAP['all']).toFixed(2);
                        option.series[0].data[0].name = '交换空间';
                        option.series[0].detail.formatter = (SWAP['current'] * 100 / SWAP['all']).toFixed(2) + "%";
                        mySWAPChart.setOption(option, true);
                    }
                } else {
                    console.log(data);
                }
            }, 'json');
        };

        setInterval(updateCharts, 5000);

        $(document).ready(function() {
            updateCharts();
        });

    </script>

@endsection