<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "book_house");
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/";
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is an actual image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if($check === false) {
        $error = "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size (5MB limit)
    if ($_FILES["profile_picture"]["size"] > 5000000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET profile_picture = '$target_file' WHERE id = $user_id";
            mysqli_query($conn, $sql);
            $success = "Profile picture uploaded successfully!";
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = $user_id";
    mysqli_query($conn, $sql);
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" href="registration.css">
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <ol class="nav">
        <li><a href="home.html">Home</a></li>
        <li><a href="catalog.php">Catalog</a></li>
        <li><a href="profile.php" class="active">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>
    
    <h1>User Profile</h1>
    
    <div class="registration-form">
        <?php 
        if(isset($error)) echo "<p class='error'>$error</p>";
        if(isset($success)) echo "<p class='success'>$success</p>";
        ?>
        
        <img src="<?php echo $user['profile_picture']; ?>" width="150" alt="Profile Picture">
        
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <label>Upload Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">
            <input type="submit" value="Upload">
        </form>
        
        <form action="profile.php" method="POST">
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" required>
            <br><br>
            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required>
            <br><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <br><br>
            <input type="hidden" name="update_profile" value="1">
            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>