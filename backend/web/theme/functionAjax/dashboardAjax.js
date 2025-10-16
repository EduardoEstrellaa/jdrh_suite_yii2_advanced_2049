





var projectStatusLabels = [];
var projectStatusSeries = [];

for (var key in projectStatusCounts) {
    if (projectStatusCounts.hasOwnProperty(key)) {
        projectStatusLabels.push("Estado " + key);
        projectStatusSeries.push(projectStatusCounts[key]);
    }
}
var donutchartProjectsStatusColors = getChartColorsArray("prjects-status");
if (donutchartProjectsStatusColors) {
    var options = {
        series: projectStatusSeries,
        labels: projectStatusLabels,
        chart: {
            type: "donut",
            height: 230,
        },
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "90%",
                    labels: {
                        show: true,
                    }
                },
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: true,
        },
        stroke: {
            lineCap: "round",
            width: 0
        },
        colors: donutchartProjectsStatusColors,
    };
    var chart = new ApexCharts(document.querySelector("#prjects-status"), options);
    chart.render();
}
