/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

/* global moment:false, Chart:false, Sparkline:false */
$(function () {
  'use strict'

  /* Chart.js Charts */
  // Sales chart

  // $('#revenue-chart').get(0).getContext('2d');
    var test = [];
    $.ajax({
        url:'/admin/applications/stats',
        method: 'GET',
        success: function (data) {
            console.log(data)
            var arrayOFValues = [];
            for (var key in data) {
                arrayOFValues.push(data[key]);
            }
            console.log(arrayOFValues)
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
            var salesChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: 'Applications',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: arrayOFValues
                    },
                ]
            }
            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            max: 20
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'bar',
                data: salesChartData,
                options: salesChartOptions
            })
        },
        error: function (data) {
            console.log(data.responseJSON.message)
        }
    });
})
