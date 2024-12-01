<?php
include('../../connection/connection.php');

$customerId = $_GET['customerId'] ?? '';
$addressId = $_GET['addressId'] ?? '';

if (empty($customerId) || empty($addressId)) {
    echo "<script>alert('Invalid order information.'); window.location.href='../../index/php/index.php';</script>";
    exit;
}
$customerQuery = "SELECT * FROM customers WHERE id = '$customerId'";
$customerResult = mysqli_query($connection, $customerQuery);
$customer = mysqli_fetch_assoc($customerResult);

if (!$customer) {
    echo "<script>alert('Customer not found.'); window.location.href='../../index/php/index.php';</script>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = htmlspecialchars($_POST['payment_method']);
    $cardNumber = htmlspecialchars($_POST['card_number']);
    $paymentAmount = htmlspecialchars($_POST['payment_amount']);
    $paymentDate = date('Y-m-d');

    $paymentQuery = "INSERT INTO payments (customer_id, payment_method, card_number, payment_amount, payment_date) 
                     VALUES ('$customerId', '$paymentMethod', '$cardNumber', '$paymentAmount', '$paymentDate')";

    if (mysqli_query($connection, $paymentQuery)) {
        $paymentId = mysqli_insert_id($connection);
        $receiptQuery = "INSERT INTO receipts (payment_id, payment_amount, receipt_date) 
                         VALUES ('$paymentId', '$paymentAmount', '$paymentDate')";

        mysqli_query($connection, $receiptQuery);

        echo "<script>alert('Payment successful!'); window.location.href='../../index/php/index.php';</script>";
    } else {
        echo "<script>alert('Error processing payment: " . mysqli_error($connection) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Payment Method - Docklands Bike</title>
    <link rel='stylesheet' href='../css/styles.css?v=<?php echo time(); ?>'>
</head>
<body>
<main>
    <section class='payment-section'>
        <header>
            <h1>Select Payment Method</h1>
        </header>
        
        <form method='POST' action=''>
            <label for='payment_method'>Payment Method:</label>
            <select id='payment_method' name='payment_method' required>
                <option value='debit'>Debit Card</option>
                <option value='credit'>Credit Card</option>
            </select>

            <label for='card_number'>Card Number:</label>
            <input type='text' id='card_number' name='card_number' required>

            <label for='payment_amount'>Payment Amount:</label>
            <input type='text' id='payment_amount' name='payment_amount' value='<?php echo htmlspecialchars($totalAmount); ?>' readonly>

            <button type='submit' class='confirm-payment-button'>Confirm Payment</button>
        </form>

        <button class='back-button' onclick='window.history.back()'>Go Back</button>
    </section>
</main>
</body>
</html>
