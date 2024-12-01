<?php
include( '../../connection/connection.php' );

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {
    $customerQuery = 'SELECT id FROM customers LIMIT 1';
    $customerResult = mysqli_query( $connection, $customerQuery );
    $customer = mysqli_fetch_assoc( $customerResult );

    if ( !$customer ) {
        echo "<script>alert('Customer not found.'); window.location.href='../../index/php/index.php';</script>";
        exit;
    }

    $customerId = $customer[ 'id' ];

    $addressId = mysqli_real_escape_string( $connection, $_POST[ 'address_id' ] );
    echo `<script> alert( $addressId ) </script>`;

    header( 'Location: ../../payment/php/index.php?customer_id = ' . $customerId . '&address_id = ' . $addressId );
    exit;
} else {
    echo 'Invalid request.';
}

$customerQuery = 'SELECT id FROM customers LIMIT 1';
$customerResult = mysqli_query( $connection, $customerQuery );
$customer = mysqli_fetch_assoc( $customerResult );

if ( !$customer ) {
    echo "<script>alert('No customers found.'); window.location.href='../../index/php/index.php';</script>";
    exit;
}

$customerId = $customer[ 'id' ];

$query = "SELECT cart.id, bicycles.brandName, bicycles.brandCode, cart.quantity, bicycles.image_url 
          FROM cart 
          JOIN bicycles ON cart.product_code = bicycles.brandCode 
          WHERE cart.user_id = '$customerId'";

$result = mysqli_query( $connection, $query );

if ( !$result || mysqli_num_rows( $result ) == 0 ) {
    echo "<script>alert('Your cart is empty.'); window.location.href='../../index/php/index.php';</script>";
    exit;
}
$addressQuery = 'SELECT id, streetNumber, streetName, suburb, postCode FROM addresses';
$addressResult = mysqli_query( $connection, $addressQuery );
?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width = device-width, initial-scale = 1.0'>
<title>Confirm Order - Docklands Bike</title>
<link rel = 'stylesheet' href = '../css/styles.css?v = <?php echo time();
    ?>'>
</head>
<body>
<main>
<section class = 'order-section'>
<header>
<h1>Confirm Your Order</h1>
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
<form method = 'POST' action = 'confirm_order.php'>
<h2>Shipping Address</h2>

<label for = 'address_id'>Select Address:</label>
<select id = 'address_id' name = 'address_id' required>
<?php while ( $address = mysqli_fetch_assoc( $addressResult ) ): ?>
<option value = "<?php echo htmlspecialchars($address['id']); ?>">
<?php echo htmlspecialchars( $address[ 'streetNumber' ] . ' ' . $address[ 'streetName' ] . ', ' . $address[ 'suburb' ] . ' - ' . $address[ 'postCode' ] );
?>
</option>
<?php endwhile;
?>
</select>

<button type = 'submit' class = 'confirm-order-button' onclick = 'window.location.href="../../payment/php/index.php"'>Confirm Order</button>
</form>

<button class = 'back-button' onclick = 'window.history.back()'>Go Back</button>
</section>
</main>
</body>
</html>
