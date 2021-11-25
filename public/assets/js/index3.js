// C3 Chart js
$(function(){
    "use strict";
    // Small chart widgets
    var chart = c3.generate({
        bindto: '#chart-bg-users-1',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Bitcoin'
            },
            columns: [
                ['data1', 30, 40, 10, 40, 12, 22, 40]
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
            show: false
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
            pattern: ['#467fcf']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-bg-users-2',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Litecoin'
            },
            columns: [
                ['data1', 12, 21, 17, 40, 19, 22, 13]
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
            show: false
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
            pattern: ['#e74c3c']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-bg-users-3',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Ethereum'
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
            show: false
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
            pattern: ['#5eba00']
        }
    });
    var chart = c3.generate({
        bindto: '#chart-bg-users-4',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        data: {
            names: {
                data1: 'Cardano'
            },
            columns: [
                ['data1', 30, 40, 10, 40, 12, 22, 40]
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
            show: false
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
            pattern: ['#f1c40f']
        }
    });

    var chart = c3.generate({
        bindto: '#chart-temperature', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 13.9, 14.2, 15.7, 18.5, 21.9, 15.2, 17.0, 16.6, 24.2, 39.3, 31.6, 44.8],
                ['data2', 7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 21.5, 23.3, 18.3, 13.9, 9.6],                
                ['data3', 3.9, 4.2, 25.7, 8.5, 1.9, 5.2, 7.0, 6.6, 4.2, 1.3, 6.6, 4.8]
            ],
            labels: true,
            type: 'line', // default type of chart
            colors: {
                'data1': '#fd9644', // orange
                'data2': '#5eba00', // green
                'data3': '#467fcf', // blue
            },
            names: {
                // name of each serie
                'data1': 'Bitcoin',
                'data2': 'Cardano',
                'data3': 'Litecoin',
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
            },
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