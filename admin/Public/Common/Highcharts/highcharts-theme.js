Highcharts.theme = {
    //折线的颜色   这里设置了九条折线的不同颜色
    //colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
    colors: ['#272727', '#5CA302', '#058DC7', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
    chart: {
        //整体背景色
        backgroundColor: {
            //渐变距离设置
            linearGradient: { x1: 0, y1: 0, x2: 4, y2: 4 },
            //两个渐变颜色
            stops: [ [0, 'rgb(255, 255, 255)'], [1, 'rgb(108,108,108)'] ]
        },
        borderColor: '#ccc',//外边框颜色
        borderWidth: 0,//外边框宽度
        borderRadius: 0,//边框四个角的角度
        //三个基础值
        plotBackgroundColor: 'rgba(255,255,255, .9)',
        plotShadow: false,
        plotBorderWidth: 1
    },
    //头部大标题
    title: {
        style: {
            color: '#000',
            font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    //头部小标题
    subtitle: {
        style: {
            color: '#666666',
            font: 'bold 20px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    //横坐标设置
    xAxis: {
        gridLineWidth: 1,//网格宽度
        lineColor: '#666',//颜色
        tickColor: '#666',//超出距离颜色
        //横坐标值设置
        labels: {
            style: {
                color: '#666',
                font: '11px Trebuchet MS, Verdana, sans-serif'
            }
        },
        //横坐标标题设置
        title: {
            style: {
                color: '#333',
                fontWeight: 'bold',
                fontSize: '12px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            }
        }
    },
    //纵坐标
    yAxis: {
        //填充网格 自由设置
        minorTickInterval: 'auto',
        lineColor: '#666',
        lineWidth: 1,
        tickWidth: 1,
        tickColor: '#666',
        labels: {
            style: {
                color: '#666',
                font: '11px Trebuchet MS, Verdana, sans-serif'
            }
        },
        title: {
            style: {
                color: '#000',
                fontWeight: 'normal',
                fontSize: '11px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            }
        }
    },
    //底部提示
    legend: {
        itemStyle: {
            font: '9pt Trebuchet MS, Verdana, sans-serif',
            color: '#666'
        },
        itemHoverStyle: { color: '#909090' },//鼠标覆盖后颜色
        itemHiddenStyle: { color: '#ccc' }//隐藏后颜色
    },
    labels: {
        style: { color: '#99b' }
    },
    //跟随鼠标的浮动框
    tooltip: {
        //背景渐变设置
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [ [0, 'rgba(255, 255, 255, .9)'], [1, 'rgba(196,196,196, .9)'] ]
        },
        borderWidth: 0,
        style: { color: '#666' }
    },
    navigation: {
        buttonOptions: {
            theme: { stroke: '#CCCCCC' }
        }
    }
};Highcharts.setOptions(Highcharts.theme);

//Highcharts.theme = { colors: ["#DDDF0D", "#7798BF", "#55BF3B", "#DF5353", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"], chart: { backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, 'rgb(96, 96, 96)'], [1, 'rgb(16, 16, 16)'] ] }, borderWidth: 0, borderRadius: 0, plotBackgroundColor: null, plotShadow: false, plotBorderWidth: 0 }, title: { style: { color: '#FFF', font: '16px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif' } }, subtitle: { style: { color: '#ccc', font: '17px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif' } }, xAxis: { gridLineWidth: 0, lineColor: '#999', tickColor: '#999', labels: { style: { color: '#999', fontWeight: 'bold' } }, title: { style: { color: '#AAA', font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif' } } }, yAxis: { alternateGridColor: null, minorTickInterval: null, gridLineColor: 'rgba(255, 255, 255, .1)', minorGridLineColor: 'rgba(255,255,255,0.07)', lineWidth: 0, tickWidth: 0, labels: { style: { color: '#999', fontWeight: 'bold' } }, title: { style: { color: '#AAA', font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif' } } }, legend: { itemStyle: { color: '#CCC' }, itemHoverStyle: { color: '#FFF' }, itemHiddenStyle: { color: '#333' } }, labels: { style: { color: '#CCC' } }, tooltip: { backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 10, y2: 1 }, stops: [ [0, 'rgba(96, 96, 96, .8)'], [1, 'rgba(16, 16, 16, .8)'] ] }, borderWidth: 0, style: { color: '#FFF' } }, plotOptions: { series: { nullColor: '#444444' }, line: { dataLabels: { color: '#CCC' }, marker: { lineColor: '#333' } }, spline: { marker: { lineColor: '#333' } }, scatter: { marker: { lineColor: '#333' } }, candlestick: { lineColor: 'white' } }, toolbar: { itemStyle: { color: '#CCC' } }, navigation: { buttonOptions: { symbolStroke: '#DDDDDD', hoverSymbolStroke: '#FFFFFF', theme: { fill: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.4, '#606060'], [0.6, '#333333'] ] }, stroke: '#000000' } } },rangeSelector: { buttonTheme: { fill: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.4, '#888'], [0.6, '#555'] ] }, stroke: '#000000', style: { color: '#CCC', fontWeight: 'bold' }, states: { hover: { fill: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.4, '#BBB'], [0.6, '#888'] ] }, stroke: '#000000', style: { color: 'white' } }, select: { fill: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.1, '#000'], [0.3, '#333'] ] }, stroke: '#000000', style: { color: 'yellow' } } } }, inputStyle: { backgroundColor: '#333', color: 'silver' }, labelStyle: { color: 'silver' } }, navigator: { handles: { backgroundColor: '#666', borderColor: '#AAA' }, outlineColor: '#CCC', maskFill: 'rgba(16, 16, 16, 0.5)', series: { color: '#7798BF', lineColor: '#A6C7ED' } }, scrollbar: { barBackgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.4, '#888'], [0.6, '#555'] ] }, barBorderColor: '#CCC', buttonArrowColor: '#CCC', buttonBackgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0.4, '#888'], [0.6, '#555'] ] }, buttonBorderColor: '#CCC', rifleColor: '#FFF', trackBackgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#000'], [1, '#333'] ] }, trackBorderColor: '#666' },legendBackgroundColor: 'rgba(48, 48, 48, 0.8)', background2: 'rgb(70, 70, 70)', dataLabelsColor: '#444', textColor: '#E0E0E0', maskColor: 'rgba(255,255,255,0.3)' };var highchartsOptions = Highcharts.setOptions(Highcharts.theme);