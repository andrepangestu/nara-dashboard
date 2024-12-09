/* global Chart:false */

$(function () {
    'use strict';
});

getDataSummary(firstReleaseDate, currentDate)
    .then((data) => {
        loadSummaryRecap(data);
        loadTotalNasabah(data);
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

document.addEventListener('DOMContentLoaded', function () {
    const economicValueConversionElement = document.getElementById(
        'economic_value_conversion'
    );
    const economicValueConversionContainer = document.getElementById(
        'economic-value-conversion-container'
    );
    function adjustFontSize() {
        const length = economicValueConversionElement.textContent.length;

        let fontSize = '60px'; // default font size
        if (length > 10) {
            fontSize = '40px';
        } else if (length > 5) {
            fontSize = '50px';
        }
        economicValueConversionContainer.style.fontSize = fontSize;
    }
    // Initial adjustment
    adjustFontSize();

    // Adjust font size whenever the content changes
    const observer = new MutationObserver(adjustFontSize);
    observer.observe(economicValueConversionElement, {
        childList: true,
        subtree: true,
    });
});

function loadTotalNasabah(data) {
    let economicValue = data.economic_value;
    let economicValueConversion = economicValue
        ? formatNumberWithDots(economicValue).replace(/\.\d{3}$/, '')
        : 0;

    console.log(economicValue.toString().length);

    document.getElementById('economic_value_conversion').innerText =
        `${economicValue.toString().length > 3 ? economicValueConversion + ' K' : economicValueConversion}`;
}

function loadSummaryRecap(data) {
    let amountOfWaste = data.total_all_waste
        ? formatNumberWithDots(data.total_all_waste)
        : 0;
    document.getElementById('amount_of_waste').innerText =
        `${amountOfWaste} Kg`;

    let residu = data.residu ? formatNumberWithDots(data.residu) : 0;
    document.getElementById('residu').innerText = `${residu} Kg`;

    let economicValue = data.economic_value
        ? formatNumberWithDots(data.economic_value)
        : 0;
    document.getElementById('economic_value').innerText = `Rp${economicValue}`;

    let manageByTpst = data.manage_by_tpst
        ? formatNumberWithDots(data.manage_by_tpst)
        : 0;
    document.getElementById('manage_by_tpst').innerText = `${manageByTpst} Kg`;

    let manageByWastebank = data.manage_by_wastebank
        ? formatNumberWithDots(data.manage_by_wastebank)
        : 0;
    document.getElementById('manage_by_wastebank').innerText =
        `${manageByWastebank} Kg`;
}
