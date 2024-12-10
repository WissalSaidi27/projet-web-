-- Create the database
CREATE DATABASE IF NOT EXISTS monument_site;

-- Use the database
USE monument_site;
ALTER TABLE posts ADD INDEX (id);
ALTER TABLE comments ADD INDEX (post_id);

-- Create the posts table
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    comment TEXT,
    likes INT DEFAULT 0,
    is_hidden BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
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
