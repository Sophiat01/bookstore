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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrow_book'])) {
    $user_id = $_SESSION['user_id'];
    $book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
    $borrow_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+14 days'));
    
    // Check if book is already borrowed
    $check_borrowed = "SELECT * FROM borrowed_books WHERE user_id = '$user_id' AND book_title = '$book_title'";
    $result = mysqli_query($conn, $check_borrowed);
    if (mysqli_num_rows($result) > 0) {
        $error_message = "You have already borrowed '$book_title'!";
    } else {
        // Verify user exists and borrow book
        $check_user = "SELECT id FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $check_user);
        if (mysqli_num_rows($result) > 0) {
            $sql = "INSERT INTO borrowed_books (user_id, book_title, borrow_date, return_date) 
                    VALUES ('$user_id', '$book_title', '$borrow_date', '$return_date')";
            if (mysqli_query($conn, $sql)) {
                $success_message = "Book '$book_title' borrowed successfully!";
            } else {
                $error_message = "Error borrowing book: " . mysqli_error($conn);
            }
        } else {
            $error_message = "User not found in database";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog - The Book House</title>
    <link rel="stylesheet" href="catalog.css">
</head>
<body>
    <ol class="nav">
        <li><a href="home.html">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="catalog.php" class="active">Catalog</a></li>
        <li><a href="borrowed_books.php">Borrowed Books</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>

    <h1>Book Catalog</h1>

    <?php 
    if (isset($success_message)) {
        echo "<div class='success'>$success_message</div>";
    }
    if (isset($error_message)) {
        echo "<div class='error'>$error_message</div>";
    }
    ?>

    <h2>Check out our books</h2>

    <h3>Romance</h3>
    <div class="book-gallery">
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.rIdDuPS_AUxGoEAYANKMUwHaJ4?rs=1&pid=ImgDetMain" alt="Whispers of the Heart">
            <h4>Whispers of the Heart</h4>
            <p>A tender tale of love that transcends time and distance.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Whispers of the Heart">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.yleswZeQOuMncNQ2TmwSSAAAAA?rs=1&pid=ImgDetMain" alt="A Pho Love Story">
            <h4>A Pho Love Story</h4>
            <p>A delightful romance simmering with cultural flavor.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="A Pho Love Story">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://m.media-amazon.com/images/I/81W0-73NN3L._UF1000,1000_QL80_.jpg" alt="Dinner for Two">
            <h4>Dinner for Two</h4>
            <p>A cozy love story served with a side of culinary charm.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Dinner for Two">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
    </div>

    <h3>Mystery</h3>
    <div class="book-gallery">
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.aYYB-G_sDf_pGu9FAMaxkAAAAA?rs=1&pid=ImgDetMain" alt="The Girl Who Lived">
            <h4>The Girl Who Lived</h4>
            <p>A gripping mystery unraveling secrets of survival.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="The Girl Who Lived">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI51QE0AMo-90yfsKO6kJfMM_4kQTiNtGTDw&s" alt="Murder by the Book">
            <h4>Murder by the Book</h4>
            <p>A literary whodunit with twists at every page.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Murder by the Book">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://m.media-amazon.com/images/I/81fVk7DBv4L.SL1500.jpg" alt="The Whistler">
            <h4>The Whistler</h4>
            <p>A legal thriller exposing corruption and danger.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="The Whistler">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
    </div>

    <h3>Horror</h3>
    <div class="book-gallery">
        <div class="book">
            <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1613762199i/57129618.jpg" alt="Hanging House">
            <h4>Hanging House</h4>
            <p>A chilling tale of a house with a dark past.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Hanging House">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://th.bing.com/th/id/R.fe835d59173ca61ade035c2a00b88999?rik=tohg69kcnPWqWg&pid=ImgRaw&r=0" alt="Those Eyes">
            <h4>Those Eyes</h4>
            <p>A haunting story that stares into your soul.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Those Eyes">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://th.bing.com/th/id/R.268708db6458aa96b51388c7273779a8?rik=8UBSbQhPX2ZYPA&pid=ImgRaw&r=0" alt="The Haunting of Hill House">
            <h4>The Haunting of Hill House</h4>
            <p>A classic horror of a house alive with terror.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="The Haunting of Hill House">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
    </div>

    <h3>Non-fiction</h3>
    <div class="book-gallery">
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.2NvDOEtdhPVz3in0ECRpUgHaJ4?w=1500&h=2000&rs=1&pid=ImgDetMain" alt="How Far the Light Reaches">
            <h4>How Far the Light Reaches</h4>
            <p>A deep dive into the wonders of nature and life.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="How Far the Light Reaches">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.FlrXdM2bl6dRfTO3BCXjpwHaLQ?rs=1&pid=ImgDetMain" alt="An Immense World">
            <h4>An Immense World</h4>
            <p>An exploration of animal senses and perception.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="An Immense World">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQf_UP3d-zyVnVbXVfkPDQ4a9LhKqKsO6_Gmg&s" alt="The Escape Artist">
            <h4>The Escape Artist</h4>
            <p>A true story of courage and survival in WWII.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="The Escape Artist">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
    </div>

    <h3>Fantasy</h3>
    <div class="book-gallery">
        <div class="book">
            <img src="https://th.bing.com/th/id/OIP.ZykD_Ibmt9yAFr1dzFO_XgHaJ4?rs=1&pid=ImgDetMain" alt="Realm of Ruins">
            <h4>Realm of Ruins</h4>
            <p>A fantastical journey through a shattered kingdom.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Realm of Ruins">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSOK3mD_Gdnh3EMe6DAqG5NPjRYRkcNVtrCQ&s" alt="Call of the Sirens">
            <h4>Call of the Sirens</h4>
            <p>A mythical adventure with enchanting creatures.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Call of the Sirens">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
        <div class="book">
            <img src="https://th.bing.com/th/id/R.6c6e7a6d159f044f998997b94a186c83?rik=PRdmYdnjFagqAQ&pid=ImgRaw&r=0" alt="Magic and Mayhem">
            <h4>Magic and Mayhem</h4>
            <p>A wild ride of spells and chaos in a magical world.</p>
            <form action="catalog.php" method="POST">
                <input type="hidden" name="book_title" value="Magic and Mayhem">
                <input type="submit" name="borrow_book" value="Borrow">
            </form>
        </div>
    </div>

    <h3>Feedback</h3>
    <p>We value your feedback! Please tell us about your experience with The Book House.</p>
    <div class="feedback-form">
        <form action="#" method="post">
            <label for="rating">Overall Satisfaction:</label>
            <select id="rating" name="rating">
                <option value="5">Excellent</option>
                <option value="4">Good</option>
                <option value="3">Average</option>
                <option value="2">Fair</option>
                <option value="1">Poor</option>
            </select>
            <label for="favbook">Favorite Book (Optional):</label>
            <input type="text" id="favbook" name="favbook">
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4" cols="50"></textarea>
            <input type="submit" value="Submit Feedback">
        </form>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>