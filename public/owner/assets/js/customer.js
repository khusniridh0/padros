document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('customerForm').addEventListener('submit', function(event) {
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
  }
})