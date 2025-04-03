<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "book_house");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['usermail']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['userpass'], PASSWORD_DEFAULT);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $user_type = mysqli_real_escape_string($conn, $_POST['userType']);

    $sql = "INSERT INTO users (firstname, lastname, age, gender, email, username, password, genre, user_type) 
            VALUES ('$firstname', '$lastname', '$age', '$gender', '$email', '$username', '$password', '$genre', '$user_type')";

    
if (mysqli_query($conn, $sql)) {
    $_SESSION['success'] = "Registration successful! Please login.";
    header("Location: login.html");
    exit();
  }

}
mysqli_close($conn);
?>