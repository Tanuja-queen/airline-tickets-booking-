<?php
$password = 'admin123'; // The password entered by the user
$hashed_password = '$2y$10$9vHh1TG/.9C4VShA7D7y2OEY0bOl8OWmgq/UszE9y7l9k0QXqe.K.'; // The password from the database

if (password_verify($password, $hashed_password)) {
    echo "Password is correct!";
} else {
    echo "Invalid password!";
}
?>
