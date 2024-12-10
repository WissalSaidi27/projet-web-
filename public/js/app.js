document.addEventListener('DOMContentLoaded', () => {
    console.log("Page loaded and ready");

    // Add event listener for like buttons
    const likeForms = document.querySelectorAll('.like-form');
// Handle "Like" button functionality
document.querySelectorAll('.like-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const postId = this.querySelector('input[name="post_id"]').value;
        const likeCountElement = document.getElementById(`like-count-${postId}`);

        fetch('', {
            method: 'POST',
            body: new URLSearchParams(new FormData(this)),
        })
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            likeCountElement.textContent = data.likes; // Update likes count
        })
        .catch(error => console.error('Error:', error));
    });
});

    // Post upload validation
    const postForm = document.getElementById('postForm');
    if (postForm) {
        postForm.addEventListener('submit', function(event) {
            const image = document.getElementById('image').files.length; // Check if a file is selected
            const comment = document.getElementById('comment').value.trim();

            // Check if image is selected and comment is filled
            if (image === 0 || comment === '') {
                event.preventDefault(); // Prevent form submission
                alert('Please fill out both the image and description fields.'); // Alert message
            }
        });
    }
});