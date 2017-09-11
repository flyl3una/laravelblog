@extends("admin.index")

@section("content")

    <div class="container">
        {{--<div class="row">--}}
        <h5>系统信息</h5>
        {{--</div>--}}
        <div class="row"></div>
        <div class="row">
            <div class="col m4 s4">系统</div>
            <div class="col m8 s8">windows</div>
        </div>
        <div class="row">
            <div class="col m4 s4">内存</div>
            <div class="col m8 s8">4G/16G</div>
        </div>
        <div class="row">
            <div class="col m4 s4">磁盘</div>
            <div class="col m8 s8">1000G/2000G</div>
        </div>
        <div class="row">
            <div class="col m6 s12">
                <div id="chart-panel" style="width: 800px; height: 600px">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    @parent

    <script>

        var myChart = echarts.init(document.getElementById('chart-panel'));

        option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                feature: {
                    restore: {},
                    saveAsImage: {}
                }
            },
            series: [
                {
                    name: '业务指标',
                    type: 'gauge',
                    detail: {formatter: '50%'},
                    data: [{value: 50, name: '完成率'}]
                }
            ]
        };

        setInterval(function () {
            option.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
            myChart.setOption(option, true);
        }, 2000);

    </script>

@endsection