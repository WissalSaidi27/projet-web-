-- Create the database
CREATE DATABASE IF NOT EXISTS monument_site;

-- Use the database
USE monument_site;

-- Create the posts table
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each post
    image_path VARCHAR(255) NOT NULL,   -- Path to the uploaded image
    comment TEXT,                       -- Comment associated with the post
    likes INT DEFAULT 0,                -- Like counter for the post
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp of when the post was created
    
);

-- Create the comments table
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each comment
    post_id INT NOT NULL,               -- Reference to the post being commented on
    comment TEXT NOT NULL,              -- Text of the comment
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp of when the comment was made
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE -- Delete comments when the post is deleted
);

-- Insert some sample data into posts table (Optional)
INSERT INTO posts (image_path, comment, likes) VALUES
('uploads/sample_image_1.jpg', 'A beautiful view of Tunisia', 10),
('uploads/sample_image_2.jpg', 'Historic monument in Tunis', 5);

-- Insert some sample data into comments table (Optional)
INSERT INTO comments (post_id, comment) VALUES
(1, 'Amazing place!'),
(1, 'I need to visit this place soon!'),
(2, 'Such a beautiful monument!');
