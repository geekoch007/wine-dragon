<?php

// Check the session variable for products in cart
// $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
// $products = array();
// $subtotal = 0.00;
// // If there are products in cart
// if ($products_in_cart) {
//     // There are products in the cart so we need to select those products from the database
//     // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
//     $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
//     $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
//     // We only need the array keys, not the values, the keys are the id's of the products
//     $stmt->execute(array_keys($products_in_cart));
//     // Fetch the products from the database and return the result as an Array
//     $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     // Calculate the subtotal
//     foreach ($products as $product) {
//         $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
//     }
// }

unset($_SESSION['cart']);
// webhooks
if (isset($_SESSION['cart'])) {
  // $bot_token = '6187140365:AAENohLqZ1UCDqzXDju3P6lsb6bAY7BIpLA';
  // $chat_id = '2132226096';
  // $name = "kok koko";
  // $email = "kokkoko@gmail.com";
  // $message = "";

  // foreach ($products as $product) {
  //   $message .= "\n id: ".$product['id']."\n Price: ".$product["price"]."\n";
  // }
    

  // $telegram_url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
  // $data = [
  //   'chat_id' => $chat_id,
  //   'text' => "New message from: \nName: {$name} \nEmail: {$email} \nMessage: {$message}",
  // ];

  // $options = [
  //   'http' => [
  //     'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
  //     'method' => 'POST',
  //     'content' => http_build_query($data),
  //   ],
  // ];

  // $context = stream_context_create($options);
  // $result = file_get_contents($telegram_url, false, $context);
}

?>
<?= template_header('Place Order') ?>

<div class="placeorder content-wrapper">
  <h1>Your Order Has Been Placed</h1>
  <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
</div>

<?= template_footer() ?>