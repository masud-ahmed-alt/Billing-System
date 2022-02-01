// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example

var ctx2 = document.getElementById("myAreaChart");
let xrh2 = new XMLHttpRequest();
let date = [];
let profit = [];
xrh2.open('GET', 'ajax/chart.php?daily=1', true);
xrh2.onload = function () {
  let data = JSON.parse(this.responseText);
  for (let i = 0; i < data.length; i++) {
    date.push(data[i][2]);
    profit.push(data[i][0] - data[i][1]);
  }

  let max = profit.reduce(function (a, b) {
    return Math.max(a, b);
  }, 0);
  console.log(max);


  var chartArea = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: date.reverse(),
      datasets: [{
        label: "Profit",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: profit,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max,
            maxTicksLimit: 5
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}
xrh2.send();

