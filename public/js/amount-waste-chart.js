$(function () {
    'use strict';

    loadWasteChart();
});

var $amountWasteChart = $('#amount-waste-chart');
var amountWasteChart;

function loadWasteChart(valueTimeFrame = 'days') {
    const ticksStyle = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: 14,
            weight: 300,
        },
        align: 'center',
    };

    // var labelMonth = [
    //     'Januari',
    //     'Februari',
    //     'Maret',
    //     'April',
    //     'Mei',
    //     'Juni',
    //     'Juli',
    //     'Agustus',
    //     'September',
    //     'Oktober',
    //     'November',
    //     'Desember',
    // ];

    var labelMonth = [
        'NOV 25',
        "DEC 25"
    ];
    // var dataAnorganicMonth = [
    //     100, 120, 170, 167, 180, 177, 160, 190, 200, 190, 200, 190,
    // ];
    // var dataOrganicMonth = [
    //     344, 330, 202, 634, 234, 355, 865, 452, 333, 353, 222, 687,
    // ];
    // var dataResiduMonth = [
    //     576, 654, 345, 352, 325, 765, 876, 345, 584, 435, 234, 643,
    // ];


    var dataAnorganicMonth = [
        100, 222
    ];
    var dataOrganicMonth = [
        344, 300
    ];
    var dataResiduMonth = [
        576, 400
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

    if (amountWasteChart) {
        amountWasteChart.destroy();
    }

    // eslint-disable-next-line no-unused-vars
    amountWasteChart = new Chart($amountWasteChart, {
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
                x: {
                    ticks: ticksStyle,
                    // ticks: $.extend(
                    //     {
                    //         beginAtZero: true,
                    //         suggestedMax: 200,
                    //     },
                    //     ticksStyle
                    // ),
                    beginAtZero: true,
                    grid: {
                        color: '#5973B2',
                        borderDash: [5, 5],
                    },
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
            },
        },
    });

    $('#timeFrameSelect').on('change', function () {
        valueTimeFrame = $(this).val();
        loadWasteChart(valueTimeFrame);
    });

    // lgtm [js/unused-local-variable]
}
