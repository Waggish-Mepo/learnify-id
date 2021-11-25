// C3 Chart js
$(function(){
    "use strict";

    var chart = c3.generate({
        bindto: '#chart-Facebook-1',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Engaged '
            },
            columns: [
                ['data1', 22, 14, 45, 28, 18, 27, 40]
            ],
            type: 'area'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#3b5998']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-Facebook-2',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Impressions'
            },
            columns: [
                ['data1', 42,63,22,74,21,33,39]
            ],
            type: 'area'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#3b5998']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-Facebook-3',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Likes'
            },
            columns: [
                ['data1', 22, 14, 45, 28, 18, 27, 40]
            ],
            type: 'area'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#3b5998']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-Facebook-4',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Likes'
            },
            columns: [
                ['data1', 42,63,22,74,21,33,39]
            ],
            type: 'area'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#3b5998']
        }
    });

    // YouTube Subscribers 
    var chart = c3.generate({
        bindto: '#chart-YouTube-Subscribers', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 11, 8, 15, 18, 19, 17, 32],
                ['data2', 7, 7, 5, 7, 9, 12, 11]
            ],
            type: 'bar', // default type of chart
            groups: [
                [ 'data1', 'data2']
            ],
            colors: {
                'data1': '#3d91be',
                'data2': '#dcecc9',
            },
            names: {
                // name of each serie
                'data1': 'Galned',
                'data2': 'Lost'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
        },
        bar: {
            width: 15
        },
        legend: {
            show: true, //hide legend
        },
    });

    // Linkedin Key Metrics
    var chart = c3.generate({
        bindto: '#chart-Linkedin-Metrics',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Clicks',
                data2: 'Likes',
            },
            columns: [
                ['data1', 22,14,45,28,18,27,40,55,26,88,43,62,12,18,27],
                ['data2', 13,11,21,24,8,63,34,51,10,55,29,57,18,21,29]
            ],
            colors: {
                data1: ['#46aace'],
                data2: ['#dcecc9'],
            },
            type: 'area'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        }
    });

    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [];
    var totalPoints = 200;
    function getRandomData() {
        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50;
            var y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }
    var plot = $.plot('#flotChart', [ getRandomData() ], {
        series: {
            color: '#3577ae',
                    shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 2,
                fill: true,
                fillColor: { colors: [ { opacity: 0 }, { opacity: 0.5 } ] }
            }
        },
        crosshair: {
            mode: 'x',
            color: '#2d5e9e'
        },
        grid: { borderWidth: 0 },
        yaxis: {
            min: 0,
            max: 100,
            color: 'rgba(0,0,0,.06)',
            font: {
                size: 10,
                color: '#666',
                family: 'Arial'
            },
            tickSize: 15
        },
        xaxis: { show: false }
    });
    function update() {
        plot.setData([getRandomData()]);
        // Since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        setTimeout(update, 2000);
    }
    update();
});
