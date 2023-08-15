document.addEventListener("DOMContentLoaded", () => {
  $.ajax({
    url: 'http://localhost/padros/finance/graphic',
    method: 'post',
    contentType: 'json',
    success: function (response) {
      new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
          name: 'Pemasukan',
          data: response.payment[0]
        }, {
          name: 'Pengeluaran',
          data: response.spanding[0]
        }],
        chart: {
          height: 210,
          type: 'area',
          toolbar: {
            show: false
          },
        },
        markers: {
          size: 4
        },
        colors: ['#2eca6a', '#dc3545'],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.3,
            opacityTo: 0.4,
            stops: [0, 90, 100]
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          type: 'datetime',
          categories: response.categories
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        }
      }).render();
    }
  })

  document.getElementById('formFinance').addEventListener('input', idrFormat)

  function idrFormat() {
    let amount = document.getElementById('amount')
    let number = numberOnly(amount.value)
    if (number == '') {
      amount.value = ''
    } else {
      number = formating(number)
      amount.value = number
    }
  }

  function numberOnly(number) {
    return number.replace(/\D/g, '');
  }

  function formating(number) {
    number = parseInt(number)
    number = number.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    number = number.replace(',00', '')
    return number.replace(/\./g, ',')
  }
});