$(function() {
"use strict";

    // Top Countries 
    $('.chart').sparkline('html', {
        type: 'bar',
        height: '30px',
        barSpacing: 5,
        barWidth: 2,
        barColor: '#77797c',        
    });

    var chart = c3.generate({
        bindto: '#chart-Events-Interest', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 70],
                ['data2', 25],
                ['data3', 5],
            ],
            type: 'pie', // default type of chart
            colors: {
                'data1': '#e96a8d',
                'data2': '#f3aca2',
                'data3': '#f9cdac',
            },
            names: {
                // name of each serie
                'data1': 'Designing',
                'data2': 'Development',
                'data3': 'QA',
            }
        },
        axis: {
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

$(function () {
    if( $('#world-map-markers').length > 0 ){

        $('#world-map-markers').vectorMap(
        {
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            borderColor: '#fff',
            borderOpacity: 0.25,
            borderWidth: 0,
            color: '#e6e6e6',
            regionStyle : {
                initial : {
                fill : '#6c757d'
                }
            },
            markerStyle: {
                initial: {
                    r: 5,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 1,
                    'stroke-opacity': 0.4
                },
            },
        
            markers : [{
                latLng : [21.00, 78.00],
                name : 'INDIA : 350'
            
            },
                {
                latLng : [-33.00, 151.00],
                name : 'Australia : 250'
                
            },
                {
                latLng : [36.77, -119.41],
                name : 'USA : 250'
                
            },
                {
                latLng : [55.37, -3.41],
                name : 'UK   : 250'
                
            },
                {
                latLng : [25.20, 55.27],
                name : 'UAE : 250'
            
            },
                {
                latLng : [35.65, 139.83],
                name : 'JP : 37'
            
            },
                {
                latLng : [-23.53, -46.62],
                name : 'BR : 162'
            
            },
                {
                latLng : [50.43, 30.51],
                name : 'UA : 129'
            
            }],

            series: {
                regions: [{
                    values: {
                        "US": '#ffec94',
                        "SA": '#ffaeae',
                        "AU": '#64e2d4',
                        "IN": '#b0e57c',
                        "GB": '#b4d8e7',
                        "JP": '#56baec',
                        "BR": '#fe8282',
                        "UA": '#e2ffcf',
                    },
                    attribute: 'fill'
                }]
            },

            hoverOpacity: null,
            normalizeFunction: 'linear',
            zoomOnScroll: false,
            scaleColors: ['#000000', '#000000'],
            selectedColor: '#000000',
            selectedRegions: [],
            enableZoom: false,
            hoverColor: '#fff',
        });
    }
});
