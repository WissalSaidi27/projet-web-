// Handle "Like" button functionality for all posts
document.querySelectorAll('.like-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        let likeCount = button.closest('.post-item').querySelector('.like-count');
        let currentLikes = parseInt(likeCount.textContent);
        likeCount.textContent = (currentLikes + 1) + ' Likes';

        
    });
});


document.querySelectorAll('.comment-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        let commentText = button.closest('.post-item').querySelector('.comment-input').value;
        if (commentText) {
            let commentList = button.closest('.post-item').querySelector('.comments-list');
            let newComment = document.createElement('li');
            newComment.textContent = commentText;
            commentList.appendChild(newComment);
            button.closest('.post-item').querySelector('.comment-input').value = ''; // Clear input field

            
        }
    });
});
