document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsForm');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;

        // Reset error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input, textarea, select').forEach(el => el.style.borderColor = '');

        // Validate title
        const title = document.getElementById('title');
        if (title.value.length < 5 || title.value.length > 30) {
            isValid = false;
            title.style.borderColor = 'red';
            document.getElementById('titleError').textContent = 'Naslov mora imati između 5 i 30 znakova.';
        }

        // Validate about
        const about = document.getElementById('about');
        if (about.value.length < 10 || about.value.length > 100) {
            isValid = false;
            about.style.borderColor = 'red';
            document.getElementById('aboutError').textContent = 'Kratki sadržaj mora imati između 10 i 100 znakova.';
        }

        // Validate content
        const content = document.getElementById('content');
        if (content.value.trim() === '') {
            isValid = false;
            content.style.borderColor = 'red';
            document.getElementById('contentError').textContent = 'Sadržaj ne smije biti prazan.';
        }

        // Validate photo
        const photo = document.getElementById('pphoto');
        if (photo.files.length === 0) {
            isValid = false;
            photo.style.borderColor = 'red';
            document.getElementById('photoError').textContent = 'Morate odabrati sliku.';
        }

        // Validate category
        const category = document.getElementById('category');
        if (category.value === '') {
            isValid = false;
            category.style.borderColor = 'red';
            document.getElementById('categoryError').textContent = 'Morate odabrati kategoriju.';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
