/* global Chart:false */

$(function () {
    'use strict';

    var ticksStyle = {
        fontColor: '#fff',
    };

    var $anorganicChart = $('#type-anorganic-waste-chart');

    // eslint-disable-next-line no-unused-vars
    var anorganicChart = new Chart($anorganicChart, {
        type: 'bar',
        data: {
            labels: ['Plastik PET', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    backgroundColor: '#11388A',
                    borderColor: '#11388A',
                    hoverBackgroundColor: '#5AB2FF',
                    hoverBorderColor: '#5AB2FF',
                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000],
                    borderWidth: 2,
                    borderRadius: Number.MAX_VALUE,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            datasetFill: false,
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        display: false,
                        gridLines: {
                            display: false,
                        },
                        ticks: $.extend(
                            {
                                beginAtZero: true,
                                // Include a dollar sign in the ticks
                                callback: function (value) {
                                    if (value >= 1000) {
                                        value /= 1000;
                                        value += 'k';
                                    }

                                    return '$' + value;
                                },
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
            elements: {
                bar: {
                    roundedCorners: 10, // Set the radius for rounded corners
                },
            },
        },
    });

    // lgtm [js/unused-local-variable]
});
