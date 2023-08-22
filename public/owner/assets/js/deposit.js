$('.deposit-detile').click(function () {
	$.ajax({
		url: $(this).data('url'),
		method: 'post',
		dataType: 'json',
		success: function (response) {
			$('#detile-invoice').html(response.uuid_deposit)
			$('#detile-price').html(response.amount)
			$('#detile-name').html(response.name)
			$('#detile-tanggal').html(response.date)
			$('#payment-picture-target').attr('src', response.proof)

			if (!response.reject == '' && !response.accept == '') {
				$('#action').removeClass('d-none')
				$('#detile-reject').attr('href', response.reject)
				$('#detile-accept').attr('href', response.accept)
			}
		},
	})

	$('#proof-deposit').on('hidden.bs.modal', function () {
		$('#action').addClass('d-none')
	})
})