
<?php
// Check if the photo in detail.php has been liked by the logged-in user
$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='" . $_GET['id'] . "' AND userid='" . $_SESSION['user_id'] . "'"));

// Get the data sent via URL
$foto_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$tanggal = date('Y-m-d');

if ($cek == 0) {
    // If the logged-in user has not liked this photo, then like it
    $like = mysqli_query($conn, "INSERT INTO likefoto VALUES('', '$foto_id', '$user_id', '$tanggal')");
} else {
    // If the logged-in user has liked this photo, then dislike it
    $dislike = mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$foto_id' AND userid='$user_id'");
}

// Redirect to the detail page
header("Location: ?url=detail&&id=$foto_id");
?>
