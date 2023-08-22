document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('customerForm').addEventListener('keydown', function(event) {
    event.preventDefault()
  })
  document.getElementById('customerForm').addEventListener('submit', function(event) {
    if (valid() !== undefined){
      event.preventDefault()
    }
  })


  $('#print').click(function (event) {
    event.preventDefault()
    const url = $(this).data('url')
    const width = 1500
    const height = 800
    const opened = window.open(url, 'Cetak Laporan', `width=${width}, height=${height}`)

  })


  function valid(){
    let fieldStart = document.querySelector('#start-feedback')
    let startInput = fieldStart.querySelector('#start')
    let fieldEnd = document.querySelector('#end-feedback')
    let endInput = fieldEnd.querySelector('#end')
    let fieldType = document.querySelector('#type-feedback')
    let typeInput = fieldType.querySelector('#type-hp')

    if (startInput.value.trim() === '') {
      fieldStart.querySelector('.invalid-feedback').innerHTML = 'Tanggal awal tidak boleh kosong'
      fieldStart.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldStart.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (endInput.value.trim() === '') {
      fieldEnd.querySelector('.invalid-feedback').innerHTML = 'Tanggal akhir tidak boleh kosong'
      fieldEnd.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEnd.querySelector('.invalid-feedback').style.display = 'none'
    }
  }

})

$(document).ready(function () {
  let monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
  let start = $.datepicker.parseDate("yy-mm-dd", $('#start').data('date'))
  let end = $.datepicker.parseDate("yy-mm-dd", $('#end').data('date'))
  if ($('#start').val() == '') {
    $('#start').val(start.getDate() + ' ' + monthNames[start.getMonth()] + ' ' + start.getFullYear())
  }
  if ($('#end').val() == '') {
    $('#end').val(end.getDate() + ' ' + monthNames[end.getMonth()] + ' ' + end.getFullYear())
  }

  $('#start').datepicker({
    defaultDate: start,
    autoSize: true,
    dateFormat: 'dd MM yy',
    monthNames: monthNames,
  })

  $('#end').datepicker({
    defaultDate: end,
    autoSize: true,
    dateFormat: 'dd MM yy',
    monthNames: monthNames,
  })
})