<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
 <div id="ph" style="min-width: 210px; max-width: 300; height: 200px; margin: 0 auto" >bla</div>
        <div class="span-6 img-rounded" style="border: 1px solid #888888;  padding: 20px 20px 20px 20px;" >
            <div><div><span style=" background-color: #55BF3B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Ácido </div></div>
            <div><div><span style=" background-color: #DDDF0D">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Neutro</div></div>
            <div><div><span style=" background-color: #DF5353">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Alcalino</div></div>        
        </div>

<script>
$(function () {

   $('#ph').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: null
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 14,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'PH'
            },
            plotBands: [{
                from: 0,
                to: 7,
                color: '#55BF3B' // green
            }, {
                from: 7,
                to: 8,
                color: '#DDDF0D' // yellow
            }, {
                from: 8,
                to: 14,
                color: '#DF5353' // red
            }]
        },

        series: [{
            name: 'Speed',
            data: [7.5],
            tooltip: {
                valueSuffix: ' km/h'
            }
        }]

    },function (chart) {
        if (!chart.renderer.forExport) {
            setInterval(function () {
                var point = chart.series[0].points[0],
                    newVal,
                    inc = Math.round((Math.random() - 0.5) * 5);

                newVal = point.y + inc;
                if (newVal < 0 || newVal > 200) {
                    newVal = point.y - inc;
                }

                point.update(newVal);

            }, 3000);
        }
    });
});</script>