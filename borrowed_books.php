<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "book_house");

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verify user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch borrowed books for the user
$sql = "SELECT book_title, borrow_date, return_date FROM borrowed_books WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrowed Books - The Book House</title>
    <link rel="stylesheet" href="catalog.css"> <!-- Reuse catalog.css for consistent styling -->
    <style>
        .borrowed-books-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .borrowed-books-table th, .borrowed-books-table td {
            border: 2px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .borrowed-books-table th {
            background-color: royalblue;
            color: white;
        }
        .borrowed-books-table tr:hover {
            background-color: skyblue;
        }
        .no-books {
            text-align: center;
            color: #333;
            font-size: 1.2em;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <ol class="nav">
        <li><a href="home.html">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="catalog.php">Catalog</a></li>
        <li><a href="borrowed_books.php" class="active">Borrowed Books</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>

    <h1>Your Borrowed Books</h1>
    <h2>View all the books you have borrowed</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="borrowed-books-table">
            <tr>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-books">You have not borrowed any books yet.</p>
    <?php endif; ?>

</body>
</html>
<?php mysqli_close($conn); ?>