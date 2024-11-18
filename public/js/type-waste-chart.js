/* global Chart:false */

$(function () {
    'use strict';

    var typeWasteData = {
        labels: ['Organic', 'Residu', 'Anorganic'],
        datasets: [
            {
                data: [300, 700, 400],
                backgroundColor: ['#54BC73', '#466FD2', '#5AB2FF'],
                borderColor: 'rgba(0, 0, 0, 0)',
                // borderRadius: 10, // Add this line to round the edges
            },
        ],
    };

    // var donutChartCanvas = $('#type-waste-chart').get(0).getContext('2d');
    var donutChartCanvas = $('#type-waste-chart');

    var donutData = typeWasteData;
    var donutOptions = {
        plugins: {
            legend: {
                display: false,
            },
            // tooltip: false,
        },
        rotation: -90,
        circumference: 180,
        cutout: '75%',
        maintainAspectRatio: true,
        responsive: true,
    };

    // You can switch between pie and doughnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions,
    });
});
