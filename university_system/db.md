CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('student', 'guide', 'admin') NOT NULL
);

CREATE TABLE student_group (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    guide_id INT,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (guide_id) REFERENCES users(user_id)
);

CREATE TABLE project_links (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT,
    link VARCHAR(255) NOT NULL,
    submission_date DATE,
    FOREIGN KEY (group_id) REFERENCES student_group(group_id)
);

CREATE TABLE marks (
    mark_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    guide_id INT,
    mark INT NOT NULL,
    date DATE,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (guide_id) REFERENCES users(user_id)
);

CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    guide_id INT,
    date DATE,
    status ENUM('present', 'absent') NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (guide_id) REFERENCES users(user_id)
);

CREATE TABLE remarks (
    remark_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    guide_id INT,
    remark TEXT NOT NULL,
    date DATE,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (guide_id) REFERENCES users(user_id)
);

CREATE TABLE ratings (
    rating_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    guide_id INT,
    rating INT NOT NULL,
    date DATE,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (guide_id) REFERENCES users(user_id)
);