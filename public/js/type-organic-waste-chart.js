/* global Chart:false */

$(function () {
    'use strict';
});

getDataOrganic(firstReleaseDate, currentDate)
    .then((data) => {
        loadOrganicChart(data);
    })
    .catch((error) => {
        console.error('Error fetching data from SheetDB:', error);
    });

var $organicChart = $('#type-organic-waste-chart');
var organicChart;

function getDataOrganic(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/organic-data',
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

function loadOrganicChart(data) {
    const ticksStyle = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: function (context) {
                var width = context.chart.width;
                return width < 500 ? 14 : 16;
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

    var chartLabels = ['Sampah Organik', 'Minyak Jelantah'];

    const labelAdjusted = chartLabels.map((label) => label.split(' '));

    var chartData = [data.sampah_organik, data.minyak_jelantah];

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
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.raw ? formatNumberWithDots(context.raw) : 0;
                        },
                    },
                },
            },
        },
        // plugins: [innerBarTextOrganicChart],
    });
}
