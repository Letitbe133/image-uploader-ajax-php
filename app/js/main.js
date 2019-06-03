// select form element
const form = document.querySelector('#upload-form')

// select feedback container
const feedback = document.querySelector('.feedback')
// set value to empty string
feedback.innerHTML = ''

// select file input
const filePath = document.querySelector('.file-path')

// on form submission
form.addEventListener('submit', (e) => {
    // prevent form submission
    e.preventDefault()

    // check if file(s) submitted
    fileInput = document.querySelector('form [type="file"]').value == "" ? false : true

    if (fileInput) {

        // create a new Formdata object and pass the form as parameter
        let formData = new FormData(form)
    
        // send ajax request to corresponding route
        fetch('api/routes/save.php', {
        method: 'POST',
        body: formData
        })
        .then(response => response.json())
        .then(response => {
            console.log(response)
            feedback.innerHTML = `<p>${response.message}</p>`
            filePath.value = ''

        })
        .catch(error => console.error('Error :', error));

    } else {
        alert('Please select file(s) for upload')
    }

})