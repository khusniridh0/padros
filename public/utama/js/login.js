document.addEventListener('DOMContentLoaded', function() {

  document.getElementById('loginForm').addEventListener('keyup', function(event) {
    event.preventDefault()
    if (valid() == undefined){
      document.querySelector('#submitButton').classList.remove('disabled')
    } else {
      document.querySelector('#submitButton').classList.add('disabled')
    }
    
  })
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    if (!valid() == undefined){
      event.preventDefault()
    }
  })

  function valid(){
    let fieldEmail = document.querySelector('#email-feedback')
    let emailInput = fieldEmail.querySelector('#email')
    let fieldPassword = document.querySelector('#password-feedback')
    let passwordInput = fieldPassword.querySelector('#password')

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailPattern.test(emailInput.value)) {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak valid'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (emailInput.value.trim() === '') {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak boleh kosong'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (passwordInput.value.length <= 6) {
      fieldPassword.querySelector('.invalid-feedback').innerHTML = 'Panjang minimal 6 karakter'
      fieldPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldPassword.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (passwordInput.value === '') {
      fieldPassword.querySelector('.invalid-feedback').innerHTML = 'Kata sandi tidak boleh kosong'
      fieldPassword.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldPassword.querySelector('.invalid-feedback').style.display = 'none'
    }
  }
})