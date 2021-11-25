$(function() {
"use strict";

    $('.knob').knob({ 
        'format' : function (value) { if (value > 0) { return value + '%'; } else { return value; } }
    });

    $(".rtl .knob").knob({
		draw: function () {
		   //style rtl
			this.i.css({
				'margin-right': '-' + ((this.w * 3 / 4 + 2) >> 0) + 'px',
				'margin-left': 'auto'
			});
		},
	});

    $('.chart_3').sparkline('html', {
        type: 'bar',
        height: '40px',
        barSpacing: 10,
        barWidth: 5,
        barColor: '#28a745',        
    });

    // Customized line chart
    $('#linecustom').sparkline('html', {
        height: '42px',
        width: '100%',
        lineColor: '#373a40',
        fillColor: '#2d3035',
        minSpotColor: true,
        maxSpotColor: true,
        spotColor: '#60bafd',
        spotRadius: 0
    });

    var chart = c3.generate({
        bindto: '#chart-bar', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 11, 8, 15, 18, -1, 17],
                ['data2', 22, -3, 25, 27, 17, 18],
                ['data3', 17, 18, 21, 28, 21, 27],
                ['data4', 11, 15, -4, 22, 12, 25],
            ],
            type: 'bar', // default type of chart
            colors: {
                'data1': '#93e3ff',
                'data2': '#69c1e0',
                'data3': '#41a7cb',
                'data4': '#2085a8',
            },
            names: {
                // name of each serie
                'data1': 'Doller',
                'data2': 'Euro',
                'data3': 'Pound',
                'data4': 'Rupee'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            y : {
                tick: {
                    format: d3.format("$,")
                }
            }
        },
        bar: {
            width: 15
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 20,
            top: 0
        },
    });

    var chart = c3.generate({
        bindto: '#chart-Short-Term-Assets', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 110, 80, 150, 180, 190, 170, 70, 140, 90, 210, 160, 130],
                ['data2', 70, 140, 90, 210, 160, 130, 180, 190, 170, 70, 140, 90],
                ['data3', 80, 110, 150, 170, 120, 180, 110, 80, 150, 180, 190, 170],
            ],
            type: 'bar', // default type of chart
            groups: [
                ['data1', 'data2', 'data3']
            ],
            colors: {
                'data1': '#3a3f46',
                'data2': '#4a5461',
                'data3': '#6a717a',
            },
            names: {
                // name of each serie
                'data1': 'Cash',
                'data2': 'Investments',
                'data3': 'A/R',
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
            },
        },
        bar: {
            width: 20
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 20,
            top: 0
        },
    });    
});