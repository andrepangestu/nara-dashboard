/* global Chart:false */

$(function () {
    'use strict';
});

getDataSummary(firstReleaseDate, currentDate)
    .then((data) => {
        loadSummaryRecap(data);
    })
    .catch((error) => {
        console.error('Error fetching data from SheetDB:', error);
    });

function getDataSummary(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/summary-data',
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

function loadSummaryRecap(data) {
    let amountOfWaste = data.total_all_waste
        ? formatNumberWithDots(data.total_all_waste)
        : 0;
    document.getElementById('amount_of_waste').innerText =
        `${amountOfWaste} Kg`;

    let residu = data.residu ? formatNumberWithDots(data.residu) : 0;
    document.getElementById('residu').innerText = `${residu} Kg`;

    let economicValue = data.residu
        ? formatNumberWithDots(data.economic_value)
        : 0;
    document.getElementById('economic_value').innerText = `Rp${economicValue}`;

    let manageByTpst = data.residu
        ? formatNumberWithDots(data.manage_by_tpst)
        : 0;
    document.getElementById('manage_by_tpst').innerText = `${manageByTpst} Kg`;

    let manageByWastebank = data.residu
        ? formatNumberWithDots(data.manage_by_wastebank)
        : 0;
    document.getElementById('manage_by_wastebank').innerText =
        `${manageByWastebank} Kg`;
}
