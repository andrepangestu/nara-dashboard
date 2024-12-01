/* global Chart:false */

$(function () {
    'use strict';

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
});

getDataTypeWaste(currentDate, currentDate).then((data) => {
    loadTypeWasteChart(data);
}).catch((error) => {
    console.error('Error fetching data from SheetDB:', error);
});

var $typeWasteChart = $('#type-waste-chart');
var typeWasteChart;

function getDataTypeWaste(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/type-waste-data',
            method: 'GET',
            data: {
                start_date: start_date,
                end_date: end_date
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

function loadTypeWasteChart(data) {
    var totalWaste = data.total_all_waste; 
    document.getElementById('total-waste').innerText = totalWaste;

    var typeWasteData = {
        labels: ['Organic', 'Residu', 'Anorganic'],
        datasets: [
            {
                data: [
                    data.total_organic,
                    data.total_anorganic,
                    data.residu
                ],
                backgroundColor: ['#54BC73', '#5AB2FF', '#FA897F'],
                borderColor: 'rgba(0, 0, 0, 0)',
                // borderRadius: 10, // Add this line to round the edges
            },
        ],
    };

    if (typeWasteChart) {
        typeWasteChart.destroy();
    }

    var donutData = typeWasteData;
    var donutOptions = {
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        var dataset = tooltipItem.dataset;
                        var total = dataset.data.reduce((previousValue, currentValue) => previousValue + currentValue);
                        var currentValue = dataset.data[tooltipItem.dataIndex];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return percentage + '%';
                    }
                }
            },
        },
        rotation: -90,
        circumference: 180,
        cutout: '75%',
        maintainAspectRatio: true,
        responsive: true,
    };

    // You can switch between pie and doughnut using the method below.
    typeWasteChart = new Chart($typeWasteChart, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions,
    });
}