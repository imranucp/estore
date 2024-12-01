<?php
include( '../../connection/connection.php' );

// Fetch the first available user ( this assumes there is a `users` table )
$userQuery = 'SELECT id FROM customers LIMIT 1';
$userResult = mysqli_query( $connection, $userQuery );

if ( !$userResult || mysqli_num_rows( $userResult ) == 0 ) {
    echo "<script>alert('No users found in the database.'); window.location.href='../../index/php/index.php';</script>";
    exit;
}

$user = mysqli_fetch_assoc( $userResult );
$userId = $user[ 'id' ];

// Fetch cart items for the first user
$query = "SELECT cart.id, bicycles.brandName, bicycles.brandCode, cart.quantity, bicycles.image_url 
          FROM cart 
          JOIN bicycles ON cart.product_code = bicycles.brandCode";

$result = mysqli_query( $connection, $query );

if ( !$result ) {
    echo 'Error fetching cart items: ' . mysqli_error( $connection );
    exit;
}
?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Your Cart - Cycle City</title>
<link rel = 'stylesheet' href = '../css/styles.css?v=<?php echo time(); ?>'>
<link rel = 'stylesheet' href = '../../style.css?v=<?php echo time(); ?>'>
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'
integrity = 'sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=='
crossorigin = 'anonymous' referrerpolicy = 'no-referrer' />
</head>
<body>
<main>
<!-- HEADER SECTION -->
<section class = 'header'>
<i class = 'fa-solid fa-bicycle'></i>
<nav>
<a href = '../../index/php/index.php'>
<p>HOME</p>
</a>
<a href = ''>
<p style = 'color: black !important;'>BICYCLE</p>
</a>
<a href = '../../about_us/html/index.html'>
<p>ABOUT US</p>
</a>
<a href = '../../contact_us/html/index.html'>
<p>CONTACT US</p>
</a>
</nav>
<a href = '../../cart/php/index.php'>
<i class = 'fa-solid fa-cart-shopping'></i>
</a>
</section>
<section class = 'cart-section'>
<header>
<h1>Your Cart</h1>
</header>
<div class = 'cart-items'>
<?php while ( $item = mysqli_fetch_assoc( $result ) ): ?>
<div class = 'cart-item'>
<img src = "<?php echo htmlspecialchars($item['image_url']); ?>" alt = "<?php echo htmlspecialchars($item['brandName']); ?>">
<div class = 'item-details'>
<h3><?php echo htmlspecialchars( $item[ 'brandName' ] );
?></h3>
<h4>Brand Code: <?php echo htmlspecialchars( $item[ 'brandCode' ] );
?></h4>
<p>Quantity: <?php echo htmlspecialchars( $item[ 'quantity' ] );
?></p>
</div>
</div>
<?php endwhile;
?>
</div>
<!-- <button class = 'checkout-button' onclick = "window.location.href='../../confirm_order/php/index.php'">Proceed to Checkout</button> -->
<button class = 'back-button' onclick = 'window.history.back()'>Go Back</button>
</section>
<!-- FOOTER SECTION -->
<section class = 'footer'>
<div class = 'left-footer'>
<div class = 'navigaional-links'>
<dl>
<dt><a href = '../../index/php/index.php'>HOME</a></dt>
<dt><a href = '' style = 'color: red !important;'>BICYCLE</a></dt>
<dt><a href = '../../about_us/html/index.html'>ABOUT US</a></dt>
<dt><a href = '../../contact_us/html/index.html'>CONTACT US</a></dt>
</dl>
</div>
</div>
<div class = 'right-footer'>
<p>&copy;
2024 Cycle City. All rights reserved.</p>
</div>
</section>
</main>
</body>
</html>
