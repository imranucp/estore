<?php
include( '../../connection/connection.php' );

$query = "SELECT bicycles.brandCode, bicycles.brandName, bicycles.quantity, suppliers.name AS supplierName, bicycles.image_url 
          FROM bicycles 
          JOIN suppliers ON bicycles.supplierId = suppliers.id
          LIMIT 3";
// Limit the results to 3 records

$result = mysqli_query( $connection, $query );
if ( !$result ) {
    echo 'Error fetching bicycles: ' . mysqli_error( $connection );
    exit;
}
?>

<!DOCTYPE html>
<html lang = 'en'>

<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Cycle City</title>
<link rel = 'stylesheet' href = '../css/index.css'>
<link rel = 'stylesheet' href = '../../style.css'>
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'
integrity = 'sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=='
crossorigin = 'anonymous' referrerpolicy = 'no-referrer' />
</head>

<body>
<main>
<!-- HERO SECTION -->
<section class = 'hero'>
<div class = 'overlay'>
<header class = 'header'>
<i class = 'fa-solid fa-bicycle'></i>
<nav>
<a href = './index.html'>
<p style = 'color: red !important;'>HOME</p>
</a>
<a href = '../../product/php/index.php'>
<p>BICYCLE</p>
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
</header>
<div class = 'left-title-bar'>
<div class = 'left-title-bar-content'>
<h3>Newly Launched</h3>
<h1>KYRO X26</h1>
<h1>MTB</h1>
<p>Specifications</p>
<ul>
<li>Lightweight 18 Frame</li>
<li>Steel Suspension Fork</li>
<li>Steel Hardtail Frame</li>
</ul>
<button class = 'hero-btn'><a href = ''>BUY</a></button>
</div>
</div>
</div>
</section>

<!-- NEW ARRIVAL SECTION -->
<section class = 'new-arrival'>
<header>NEW ARRIVALS</header>
<div class = 'new-arrival-content'>
<?php
// Loop through the bicycles data and display each one
while ( $row = mysqli_fetch_assoc( $result ) ) {
    ?>
    <article>
    <img src = "<?php echo $row['image_url']; ?>" alt = "<?php echo $row['brandName']; ?> Image">
    <h3><?php echo $row[ 'brandName' ];
    ?></h3>
    <h4>Brand Code: <?php echo $row[ 'brandCode' ];
    ?></h4>
    <p>Quantity: <?php echo $row[ 'quantity' ];
    ?></p>
    <p>Supplier: <?php echo $row[ 'supplierName' ];
    ?></p>
    </article>
    <?php
}
?>
</div>
</section>

<!-- FOOTER SECTION -->
<section class = 'footer'>
<div class = 'left-footer'>
<div class = 'navigaional-links'>
<dl>
<dt><a href = '' style = 'color: red !important;'>HOME</a></dt>
<dt><a href = '../../product/php/index.php'>BICYCLE</a></dt>
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
