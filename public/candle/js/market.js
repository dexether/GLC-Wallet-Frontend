function generate() {

        var now = new moment();
        var endTime = now.format("HH:mm:ss a");
        var direction;

        $('.time').text(endTime);


        // trying to extract json.


        $.getJSON( "api/index.php", function( data ) {

            var detail = data.AUD;
            var exchanges = detail.exchanges;
            var bidarray = [exchanges.btcbid, exchanges.idrbid, exchanges.cspbid, exchanges.ctrbid, exchanges.cjrbid, exchanges.babbid, exchanges.btrbid, exchanges.brpbid, exchanges.clfbid, exchanges.hblbid, exchanges.acxbid];
            var askarray = [exchanges.btcask, exchanges.idrask, exchanges.cspask, exchanges.ctrask, exchanges.cjrask, exchanges.babask, exchanges.btrask, exchanges.brpask, exchanges.clfask, exchanges.hblask, exchanges.acxask];
            var lastbidarray = [exchanges.btclastbid, exchanges.idrlastbid, exchanges.csplastbid, exchanges.ctrlastbid, exchanges.cjrlastbid, exchanges.bablastbid, exchanges.btrlastbid, exchanges.brplastbid, exchanges.hbllastbid, exchanges.acxlastbid];
            var lastaskarray = [exchanges.btclastask, exchanges.idrlastask, exchanges.csplastask, exchanges.ctrlastask, exchanges.cjrlastask, exchanges.bablastask, exchanges.btrlastask, exchanges.brplastask,exchanges.clflastask, exchanges.hbllastask, exchanges.acxlastask];
            var lastlastarray = [exchanges.btclastlast, exchanges.idrlastlast, exchanges.csplastlast, "0.00", "0.00", "0.00", "0.00", exchanges.brplastlast, "0.00", "0.00", exchanges.acxlastlast];
            var dayhigharray = [exchanges.btcdayhigh, exchanges.idrdayhigh, exchanges.cspdayhigh, exchanges.ctrdayhigh, exchanges.cjrdayhigh, exchanges.babdayhigh, exchanges.btrdayhigh, exchanges.brpdayhigh, exchanges.clfdayhigh, exchanges.hbldayhigh, exchanges.acxdayhigh];
            var daylowarray =  [exchanges.btcdaylow, exchanges.idrdaylow, exchanges.cspdaylow, exchanges.ctrdaylow, exchanges.cjrdaylow, exchanges.babdaylow, exchanges.btrdaylow, exchanges.brpdaylow, exchanges.clfdaylow, exchanges.hbldaylow, exchanges.acxdaylow];
            var exchangeNames = ["BTCMarkets", "IndependentReserve", "Coinspot", "Cointree", "Coinjar", "BuyaBitcoin", "BitTrade", "BrightonPeak", "CoinLoft", "Hardblock", "ACX.IO"];
            //console.log(exchanges.acxlast);
            // convert arrays to numbers
            // parseFloat(bids[index][1]).toFixed(2)
            var askarrayNumbers = askarray.map(parseFloat);
            var bidarrayNumbers = bidarray.map(parseFloat);
            var dayhigharrayNumbers = dayhigharray.map(parseFloat);
            var daylowarrayNumbers = daylowarray.map(parseFloat);

            var highestBidPrice = bidarrayNumbers.reduce(function(x,y){
                return (x > y) ? x : y;
            });

            var lowestAskPrice = askarrayNumbers.reduce(function(x,y){
                return (x < y) ? x : y;
            });

            var twentyfourHigh = dayhigharrayNumbers.reduce(function(x,y){
                return (x > y) ? x : y;
            });

            var twentyfourLow = daylowarrayNumbers.reduce(function(x,y){
                return (x < y) ? x : y;
            });

            //Find out which exchange is highest and lowest

            var highIndex = bidarrayNumbers.indexOf(highestBidPrice);
            var highestExchangeName = exchangeNames[highIndex];
            var lowIndex = askarrayNumbers.indexOf(lowestAskPrice);
            var lowestExchangeName = exchangeNames[lowIndex];

            var dayHighIndex = dayhigharrayNumbers.indexOf(twentyfourHigh);
            var dayHighExchangeName = exchangeNames[dayHighIndex];
            var dayLowIndex = daylowarrayNumbers.indexOf(twentyfourLow);
            var dayLowExchangeName = exchangeNames[dayLowIndex];

            //change colour if value is different

            function compareprice (value, lastvalue, variable) {

                if (value == lastvalue) {
                    $(variable).removeClass('c-accent');
                }
                if (value > lastvalue) {
                    $(variable).addClass('c-accent');
                }
                if (value < lastvalue) {
                    $(variable).addClass('c-accent');
                }

            }

            compareprice (exchanges.btcbid,exchanges.btclastbid,'.btcBid');
            compareprice (exchanges.btcask,exchanges.btclastask,'.btcAsk');
            compareprice (exchanges.btclast,exchanges.btclastlast,'.btcLast');



            document.title = 'BTX $AU' + lowestAskPrice + ' Blockcoin';

            $('.highestBid').text('$' + highestBidPrice);
            $('.highestExchange').text(highestExchangeName);
            $('.lowestAsk').text('$' + lowestAskPrice);
            $('.lowestExchange').text(lowestExchangeName);
            $('.highestDay').text('$' + twentyfourHigh);
            $('.dayHighExchange').text(dayHighExchangeName);
            $('.lowestDay').text('$' + twentyfourLow);
            $('.dayLowExchange').text(dayLowExchangeName);

            $('.btcBid').text('$' + exchanges.btcbid);
            $('.btcAsk').text('$' + exchanges.btcask);
            $('.btcLast').text('$' + exchanges.btclast);
            $('.btcHigh').text('$' + exchanges.btcdayhigh);
            $('.btcLow').text('$' + exchanges.btcdaylow);





            // $.getJSON( "api/newchart.php", function( chartdata ) {

            //     var index;
            //     var chartdata1 = [];
            //     var timedata = -24;
            //     for (index = 0; index < chartdata.length; ++index) {

            //         chartdata1.push([timedata, parseFloat(chartdata[index])]);

            //         timedata = timedata + 0.5;
            //     }

            //     var highestValue = chartdata.reduce(function(x,y){
            //         return (parseFloat(x) > parseFloat(y)) ? x : y;
            //     });

            //     var lowestValue = chartdata.reduce(function(x,y){
            //         return (parseFloat(x) < parseFloat(y)) ? x : y;
            //     });

            //     var chartUsersOptions = {
            //         lines: {
            //             show: true,
            //             fill: 0.1,
            //             lineWidth: 2,
            //         },
            //         yaxis: {
            //             min: parseFloat(lowestValue)-5, max: parseFloat(highestValue)+5, tickSize: 10
            //         },
            //         xaxis: {
            //             tickSize: 2
            //         },


            //         grid: {
            //             borderWidth: 0,
            //             hoverable: true

            //         }
            //     };

            //     $.plot($("#twentyfour"), [chartdata1], chartUsersOptions);

            //     // add formatting for chart hover action
            //     $("<div id='tooltip'></div>").css({
            //         position: "absolute",
            //         display: "none",
            //         border: "1px solid #fdd",
            //         padding: "2px",
            //         "background-color": "#fee",
            //         opacity: 0.80
            //     }).appendTo("body");



            //     // chart hover action, display price point
            //     // $("#twentyfour").bind("plothover", function (event, pos, item) {

            //     //     if (item) {
            //     //         var x = item.datapoint[0].toFixed(2),
            //     //             y = item.datapoint[1].toFixed(2);
            //     //         $("#tooltip").html( "$" + y)
            //     //             .css({top: item.pageY+5, left: item.pageX+5})
            //     //             .fadeIn(200);

            //     //     } else {
            //     //         $("#tooltip").hide();
            //     //     }
            //     // });


            // })







        })
    };

    logsInterval = setInterval(generate, 5000);