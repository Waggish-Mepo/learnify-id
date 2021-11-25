$(function() {
"use strict";

    var chart = c3.generate({
        bindto: '#chart-Event-sale-overview ', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 9, 14, 18, 21, 12, 21, 23, 18, 13, 9],
                ['data2', 15, 18, 11, 15, 17, 16, 14, 17, 16, 14]
            ],
            labels: true,
            type: 'line', // default type of chart
            colors: {
                'data1': '#e96a8d',
                'data2': '#f3aca2',
            },
            names: {
                // name of each serie
                'data1': 'Sold',
                'data2': 'Available'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Feb 15', 'Feb 16', 'Feb 17', 'Feb 18', 'Feb 19', 'Feb 20', 'Feb 21', 'Feb 22', 'Feb 23', 'Feb 24']
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
                'data1': 'Male',
                'data2': 'Female',
                'data3': 'VIP',
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

    var chart = c3.generate({
        bindto: '#chart-Members', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 11, 8, 15, 18, 19, 17],
                ['data2', 7, 7, 5, 7, 9, 12]
            ],
            type: 'bar', // default type of chart
            groups: [
                [ 'data1', 'data2']
            ],
            colors: {
                'data1': '#467fcf', // blue
                'data2': '#f66d9b', // pink
            },
            names: {
                // name of each serie
                'data1': 'User',
                'data2': 'VIP'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
        },
        bar: {
            width: 10
        },
        legend: {
            show: false, //hide legend
        },
        padding: {
            bottom: -20,
            top: 0,
            left: -6,
        },
    });
});
