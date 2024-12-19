/* global Chart:false */

$(function () {
    'use strict';
});

getDataAnorganic(firstReleaseDate, currentDate)
    .then((data) => {
        loadAnorganicChart(data);
    })
    .catch((error) => {
        console.error('Error fetching data from SheetDB:', error);
    });

var $anorganicChart = $('#type-anorganic-waste-chart');
var anorganicChart;

function getDataAnorganic(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/anorganic-data',
            method: 'GET',
            data: {
                start_date: start_date,
                end_date: end_date,
            },
            success: function (data) {
                resolve(data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

function loadAnorganicChart(data) {
    const ticksStyle = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: function (context) {
                var width = context.chart.width;
                return width < 700 ? 12 : 14;
            },
            weight: 300,
        },
        align: 'center',
        autoSkip: false,
        maxRotation: 0,
        minRotation: 0,
    };

    if (anorganicChart) {
        anorganicChart.destroy();
    }

    var chartLabels = [
        'Plastic PET',
        'Plastic PP',
        'Plastic LDPE',
        'Plastic HDPE',
        'Beling',
        'Aluminium',
        'Kaleng',
        'Besi',
        'Gabruk',
        'Kertas',
        'Kardus',
    ];

    const labelAdjusted = chartLabels.map((label) => label.split(' '));

    var chartData = [
        data.plastic_pet,
        data.plastic_pp,
        data.plastic_ldpe,
        data.plastic_hdpe,
        data.beling,
        data.aluminium,
        data.kaleng,
        data.besi,
        data.gabruk,
        data.kertas,
        data.kardus,
    ];

    // eslint-disable-next-line no-unused-vars
    anorganicChart = new Chart($anorganicChart, {
        type: 'bar',
        data: {
            labels: labelAdjusted,
            datasets: [
                {
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
                    border: {
                        display: false,
                    },
                },
                y: {
                    ticks: {
                        display: false,
                    },
                    beginAtZero: true,
                    border: {
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
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.raw
                                ? formatNumberWithDots(context.raw)
                                : 0;
                        },
                    },
                },
            },
        },
        // plugins: [innerBarTextAnorganicChart],
    });
}
