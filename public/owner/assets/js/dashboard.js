document.addEventListener("DOMContentLoaded", () => {
	$(document).ready(function () {
		$.ajax({
			url: 'http://localhost/padros/dashboard/graphic',
			method: 'post',
			contentType: 'json',
			success: function(response) {
				new ApexCharts(document.querySelector("#reportsChart"), {
					series: [{
						name: 'Penjualan',
						data: response.graphic_penjualan
					}, {
						name: 'Pendapatan',
						data: response.graphic_pendapatan
					}, {
						name: 'Pelanggan',
						data: response.graphic_pelanggan
					}, {
						name: 'Pengeluaran',
						data: response.graphic_pengeluaran
					}],
					chart: {
						height: 350,
						type: 'area',
						toolbar: {
							show: false
						},
					},
					markers: {
						size: 4
					},
					colors: ['#4154f1', '#2eca6a', '#ff771d', '#dc3545'],
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
				}).render()

			}
		})
	})
})