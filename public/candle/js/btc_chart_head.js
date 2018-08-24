function loadchart(coin, cur) { 
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function(data) {
    //$.getJSON('http://www.cryptocoins.co.za/chartdata/jsonp.php?filename=btc_twenty_four_hour.json&callback=?', function(data) {
        //$.getJSON('http://www.cryptocoins.co.za/chartdata/jsonp.php?callback=?', function(data) {
    $.getJSON("chart/"+coin+'/'+cur, function(data) {
        console.log(data);
        alert(data);
        Highcharts.setOptions({
        global: {
            timezoneOffset: -2 * 60
        }
        });
        // split the data set into ohlc and volume
        var ohlc = [],
            volume = [],
            dataLength = data.length;

        // set the allowed units for data grouping
        var groupingUnits = [[
            'week',                         // unit name
            [1]                             // allowed multiples
        ], [
            'month',
            [1, 2, 3, 4, 6]
        ]];
            
        for (i = 0; i < dataLength; i++) {
            ohlc.push([
                data[i]['time']*1000, // the date
                data[i]['open'], // open
                data[i]['high'], // high
                data[i]['low'], // low
                data[i]['close'] // close
            ]);
            
            volume.push([
                data[i]['time']*1000, // the date
                data[i]['volumefrom'] // the volume
            ])
        }


        // create the chart
        $('#chartcontainer').highcharts('StockChart', {
            
            rangeSelector: {
                inputEnabled: $('#chartcontainer').width() > 480,
                selected: 0,
                enabled: false
                
            },
            
            //Rads added START

            navigator: { //Rads says not sure why this one is purple!
                enabled: false
            },
            chart: {
             marginBottom: 3,
             height: 400
            },
            
            scrollbar: {
                enabled: false
            },

            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },

            //Rads added END

           /* title: {
                text: 'AAPL Historical'
            },*/
/*          yAxis: {
            reversed: true,
            showFirstLabel: false,
            showLastLabel: true
        },*/
            yAxis: [{
                
                labels: {
                    enabled: true,
                    align: 'left',
                    //x: -1,
                },
                
                title: {
                    text: 'OHLC',
                    x: 11
                },
                height: '60%',
                height: '100%', 
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3,
                    style: { "color": "#FF9900", "fontWeight": "none" }
                },
                title: {
                    text: 'Volume',
                    y: 70,
                    style: { "color": "#FF9900", "fontWeight": "bold" }
                },
                //top: '65%',
                //height: '100%',
                height: '100%',
                offset: 0,
                lineWidth: 2,
                opposite: false
                
            }],
            
            series: [{
                type: 'column',
                //color: '#FF9900',//This changes the bar chart to orange Also changes the little dot...
                color: '#4ebc91',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }, 
                {
                type: 'candlestick',
                name: 'BTC',
                data: ohlc,
                color: 'red',
                upColor: 'white',
                lineColor: 'red',               
                upLineColor: 'green', // docs
                dataGrouping: {
                    units: groupingUnits
                }
               
            }]
        });
    });
}