document.addEventListener('DOMContentLoaded', function() {

  document.getElementById('forgetyForm').addEventListener('keyup', function(event) {
    event.preventDefault()
    if (valid() == undefined){
      document.querySelector('#submitButton').classList.remove('disabled')
    } else {
      document.querySelector('#submitButton').classList.add('disabled')
    }
    
  })
  document.getElementById('forgetyForm').addEventListener('submit', function(event) {
    if (!valid() == undefined){
      event.preventDefault()
    }
  })

  function valid(){
    let fieldEmail = document.querySelector('#forget-feedback')
    let emailInput = fieldEmail.querySelector('#forget')

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
  }
})