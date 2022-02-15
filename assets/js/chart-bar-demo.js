// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
var ctx = document.getElementById("profit_barChart");

// Bar Chart Example

let xrh = new XMLHttpRequest();
xrh.open('GET', 'ajax/chart.php?profit=1', true);
xrh.onload = function () {
  let data = JSON.parse(this.responseText);
  let buy = [];
  let sell = [];
  let month = [];
  console.log(data);
  for (let i = 0; i < data.length; i++) {
    
    buy.push(data[i][1]);
    sell.push(data[i][0]);
    month.push(data[i][3]);
  }
  let max = sell.reduce(function (a, b) {
    return Math.max(a, b);
  }, 0);
  console.log(sell);
  console.log(buy);
 
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: month,
      datasets: [{
        label: "Sell Price",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: sell,
      },
      {
        label: "Buy Price",
        backgroundColor: "rgba(255, 0, 255, 1)",
        borderColor: "rgba(255, 0, 255, 1)",
        data: buy,
      }
      ],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.ceil(max/100)*100,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });

}
xrh.send();


