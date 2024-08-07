var options1 = {
    chart: {
        type: "area",
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    series: [{
        data: [10, 56, 48, 90, 52, 24, 50, 22, 36, 10]
    }],
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: ["#08cbfe"],
    fill: {
        opacity: [1, .1],
        type: "gradient",
        gradient: {
            inverseColors: !1,
            shade: "light",
            type: "vertical",
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 90, 100, 100]
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
new ApexCharts(document.querySelector("#project-chart"), options1).render();
options1 = {
    chart: {
        type: "area",
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    series: [{
        data: [10, 66, 42, 90, 62, 24, 55, 12, 36, 10]
    }],
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: ["#08cbfe"],
    fill: {
        opacity: [1, .1],
        type: "gradient",
        gradient: {
            inverseColors: !1,
            shade: "light",
            type: "vertical",
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 90, 100, 100]
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
new ApexCharts(document.querySelector("#ongoing-chart"), options1).render();
options1 = {
    chart: {
        type: "area",
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    series: [{
        data: [10, 36, 66, 10, 90, 24, 55, 12, 36, 62]
    }],
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: ["#08cbfe"],
    fill: {
        opacity: [1, .1],
        type: "gradient",
        gradient: {
            inverseColors: !1,
            shade: "light",
            type: "vertical",
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 90, 100, 100]
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
new ApexCharts(document.querySelector("#invoices-chart"), options1).render();
options1 = {
    chart: {
        type: "area",
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    series: [{
        data: [10, 36, 66, 10, 90, 24, 55, 12, 36, 62]
    }],
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: ["#08cbfe"],
    fill: {
        opacity: [1, .1],
        type: "gradient",
        gradient: {
            inverseColors: !1,
            shade: "light",
            type: "vertical",
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 90, 100, 100]
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
new ApexCharts(document.querySelector("#completed-chart"), options1).render();
var options = {
    chart: {
        height: 370,
        type: "bar",
        stacked: !0,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !0
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "15%",
            endingShape: "rounded",
            borderRadius: 5
        }
    },
    stroke: {
        width: 1
    },
    dataLabels: {
        enabled: !1
    },
    series: [{
        name: "A",
        data: [5, 7, 7, 6, 7, 5, 7, 6, 7]
    }, {
        name: "B",
        data: [4, 3, 4, 2, 4, 3, 2, 3, 4]
    }, {
        name: "C",
        data: [5, 7, 7, 6, 7, 5, 7, 6, 7]
    }],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"]
    },
    colors: ["#6c6ff5", "#9294f7", "#b4b7fb"],
    legend: {
        show: !1
    },
    fill: {
        opacity: 1
    }
},
    chart = new ApexCharts(document.querySelector("#analytics-chart"), options);
chart.render();
options = {
    series: [{
        name: "Offline",
        data: [90, 50, 100, 40, 100, 20]
    }, {
        name: "Online",
        data: [20, 90, 40, 100, 40, 100]
    }],
    chart: {
        height: 280,
        type: "radar",
        dropShadow: {
            enabled: !0,
            blur: 1,
            left: 1,
            top: 1
        },
        toolbar: {
            show: !0,
            tools: {
                download: !1
            }
        }
    },
    stroke: {
        width: 0
    },
    fill: {
        opacity: 1,
        colors: ["#ff5d5d", "#6c6ff5"]
    },
    markers: {
        size: 0
    },
    legend: {
        show: !1
    },
    xaxis: {
        categories: ["2016", "2017", "2018", "2019", "2020", "2021"]
    }
};
(chart = new ApexCharts(document.querySelector("#sales-reports"), options)).render();
options = {
    fill: {
        colors: ["#6c6ff5"]
    },
    series: [70],
    chart: {
        type: "radialBar",
        width: 50,
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    dataLabels: {
        enabled: !1
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: "60%"
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: !1
            }
        }
    }
};
(chart = new ApexCharts(document.querySelector("#mini-1"), options)).render();
options = {
    fill: {
        colors: ["#6fbe36"]
    },
    series: [70],
    chart: {
        type: "radialBar",
        width: 50,
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    dataLabels: {
        enabled: !1
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: "60%"
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: !1
            }
        }
    }
};
(chart = new ApexCharts(document.querySelector("#mini-2"), options)).render();
options = {
    fill: {
        colors: ["#ff5d5d"]
    },
    series: [70],
    chart: {
        type: "radialBar",
        width: 50,
        height: 50,
        sparkline: {
            enabled: !0
        }
    },
    dataLabels: {
        enabled: !1
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: "60%"
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: !1
            }
        }
    }
};
(chart = new ApexCharts(document.querySelector("#mini-3"), options)).render();
options = {
    series: [42, 47, 52],
    chart: {
        height: 450,
        type: "polarArea"
    },
    colors: ["#6c6ff5", "#6fbe36", "#ff5d5d"],
    labels: ["Facebook", "Twitter", "Instagram"],
    fill: {
        opacity: 1,
        colors: ["#6c6ff5", "#6fbe36", "#ff5d5d"]
    },
    stroke: {
        width: 0,
        colors: void 0
    },
    yaxis: {
        show: !1
    },
    legend: {
        position: "bottom"
    },
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 0
            },
            spokes: {
                strokeWidth: 0
            }
        }
    },
    theme: {
        colors: ["#2ec8f1", "#8851ff", "#4ad991"],
        monochrome: {
            colors: ["#2ec8f1", "#8851ff", "#4ad991"]
        }
    }
};
(chart = new ApexCharts(document.querySelector("#social-sales"), options)).render(), $("#usa-vectormap").vectorMap({
    map: "us_merc_en",
    backgroundColor: "transparent",
    regionStyle: {
        initial: {
            fill: "#6c6ff5"
        }
    },
    markerStyle: {
        initial: {
            r: 9,
            fill: "#6c6ff5",
            "fill-opacity": .9,
            stroke: "#fff",
            "stroke-width": 7,
            "stroke-opacity": .4
        },
        hover: {
            stroke: "#fff",
            "fill-opacity": 1,
            "stroke-width": 1.5
        }
    }
});