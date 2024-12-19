$(function () {
    'use strict';
});

let valueTimeFrame = 'day';
let past7Days = getDateMinus7Days(currentDate);

getDataAmountWasteByDay(past7Days, currentDate)
    .then((data) => {
        loadAmountWasteChart(valueTimeFrame, data);
    })
    .catch((error) => {
        console.error('Error fetching data from SheetDB:', error);
    });

$('#timeFrameSelect').on('change', function () {
    valueTimeFrame = $(this).val();

    if (valueTimeFrame === 'day') {
        getDataAmountWasteByDay(past7Days, currentDate)
            .then((data) => {
                loadAmountWasteChart(valueTimeFrame, data);
            })
            .catch((error) => {
                console.error('Error fetching data from SheetDB:', error);
            });
    } else {
        getDataAmountWasteByMonth(currentDate)
            .then((data) => {
                loadAmountWasteChart(valueTimeFrame, data);
            })
            .catch((error) => {
                console.error('Error fetching data from SheetDB:', error);
            });
    }
});

var $amountWasteChart = $('#amount-waste-chart');
var amountWasteChart;

function getDateMinus7Days(currentDate) {
    let current = new Date(currentDate);
    current.setDate(current.getDate() - 6);
    return current.toISOString().split('T')[0];
}

function getDataAmountWasteByDay(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/amount-day-data',
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

function getDataAmountWasteByMonth(selected_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/amount-month-data',
            method: 'GET',
            data: {
                selected_date: selected_date,
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

function loadAmountWasteChart(valueTimeFrame, data) {
    const ticksStyleX = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: 14,
            weight: 300,
        },
        align: 'center',
    };

    const ticksStyleY = {
        color: '#fff',
        font: {
            family: 'Helvetica',
            size: 12,
            weight: 300,
        },
        align: 'center',
    };

    var labelMonth = [];
    var dataAnorganicMonth = [];
    var dataOrganicMonth = [];
    var dataResiduMonth = [];

    var labelDays = [];
    var dataAnorganicDays = [];
    var dataOrganicDays = [];
    var dataResiduDays = [];

    if (valueTimeFrame === 'month') {
        data.forEach((item) => {
            let month = new Date(item.year, item.month - 1)
                .toLocaleString('default', { month: 'short' })
                .toUpperCase();
            let year = item.year.toString().slice(2);
            labelMonth.push(`${month} ${year}`);
        });
        data.forEach((item) => {
            dataAnorganicMonth.push(item.total_data_anorganic);
        });
        data.forEach((item) => {
            dataOrganicMonth.push(item.total_data_organic);
        });
        data.forEach((item) => {
            dataResiduMonth.push(item.total_data_residu);
        });
    } else {
        data.forEach((item) => {
            let date = new Date(item.date);
            let day = date.getDate().toString().padStart(2, '0');
            let month = date
                .toLocaleString('default', { month: 'short' })
                .toUpperCase();
            labelDays.push(`${day} ${month}`);
        });
        data.forEach((item) => {
            dataAnorganicDays.push(item.total_data_anorganic);
        });
        data.forEach((item) => {
            dataOrganicDays.push(item.total_data_organic);
        });
        data.forEach((item) => {
            dataResiduDays.push(item.total_data_residu);
        });
    }

    if (amountWasteChart) {
        amountWasteChart.destroy();
    }

    // eslint-disable-next-line no-unused-vars
    amountWasteChart = new Chart($amountWasteChart, {
        data: {
            labels: valueTimeFrame === 'day' ? labelDays : labelMonth,
            datasets: [
                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'day'
                            ? dataAnorganicDays
                            : dataAnorganicMonth,
                    backgroundColor: 'tansparent',
                    borderColor: '#FA897F',
                    pointBorderColor: '#FA897F',
                    pointBackgroundColor: '#FA897F',
                    fill: false,
                },
                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'day'
                            ? dataResiduDays
                            : dataResiduMonth,
                    backgroundColor: 'tansparent',
                    borderColor: '#5AB2FF',
                    pointBorderColor: '#5AB2FF',
                    pointBackgroundColor: '#5AB2FF',
                    fill: false,
                },

                {
                    type: 'line',
                    data:
                        valueTimeFrame === 'day'
                            ? dataOrganicDays
                            : dataOrganicMonth,
                    backgroundColor: 'tansparent',
                    borderColor: '#58BA77',
                    pointBorderColor: '#58BA77',
                    pointBackgroundColor: '#58BA77',
                    fill: false,
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
                    ticks: $.extend(
                        {
                            beginAtZero: true,
                        },
                        ticksStyleX
                    ),
                    grid: {
                        color: '#5973B2',
                        borderDash: [5, 5],
                    },
                    border: {
                        display: false,
                    },
                },
                y: {
                    // afterTickToLabelConversion: function (chart) {
                    //     chart.ticks = [];
                    //     chart.ticks.push({ value: 200, label: '200' });
                    //     chart.ticks.push({ value: 1100, label: '1.100' });
                    //     chart.ticks.push({ value: 2000, label: '2.000' });
                    // },
                    ticks: $.extend(
                        {
                            maxTicksLimit: 3,
                            callback: function (value, index, values) {
                                return value
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            },
                        },
                        ticksStyleY
                    ),
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

    // lgtm [js/unused-local-variable]
}
