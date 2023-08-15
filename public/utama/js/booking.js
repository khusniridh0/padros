let fieldName = document.getElementById('name')
let fieldDate = document.getElementById('date-of-entry')

fieldName.addEventListener('keydown', function(event) {
  event.preventDefault()
})
fieldDate.addEventListener('keydown', function(event) {
  event.preventDefault()
})
let payment_validated = {
  available: false,
  method: 'Transfer Bank',
  duration: 1
}

$(document).ready(function () {
  $('#date-of-entry').datepicker({
    defaultDate: new Date(),
    dateFormat: 'dd MM yy',
    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    minDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
    maxDate: new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0)
  });

  $('#proof-of-payment').on('change', function() {
    $($(this)[0].labels).html($(this).val().split('\\').pop());
  });

  $('.method-choice').click(function () {
    $('.method-choice').removeClass('active');
    $(this).addClass('active');
    $('#payment-method').html($(this).text());
    $('#select-payment-method').val($(this).text());

    if ($(this).text() == 'Transfer Bank') {
      payment_validated.method = 'Transfer Bank'
      payment()
    } else {
      payment_validated.method = 'Deposit'
      payment()
    }
  });

  $('#bookingForm').on('input', function(event) {
    // event.preventDefault();
    let data = {
      date: $('#date-of-entry').val(),
      timeIn: $('#clock-in').val(),
      timeOut: $('#clock-out').val()
    };

    $.ajax({
      url: 'http://localhost/padros/booking/check',
      method: 'POST',
      dataType: 'json',
      data: data,
      success: function(data) {
        if (data.status) {
          payment_validated.available = true
        } else {
          payment_validated.available = false
        }
      }
    });
  });
});

function payment() {
  let paymentMethodSelect = $('#select-payment-method')
  let paymentImage = $('#payment')
  let paymentField = paymentImage.find('input')
  let price = document.getElementById('price')
  let amount = document.getElementById('amount')
  let payAmount = document.getElementById('payment-amount')
  price = price.innerText
  price = price.replace(/\D/g, '')
  let invalid_price = price;

  if (payment_validated.available && payment_validated.method == 'Transfer Bank') {
    paymentMethodSelect.val('Transfer Bank')
    paymentImage.removeClass('d-none')
    paymentField.attr('disabled', false)  
  } else if (payment_validated.available && payment_validated.method == 'Deposit') {
    paymentImage.addClass('d-none')
    paymentMethodSelect.val('Deposit')
    paymentField.attr('disabled', true)
  }
  if (payment_validated.available) {
    price = price * payment_validated.duration
    if (payment_validated.duration > 0) {
      document.getElementById('submitButton').classList.remove('disabled')
      payAmount.value = price
      price = price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
      price = price.replace(",00", "");
      price = price.replace(/\./g, ",")
      amount.innerHTML = price
    } else {
      document.getElementById('submitButton').classList.add('disabled')
      paymentImage.addClass('d-none')
      paymentMethodSelect.val('Deposit')
      paymentField.attr('disabled', true)
      invalid_price = parseInt(invalid_price)
      payAmount.value = invalid_price
      invalid_price = invalid_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
      invalid_price = invalid_price.replace(",00", "");
      invalid_price = invalid_price.replace(/\./g, ",")
      amount.innerHTML = invalid_price
    }
  } else {
    document.getElementById('submitButton').classList.add('disabled')
    paymentImage.addClass('d-none')
    paymentMethodSelect.val('Deposit')
    paymentField.attr('disabled', true)
    invalid_price = parseInt(invalid_price)
    payAmount.value = invalid_price
    invalid_price = invalid_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
    invalid_price = invalid_price.replace(",00", "");
    invalid_price = invalid_price.replace(/\./g, ",")
    amount.innerHTML = invalid_price
  }
}

document.getElementById('clock-in').addEventListener('change', function () {
  validateTime({ev:'in'})
});
document.getElementById('clock-out').addEventListener('change', function () {
  validateTime({ev:'out'})
});

function validateTime(event) {
  let clockIn = document.getElementById('clock-in');
  let clockOut = document.getElementById('clock-out');
  let timeIn = new Date(`1970-01-01T${clockIn.value}`);
  let timeOut = new Date(`1970-01-01T${clockOut.value}`);

  if (timeIn > timeOut) {
    clockOut.value = clockIn.value
  } else if (timeOut < timeIn) {
    clockOut.value = clockIn.value
  } else {
    let duration = (timeOut.getTime() - timeIn.getTime()) / (1000 * 60 * 60)
    duration = Math.ceil(duration)
    payment_validated.duration = duration
    payment()
  }
}

$(document).ready(function () {
  $('#alertmodal.danger').modal('show')
})