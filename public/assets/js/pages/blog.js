$(function() {
    "use strict";    
	initDonutChart();    
	
	var options;
	// Categories Statistics
    var dataMultiple = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [{
            name: 'series-WebDesign',
            data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
        }, {
            name: 'series-Lifestyle',
            data: [89, 350, 360, 380, 315, 425, 466, 502, 520, 629, 725, 402],            
        }, {
            name: 'series-Sports',
            data: [159, 235, 305, 380, 379, 477, 450, 280, 530, 680, 699, 902],            
        }, {
            name: 'series-News',
            data: [173, 523, 360, 159, 358, 416, 431, 520, 545, 249, 700, 945],            
        }]
    };
    options = {
        lineSmooth: false,
        height: "300px",
        low: 0,
        high: 'auto',
        series: {
            'series-WebDesign': {
                showPoint: true,                
            },
        },
        
        options: {
            responsive: true,
            legend: false
        },

        plugins: [
            Chartist.plugins.legend({
                legendNames: ['WebDesign', 'Lifestyle', 'Sports', 'News']
            })
        ]
    };
	new Chartist.Line('#Categories_Statistics', dataMultiple, options);
	
});


function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
                label: 'Tablet',
                value: 15
            }, {
                label: 'Desktops',
                value: 45
            }, {
                label: 'Mobile',
                value: 40
            }
        ],
        colors: ['#f15a24', '#f7931e', '#ffb83b'],
        formatter: function(y) {
            return y + '%'
        }
    });
}



/*VectorMap Init*/
$(function() {
	"use strict";
	var mapData = {
			"US": 298,
			"SA": 200,
			"AU": 760,
			"IN": 2000000,
			"GB": 120,
		};
	
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
				  fill : '#eaeaea'
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
			  
			  }],

			series: {
				regions: [{
					values: {
						"US": '#49c5b6',
						"SA": '#667add',
						"AU": '#50d38a',
						"IN": '#60bafd',
						"GB": '#ff758e',
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

	if( $('#india').length > 0 ){
	$('#india').vectorMap({
			map : 'in_mill',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#f4f4f4'
				}
			}
		});
	}	

	if( $('#usa').length > 0 ){
		$('#usa').vectorMap({
			map : 'us_aea_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#f4f4f4'
				}
			}
		});
	}        
		   
	if( $('#australia').length > 0 ){
		$('#australia').vectorMap({
			map : 'au_mill',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#f4f4f4'
				}
			}
		});
	}	
	 
	if( $('#uk').length > 0 ){ 
		$('#uk').vectorMap({
			map : 'uk_mill_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#f4f4f4'
				}
			}
		});
	}	
});