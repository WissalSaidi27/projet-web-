document.addEventListener('DOMContentLoaded', () => {
    console.log("Page loaded and ready");

    // Add event listener for like buttons
    const likeForms = document.querySelectorAll('.like-form');
    likeForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true; // Disable button to prevent double submissions
            const postId = this.querySelector('input[name="post_id"]').value;

            // Send a POST request to like the post
            fetch('', {
                method: 'POST',
                body: new URLSearchParams(new FormData(this)),
            })
            .then(response => response.text())
            .then(data => {
                // Update the like count on the page using the server's response
                const likeCountElement = document.getElementById(`like-count-${postId}`);
                likeCountElement.textContent = data; // Set to the updated like count from the server
            })
            .catch(error => console.error('Error:', error))
            .finally(() => {
                submitButton.disabled = false; // Re-enable the button
            });
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
