/* global Chart:false */

$(function () {
    'use strict';

    loadChart();
});

function updateChart() {
    var selectedValue = document.getElementById('timeframe-select').value;

    loadChart(selectedValue);
}

function loadChart(valueTimeFrame = 'days') {
    var ticksStyle = {
        fontColor: '#fff',
    };

    var mode = 'index';
    var intersect = true;

    var $amountWasteChart = $('#amount-waste-chart');

    var labelMonth = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    var dataAnorganicMonth = [
        100, 120, 170, 167, 180, 177, 160, 190, 200, 190, 200, 190,
    ];
    var dataOrganicMonth = [
        344, 330, 202, 634, 234, 355, 865, 452, 333, 353, 222, 687,
    ];
    var dataResiduMonth = [
        576, 654, 345, 352, 325, 765, 876, 345, 584, 435, 234, 643,
    ];

    var labelDays = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
    ];
    var dataAnorganicDays = [100, 120, 170, 167, 180, 177, 160];
    var dataResiduDays = [99, 43, 45, 66, 12, 22, 200];
    var dataOrganicDays = [60, 80, 70, 67, 80, 77, 100];

    // eslint-disable-next-line no-unused-vars
    var amountWasteChart = new Chart($amountWasteChart, {
        data: {
            labels: valueTimeFrame === 'days' ? labelDays : labelMonth,
            datasets: [
                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'days'
                            ? dataAnorganicDays
                            : dataAnorganicMonth,
                    backgroundColor: '#FA897F',
                    borderColor: '#FA897F',
                    pointBorderColor: '#FA897F',
                    pointBackgroundColor: '#FA897F',
                    fill: false,
                    // pointHoverBackgroundColor: '#007bff',
                    // pointHoverBorderColor    : '#007bff'
                },
                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'days'
                            ? dataResiduDays
                            : dataResiduMonth,
                    backgroundColor: 'tansparent',
                    borderColor: '#5AB2FF',
                    pointBorderColor: '#5AB2FF',
                    pointBackgroundColor: '#5AB2FF',
                    fill: false,
                    // pointHoverBackgroundColor: '#ced4da',
                    // pointHoverBorderColor    : '#ced4da'
                },

                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'days'
                            ? dataOrganicDays
                            : dataOrganicMonth,
                    backgroundColor: 'tansparent',
                    borderColor: '#58BA77',
                    pointBorderColor: '#58BA77',
                    pointBackgroundColor: '#58BA77',
                    fill: false,
                    // pointHoverBackgroundColor: '#ced4da',
                    // pointHoverBorderColor    : '#ced4da'
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        display: false,
                        ticks: $.extend(
                            {
                                beginAtZero: true,
                                suggestedMax: 200,
                            },
                            ticksStyle
                        ),
                    },
                ],
                xAxes: [
                    {
                        display: true,
                        gridLines: {
                            display: false,
                        },
                        ticks: ticksStyle,
                    },
                ],
            },
        },
    });

    // lgtm [js/unused-local-variable]
}
