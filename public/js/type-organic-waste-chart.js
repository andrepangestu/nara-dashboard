/* global Chart:false */

$(function () {
    'use strict';

    loadOrganicChart();
});

var $organicChart = $('#type-organic-waste-chart');
var organicChart;

function loadOrganicChart() {
    const ticksStyle = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: function (context) {
                var width = context.chart.width;
                return width < 500 ? 10 : 14;
            },
            weight: 300,
        },
        align: 'center',
        autoSkip: false,
        maxRotation: 0,
        minRotation: 0,
    };

    if (organicChart) {
        organicChart.destroy();
    }

    var chartLabels = [
        'Sayuran',
        'Minyak Jelantah',
        'Dedaunan / Sejenisnya',
        'Kulit Telur',
        'Ranting',
        'Kotoran Hewan',
    ];

    const labelAdjusted = chartLabels.map((label) => label.split(' '));

    var chartData = [1000, 2000, 3000, 2500, 2700, 2500, 3000];

    // eslint-disable-next-line no-unused-vars
    organicChart = new Chart($organicChart, {
        type: 'bar',
        data: {
            labels: labelAdjusted,
            datasets: [
                {
                    // label: 'Organic Waste',
                    backgroundColor: '#11388A',
                    borderColor: '#11388A',
                    hoverBackgroundColor: '#5AB2FF',
                    hoverBorderColor: '#5AB2FF',
                    data: chartData,
                    borderRadius: 50,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: ticksStyle,
                    beginAtZero: true,
                },
                y: {
                    ticks: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: false,
            },
        },
        plugins: [innerBarTextOrganicChart],
    });
}
