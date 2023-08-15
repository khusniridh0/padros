document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    if (valid() !== undefined){
      event.preventDefault()
    }
  })

  function valid(){
    let fieldName = document.querySelector('#name-feedback')
    let nameInput = fieldName.querySelector('#name')
    let fieldEmail = document.querySelector('#email-feedback')
    let emailInput = fieldEmail.querySelector('#email')
    let fieldHP = document.querySelector('#HP-feedback')
    let hpInput = fieldHP.querySelector('#no-hp')
    let fieldPassword = document.querySelector('#password-feedback')
    let passwordInput = fieldPassword.querySelector('#password')
    let fieldKonfirmPassword = document.querySelector('#konfirm-password-feedback')
    let konfirmPasswordInput = fieldKonfirmPassword.querySelector('#konfirm-password')

    if (nameInput.value.trim() === '') {
      fieldName.querySelector('.invalid-feedback').innerHTML = 'Nama tidak boleh kosong'
      fieldName.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldName.querySelector('.invalid-feedback').style.display = 'none'
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailPattern.test(emailInput.value)) {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak valid'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (hpInput.value.trim() === '') {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak boleh kosong'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    let hpPattern = /^(08)(\d{2,4}-?){2}\d{3,4}$/
    if (!hpPattern.test(hpInput.value)) {
      fieldHP.querySelector('.invalid-feedback').innerHTML = 'Nomor HP tidak valid'
      fieldHP.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldHP.querySelector('.invalid-feedback').style.display = 'none'
    }  

    if (hpInput.value.trim() === '') {
      fieldHP.querySelector('.invalid-feedback').innerHTML = 'Nomor HP tidak boleh kosong'
      fieldHP.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldHP.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (passwordInput.value.length < 6) {
      fieldPassword.querySelector('.invalid-feedback').innerHTML = 'Panjang minimal 6 karakter'
      fieldPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldPassword.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (passwordInput.value.trim() === '') {
      fieldPassword.querySelector('.invalid-feedback').innerHTML = 'Kata sandi tidak boleh kosong'
      fieldPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldPassword.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (konfirmPasswordInput.value !== passwordInput.value) {
      fieldKonfirmPassword.querySelector('.invalid-feedback').innerHTML = 'Konfirmasi kata sandi tidak cocok'
      fieldKonfirmPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldKonfirmPassword.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (konfirmPasswordInput.value.trim() === '') {
      fieldKonfirmPassword.querySelector('.invalid-feedback').innerHTML = 'Konfirmasi kata sandi tidak boleh kosong'
      fieldKonfirmPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldKonfirmPassword.querySelector('.invalid-feedback').style.display = 'none'
    }
  }
})