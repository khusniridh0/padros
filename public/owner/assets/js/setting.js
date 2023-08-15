
document.addEventListener('DOMContentLoaded', function() {

  document.getElementById('updateProfileForm').addEventListener('keydown', function(event) {
    document.getElementById('saveForm').classList.remove('disabled')
  })

  const input = document.getElementById('upload_image')
  input.addEventListener('change', function(){
    if (input.files && input.files[0]) {
      const reader = new FileReader()
      reader.onload = function(e) {
        document.getElementById('load-image').src = e.target.result
      }
      reader.readAsDataURL(input.files[0])
    }
  })

  document.getElementById('reset_picture').addEventListener('click', function (event) {
    event.preventDefault()
    fetch('http://localhost/padros/setting/reset_profile_picture', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ new: 'image' })
    })
    .then(function(response) {
      if (!response.ok) {
        throw new Error('Request gagal: ' + response.status);
      }
      return response.json();
    })
    .then(function(data) {
      document.getElementById('load-image').src = data['url']
    })
  })
})