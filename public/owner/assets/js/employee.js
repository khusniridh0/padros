
document.addEventListener('DOMContentLoaded', function() {

  document.getElementById('updateProfileForm').addEventListener('keydown', function(event) {
    document.getElementById('saveForm').classList.remove('disabled')
  })
})