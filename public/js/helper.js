const currentDate = new Date(new Date().getTime() + 7 * 60 * 60 * 1000)
    .toISOString()
    .split('T')[0];
const firstReleaseDate = '2024-11-20';

function formatNumberWithDots(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

const innerBarTextAnorganicChart = {
    id: 'centerText',
    afterDatasetsDraw: function (chart) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function (dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function (element, index) {
                    // Draw the text inside the bar
                    ctx.fillStyle = '#fff';
                    var fontSize = chart.width < 700 ? 12 : 16;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica';
                    ctx.font = Chart.helpers.fontString(
                        fontSize,
                        fontStyle,
                        fontFamily
                    );

                    var dataString = dataset.data[index].toString();

                    // Make sure alignment settings are correct
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var position = element.tooltipPosition();
                    ctx.fillText(
                        dataString,
                        position.x,
                        position.y + (chart.width < 600 ? 20 : 40)
                    );
                });
            }
        });
    },
};

const innerBarTextOrganicChart = {
    id: 'centerText',
    afterDatasetsDraw: function (chart) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function (dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function (element, index) {
                    // Draw the text inside the bar
                    ctx.fillStyle = '#fff';
                    var fontSize = chart.width < 500 ? 10 : 16;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica';
                    ctx.font = Chart.helpers.fontString(
                        fontSize,
                        fontStyle,
                        fontFamily
                    );

                    var dataString = dataset.data[index].toString();

                    // Make sure alignment settings are correct
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var position = element.tooltipPosition();
                    ctx.fillText(
                        dataString,
                        position.x,
                        position.y + (chart.width < 500 ? 20 : 40)
                    );
                });
            }
        });
    },
};
