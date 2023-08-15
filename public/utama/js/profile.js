document.addEventListener('DOMContentLoaded', function() {

  document.getElementById('profilForm').addEventListener('keyup', function(event) {
    event.preventDefault()
    if (valid() == undefined && sec() == undefined){
      document.querySelector('#submitButton').classList.remove('disabled')
    } else {
      document.querySelector('#submitButton').classList.add('disabled')
    }
  })

  document.getElementById('profilForm').addEventListener('submit', function (event) {
    if (!valid() == undefined && !sec()){
      event.preventDefault()
    }

    if (!sec() == undefined){
      event.preventDefault()
    }
  })

  document.getElementById('profilForm').addEventListener('click', function() {
    document.querySelector('#submitButton').classList.add('disabled')
    if (sec() == undefined) {
      document.querySelector('#submitButton').classList.remove('disabled')
    }
  })

  document.getElementById('depositUp').addEventListener('input', idrFormat)
  document.getElementById('depositUp').addEventListener('submit', notNull)

  const modalTopUp = document.getElementById('TopUp')
  const inputTopUp = document.getElementById('deposit')

  modalTopUp.addEventListener('shown.bs.modal', function () {
    inputTopUp.focus()
  })
  modalTopUp.addEventListener('hidden.bs.modal', function () {
    inputTopUp.value = ''
  })

  function notNull(events) {
    if (inputTopUp.value == '') {
      event.preventDefault()
    }
  }

  function sec() {
    let security = document.querySelector('#security')

    let fieldNowPassword = document.querySelector('#now-password-feedback')
    let nowPasswordInput = fieldNowPassword.querySelector('#now-password')

    let fieldNewPassword = document.querySelector('#new-password-feedback')
    let newPasswordInput = fieldNewPassword.querySelector('#new-password')

    let fieldConfirmNewPassword = document.querySelector('#confirm-new-password-feedback')
    let confirmNewPasswordInput = fieldConfirmNewPassword.querySelector('#confirm-new-password')

    if (security.checked) {
      nowPasswordInput.removeAttribute('disabled', false)
      nowPasswordInput.removeAttribute('readonly', false)

      newPasswordInput.removeAttribute('disabled', false)
      newPasswordInput.removeAttribute('readonly', false)

      confirmNewPasswordInput.removeAttribute('disabled', false)
      confirmNewPasswordInput.removeAttribute('readonly', false)

      if (nowPasswordInput.value.trim() === '') {
        fieldNowPassword.querySelector('.invalid-feedback').innerHTML = 'Harus konfirmasi dengan sandi saat ini'
        fieldNowPassword.querySelector('.invalid-feedback').style.display = 'block'
        return false
      } else {
        fieldNowPassword.querySelector('.invalid-feedback').style.display = 'none'
      }

      if (newPasswordInput.value.trim() === '') {
        fieldNewPassword.querySelector('.invalid-feedback').innerHTML = 'Buat sandi baru'
        fieldNewPassword.querySelector('.invalid-feedback').style.display = 'block'
        return false
      } else {
        fieldNewPassword.querySelector('.invalid-feedback').style.display = 'none'
      }

      if (confirmNewPasswordInput.value.trim() === '') {
        fieldConfirmNewPassword.querySelector('.invalid-feedback').innerHTML = 'Ulangi sandi baru'
        fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'block'
        return false
      } else {
        fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'none'
      }

      if (confirmNewPasswordInput.value.trim() !== newPasswordInput.value.trim()) {
        fieldConfirmNewPassword.querySelector('.invalid-feedback').innerHTML = 'Sandi tidak sama'
        fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'block'
        return false
      } else {
        fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'none'
      }

    } else {
      nowPasswordInput.setAttribute('disabled', true)
      nowPasswordInput.setAttribute('readonly', true)
      nowPasswordInput.value = ''
      nowPasswordInput.value = ''

      newPasswordInput.setAttribute('disabled', true)
      newPasswordInput.setAttribute('readonly', true)
      newPasswordInput.value = ''
      newPasswordInput.value = ''

      confirmNewPasswordInput.setAttribute('disabled', true)
      confirmNewPasswordInput.setAttribute('readonly', true)
      confirmNewPasswordInput.value = ''
      confirmNewPasswordInput.value = ''

      fieldNowPassword.querySelector('.invalid-feedback').style.display = 'none'
      fieldNewPassword.querySelector('.invalid-feedback').style.display = 'none'
      fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'none'
      fieldConfirmNewPassword.querySelector('.invalid-feedback').style.display = 'none'
    }
  }

  function valid() {
    let fieldName = document.querySelector('#name-feedback')
    let nameInput = fieldName.querySelector('#name')
    let fieldEmail = document.querySelector('#email-feedback')
    let emailInput = fieldEmail.querySelector('#email')
    let fieldNoHp = document.querySelector('#no-hp-feedback')
    let noHpInput = fieldNoHp.querySelector('#no-hp')
    let fieldAddress = document.querySelector('#address-feedback')
    let addressInput = fieldAddress.querySelector('#address')
    let fieldNowPassword = document.querySelector('#now-password-feedback')
    let nowPasswordInput = fieldNowPassword.querySelector('#now-password')
    let fieldNewPassword = document.querySelector('#new-password-feedback')
    let newPasswordInput = fieldNewPassword.querySelector('#new-password')
    let fieldConfirmNewPassword = document.querySelector('#confirm-new-password-feedback')
    let confirmNewPasswordInput = fieldConfirmNewPassword.querySelector('#confirm-new-password')
    

    if (nameInput.value.trim() === '') {
      fieldName.querySelector('.invalid-feedback').innerHTML = 'Nama tidak boleh kosong'
      fieldName.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldName.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (emailInput.value.trim() === '') {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak boleh kosong'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailPattern.test(emailInput.value)) {
      fieldEmail.querySelector('.invalid-feedback').innerHTML = 'Email tidak tidak valid'
      fieldEmail.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldEmail.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (noHpInput.value.trim() === '') {
      fieldNoHp.querySelector('.invalid-feedback').innerHTML = 'Nomor HP tidak boleh kosong'
      fieldNoHp.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldNoHp.querySelector('.invalid-feedback').style.display = 'none'
    }

    let hpPattern = /^(08)(\d{2,4}-?){2}\d{3,4}$/
    if (!hpPattern.test(noHpInput.value)) {
      fieldNoHp.querySelector('.invalid-feedback').innerHTML = 'Nomor HP tidak valid'
      fieldNoHp.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldNoHp.querySelector('.invalid-feedback').style.display = 'none'
    }

    if (addressInput.value.trim() === '') {
      fieldAddress.querySelector('.invalid-feedback').innerHTML = 'Alamat tidak boleh kosong'
      fieldAddress.querySelector('.invalid-feedback').style.display = 'block'
      return false
    } else {
      fieldAddress.querySelector('.invalid-feedback').style.display = 'none'
    }
  }

  function idrFormat() {
    let amount = document.getElementById('deposit')
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
})