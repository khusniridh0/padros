document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('send-verify-link').addEventListener('click', function(event) {
    event.preventDefault()
    cooldown()

    $.ajax({
      method: "POST",
      url: 'http://localhost/padros/auth/verify/requestcode',
      data: {requestCode: 'true'},
      dataType: 'json',
      success: function(data) {
        console.log(data);
      }
    });

  })

  document.getElementById('verifyForm').addEventListener('keydown', function(event) {
    if (valid() == undefined){
      document.querySelector('#submitButton').classList.remove('disabled')
    } else {
      document.querySelector('#submitButton').classList.add('disabled')
    }

    function valid() {
      let verifyForm = document.getElementById('verifyForm')
      let verifyInput = verifyForm.querySelector('#verify')

      let keyCode = event.keyCode || event.which
      let char = String.fromCharCode(keyCode)
      let isNumberOrBackspace = /^[0-9\b]+$/.test(char)

      if (!isNumberOrBackspace) {
        event.preventDefault()
        verifyForm.querySelector('.invalid-feedback').innerHTML = 'Hanya boleh angka'
        verifyForm.querySelector('.invalid-feedback').style.display = 'block'
        return
      } else {
        verifyForm.querySelector('.invalid-feedback').style.display = 'none'
      }

      if (verifyInput.value.length !== 5) {
        verifyForm.querySelector('.invalid-feedback').innerHTML = 'Kode verifikasi tidak valid'
        verifyForm.querySelector('.invalid-feedback').style.display = 'block'
        return
      } else {
        verifyForm.querySelector('.invalid-feedback').style.display = 'none'
      }
    }
  })

  function cooldown() {
    let timeOut = document.querySelector('#time-out')
    let sendCode = document.querySelector('#send-verify-link')
    let time = timeOut.dataset['time']
    sendCode.classList.toggle('d-none')
    timeOut.classList.toggle('d-none')
    
    timeOut.innerHTML = `${time} detik`
    let runTime = setInterval(function () {
      if (--time < 0){
        sendCode.classList.toggle('d-none')
        timeOut.classList.toggle('d-none')
        clearInterval(runTime)
      } else {
        timeOut.innerHTML = `${time} detik`
      }
    }, 1000)
  }

  cooldown()
})