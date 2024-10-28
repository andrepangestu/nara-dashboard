/* global Chart:false */

$(function () {
    'use strict';

    //-------------
    //- DOUGHNUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var typeWasteData = {
        labels: ['Organic', 'Residu', 'Anorganic'],
        datasets: [
            {
                data: [300, 700, 400],
                backgroundColor: ['#54BC73', '#466FD2', '#5AB2FF'],
                borderColor: 'rgba(0, 0, 0, 0)',
                borderRadius: 10, // Add this line to round the edges
            },
        ],
    };
    var donutChartCanvas = $('#type-waste-chart').get(0).getContext('2d');
    var donutData = typeWasteData;
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false,
        },
        rotation: Math.PI,
        circumference: Math.PI,
        cutoutPercentage: 75,
        tooltips: {
            callbacks: {
                title: function (tooltipItem, data) {
                    return data['labels'][tooltipItem[0]['index']];
                },
                label: function (tooltipItem, data) {
                    return data['datasets'][0]['data'][tooltipItem['index']];
                },
            },
        },
    };

    // You can switch between pie and doughnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions,
    });
});
