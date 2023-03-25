<?php
// Get the number of items in the shopping cart, which will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
date_default_timezone_set("Asia/Phnom_Penh");

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
  // Set the post variables so we easily identify them, also make sure they are integer
  $product_id = (int)$_POST['product_id'];
  $quantity = (int)$_POST['quantity'];
  // Prepare the SQL statement, we basically are checking if the product exists in our databaser
  $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
  $stmt->execute([$_POST['product_id']]);
  // Fetch the product from the database and return the result as an Array
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  // Check if the product exists (array is not empty)
  if ($product && $quantity > 0) {
    // Product exists in database, now we can create/update the session variable for the cart
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
      if (array_key_exists($product_id, $_SESSION['cart'])) {
        // Product exists in cart so just update the quanity
        $_SESSION['cart'][$product_id] += $quantity;
      } else {
        // Product is not in cart so add it
        $_SESSION['cart'][$product_id] = $quantity;
      }
    } else {
      // There are no products in cart, this will add the first product to cart
      $_SESSION['cart'] = array($product_id => $quantity);
    }
  }
  // Prevent form resubmission...
  header('location: index.php?page=cart');
  exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
  // Remove the product from the shopping cart
  unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
  // Loop through the post data so we can update the quantities for every product in cart
  foreach ($_POST as $k => $v) {
    if (strpos($k, 'quantity') !== false && is_numeric($v)) {
      $id = str_replace('quantity-', '', $k);
      $quantity = (int)$v;
      // Always do checks and validation
      if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
        // Update new quantity
        $_SESSION['cart'][$id] = $quantity;
      }
    }
  }
  // Prevent form resubmission...
  header('location: index.php?page=cart');
  exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
  // There are products in the cart so we need to select those products from the database
  // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
  $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
  $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
  // We only need the array keys, not the values, the keys are the id's of the products
  $stmt->execute(array_keys($products_in_cart));
  // Fetch the products from the database and return the result as an Array
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // Calculate the subtotal
  foreach ($products as $product) {
    $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
  }
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  // webhooks
  $bot_token = '6187140365:AAENohL-x-x-x-x-x';
  $chat_id = '213-x-x-x';

  $id = "ClientID";
  $name = "ClientName";
  $phone = "";
  $acc_telegram = "";
  $email = "";
  $location = "";
  $date = date('m/d/Y h:i:s a', time());
  $orders = "";

  if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
  }
  if (isset($_POST["telegram"])) {
    $acc_telegram = $_POST["telegram"];
  }
  if (isset($_POST["email"])) {
    $email = $_POST["email"];
  }
  if (isset($_POST["location"])) {
    $location = $_POST["location"];
  }

  foreach ($products as $product) {
    $orders .= "\n=> ID: " . $product['id'] .
      "\n\t - Product: " . $product["name"] .
      "\n\t - Price: $" . $product["price"] .
      "\n\t - Quality: " . $products_in_cart[$product['id']] .
      "\n";
  }

  $telegram_url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
  $data = [
    'chat_id' => $chat_id,
    'text' => "* New message order {$num_items_in_cart} products: " .
      "\nProduct Orders: {$orders}" .
      "\nClientID: {$id}" .
      "\nName: {$name}" .
      "\nPhone: {$phone}" .
      "\nTelegram: {$acc_telegram}" .
      "\nEmail: {$email}" .
      "\nLocation: {$location}" .
      "\nDate: {$date}" .
      "\n\n* Subtotal: $" . $subtotal,
  ];

  $options = [
    'http' => [
      'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data),
    ],
  ];

  $context = stream_context_create($options);
  $result = file_get_contents($telegram_url, false, $context);

  header('Location: index.php?page=placeorder');
  exit;
}

?>


<?= template_header('Cart') ?>

<div class="cart content-wrapper">
  <h1>Shopping Cart</h1>
  <form action="index.php?page=cart" method="post">
    <table>
      <thead>
        <tr>
          <td colspan="2">Product</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Total</td>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($products)) : ?>
          <tr>
            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
          </tr>
        <?php else : ?>
          <?php foreach ($products as $product) : ?>
            <tr>
              <td class="img">
                <a href="index.php?page=product&id=<?= $product['id'] ?>">
                  <img src="imgs/<?= $product['img'] ?>" width="50" height="50" alt="<?= $product['name'] ?>">
                </a>
              </td>
              <td>
                <a href="index.php?page=product&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                <br>
                <a href="index.php?page=cart&remove=<?= $product['id'] ?>" class="remove">Remove</a>
              </td>
              <td class="price">&dollar;<?= $product['price'] ?></td>
              <td class="quantity">
                <input type="number" name="quantity-<?= $product['id'] ?>" value="<?= $products_in_cart[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
              </td>
              <td class="price">&dollar;<?= $product['price'] * $products_in_cart[$product['id']] ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <div class="subtotal">
      <span class="text">Subtotal</span>
      <span class="price">&dollar;<?= $subtotal ?></span>
    </div>
    <div class="contact" style="display: block; margin-bottom: 2rem;">
      <div class="row" style="display: flex; flex-flow: row wrap; gap: 2rem; margin-bottom: 1rem;">
        <div class="col-4" style="flex: 1 250px;">
          <label for="phone" style="width: 100%;">Phone</label><br />
          <input type="text" id="phone" name="phone" style="width: 100%; padding: 0.5rem 0.75rem; margin-top: 0.5rem;" placeholder="Enter your phone number" required />
        </div>
        <div class="col-4" style="flex: 1 250px;">
          <label for="telegram">Telegram</label><br />
          <input type="text" id="telegram" name="telegram" style="width: 100%; padding: 0.5rem 0.75rem; margin-top: 0.5rem;" placeholder="Enter your telegram account" required />
        </div>
        <div class="col-4" style="flex: 1 250px;">
          <label for="email">Email</label><br />
          <input type="email" id="email" name="email" style="width: 100%; padding: 0.5rem 0.75rem; margin-top: 0.5rem;" placeholder="Enter your email address" required />
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <label for="location">Location</label><br />
          <textarea id="location" name="location" rows="5" cols="45" style="width: 100%; padding: 0.5rem 0.75rem; margin-top: 0.5rem;" placeholder="Enter your location"></textarea>
        </div>
      </div>
    </div>
    <div class="buttons">
      <input type="submit" value="Update" name="update">
      <input type="submit" value="Place Order" name="placeorder">
    </div>
  </form>
</div>

<?= template_footer() ?>