<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Threadline Shop</title>
  
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #ffffff;
    padding: 20px 40px;
    border-bottom: 1px solid #eaeaea;
}
.navbar .logo {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #000;
}
.navbar .nav-group {
    display: flex;
    gap: 20px;
}
.navbar button, .navbar input[type="text"] {
    background: none;
    border: none;
    font-size: 14px;
    color: #000;
    padding: 8px 12px;
    font-weight: 500;
}
.navbar input[type="text"] {
    background-color: #eaeaea;
    border-radius: 4px;
}
.navbar button:hover, .navbar .logo:hover {
    text-decoration: underline;
    cursor: pointer;
}
.section {
    padding: 40px;
    background-color: #fff;
    color: #000;
}
.grid {
    display: grid;
    gap: 30px;
}
.main-grid {
    grid-template-columns: repeat(2, 1fr);
}
.product-grid {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}
.product-card {
    background-color: #fafafa;
    padding: 30px;
    border-radius: 8px;
    border: 1px solid #eaeaea;
    text-align: center;
}
.profile-section, .cart-section, .order-section {
    background-color: #fafafa;
    padding: 30px;
    border-radius: 8px;
    border: 1px solid #eaeaea;
    margin-bottom: 30px;
}
.btn {
    background-color: #000;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color: #333;
}
</style>

</head>
<body>
<?php
session_start();

$products = [
  1 => ['name' => 'Denim Jacket', 'price' => 1299, 'category' => 'adults'],
  2 => ['name' => 'Basic Tee', 'price' => 499, 'category' => 'teens'],
  3 => ['name' => 'Sweatpants', 'price' => 899, 'category' => 'kids'],
  4 => ['name' => 'Chino Shorts', 'price' => 899, 'category' => 'adults'],
  5 => ['name' => 'Graphic Hoodie', 'price' => 1099, 'category' => 'teens'],
  6 => ['name' => 'Kids Polo Shirt', 'price' => 799, 'category' => 'kids'],
  7 => ['name' => 'Adult Tank Top', 'price' => 599, 'category' => 'adults'],
  8 => ['name' => 'Teen Shorts', 'price' => 699, 'category' => 'teens'],
  9 => ['name' => 'Kids Cargo Shorts', 'price' => 699, 'category' => 'kids'],
 10 => ['name' => 'Adult Blazer', 'price' => 1799, 'category' => 'adults'],
 11 => ['name' => 'Adult Long Sleeve Shirt', 'price' => 899, 'category' => 'adults'],
 12 => ['name' => 'Adult Joggers', 'price' => 999, 'category' => 'adults'],
 13 => ['name' => 'Teen Denim Skirt', 'price' => 849, 'category' => 'teens'],
 14 => ['name' => 'Teen Varsity Jacket', 'price' => 1299, 'category' => 'teens'],
 15 => ['name' => 'Teen Turtleneck', 'price' => 749, 'category' => 'teens'],
 16 => ['name' => 'Kids Tracksuit', 'price' => 999, 'category' => 'kids'],
 17 => ['name' => 'Kids T-shirt Pack', 'price' => 699, 'category' => 'kids'],
 18 => ['name' => 'Kids Dress', 'price' => 899, 'category' => 'kids']
];

if (isset($_GET['logout'])) {
  session_unset(); session_destroy(); header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); exit;
}
if (isset($_POST['register'])) {
  $_SESSION['user'] = [
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'email' => '',
    'address' => ''
  ];
}
if (isset($_POST['login'])) {
  if ($_POST['username'] == $_SESSION['user']['username'] && $_POST['password'] == $_SESSION['user']['password']) {
    $_SESSION['logged_in'] = true;
  } else {
    echo "<div class='section'><div class='message error'>❌ Login failed.</div></div>";
  }
}
if (isset($_POST['update_profile'])) {
  $_SESSION['user']['email'] = $_POST['email'];
  $_SESSION['user']['address'] = $_POST['address'];
}
if (isset($_POST['add_to_cart'])) {
  $id = $_POST['product_id'];
  $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}
if (isset($_POST['update_qty'])) {
  $_SESSION['cart'][$_POST['product_id']] = $_POST['quantity'];
}
if (isset($_POST['remove_item'])) {
  unset($_SESSION['cart'][$_POST['product_id']]);
}
if (isset($_POST['place_order'])) {
  $_SESSION['orders'][] = [
    'items' => $_SESSION['cart'],
    'status' => 'Processing',
    'placed_at' => date('Y-m-d H:i:s')
  ];
  unset($_SESSION['cart']);
}
if (isset($_POST['refund'])) {
  $_SESSION['orders'][0]['status'] = 'Refunded';
}

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$page = $_GET['page'] ?? 'main';
$filtered = [];
foreach ($products as $id => $product) {
  $matchesSearch = $search === '' || stripos($product['name'], $search) !== false;
  $matchesCategory = $category === '' || $product['category'] === $category;
  if ($matchesSearch && $matchesCategory) {
    $filtered[$id] = $product;
  }
}
?>

<div class="navbar">
  <div class="nav-group">
    <?php if (!empty($_SESSION['logged_in'])): ?>
      <button onclick="location.href='?category=adults'">ADULTS</button>
      <button onclick="location.href='?category=teens'">TEENS</button>
      <button onclick="location.href='?category=kids'">KIDS</button>
    <?php endif; ?>
  </div>
  <div class="logo" onclick="location.href='?'">THREADLINE</div>
  <div class="nav-group">
    <?php if (!empty($_SESSION['logged_in'])): ?>
      <form method="get" style="display:inline;">
        <input type="text" name="search" placeholder="SEARCH" value="<?= htmlspecialchars($search) ?>">
        <?php if ($category): ?><input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>"><?php endif; ?>
      </form>
      <button onclick="location.href='?page=cart'">🛍️</button>
      <button onclick="location.href='?page=account'">👤</button>
    <?php endif; ?>
  </div>
</div>

<div class="section">
<?php if (empty($_SESSION['logged_in'])): ?>
  <h1>Welcome to THREADLINE</h1>
  <form method="post"><button name="show_register" class="btn">Sign Up</button></form>
  <form method="post"><button name="show_login" class="btn">Sign In</button></form>
<?php elseif ($page == 'account'): ?>
  <div class="profile-section">
    <h2>Profile</h2>
    <p>Hello, <?= $_SESSION['user']['username'] ?> | <a href="?logout=true">Logout</a></p>
    <form method="post">
      <label>Email:</label><br><input name="email" value="<?= $_SESSION['user']['email'] ?>"><br>
      <label>Address:</label><br><input name="address" value="<?= $_SESSION['user']['address'] ?>"><br>
      <button name="update_profile" class="btn">Update</button>
    </form>
  </div>
<?php elseif ($page == 'cart'): ?>
  <div class="cart-section">
    <h2>Shopping Bag</h2>
    <?php if (!empty($_SESSION['cart'])): foreach ($_SESSION['cart'] as $id => $qty): ?>
      <div class="product-card">
        <form method="post">
          <?= $products[$id]['name'] ?> – ₱<?= number_format($products[$id]['price'], 2) ?> ×
          <input type="number" name="quantity" value="<?= $qty ?>" min="1">
          <input type="hidden" name="product_id" value="<?= $id ?>">
          <button name="update_qty" class="btn">Update</button>
          <button name="remove_item" class="btn">Remove</button>
        </form>
      </div>
    <?php endforeach; ?>
      <form method="post"><button name="place_order" class="btn">Place Order</button></form>
    <?php else: ?>
      <p>Your cart is empty.</p>
    <?php endif; ?>
  </div>
<?php else: ?>
  <div class="product-grid grid">
    <?php foreach ($filtered as $id => $p): ?>
      <div class="product-card">
        <strong><?= $p['name'] ?></strong><br>
        ₱<?= number_format($p['price'], 2) ?><br>
        <span><?= ucfirst($p['category']) ?></span>
        <form method="post">
          <input type="hidden" name="product_id" value="<?= $id ?>">
          <button name="add_to_cart" class="btn">Add to Cart</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="order-section">
    <h2>Order History</h2>
    <?php
      if (!empty($_SESSION['orders'])):
        $sorted_orders = $_SESSION['orders'];
        foreach ($sorted_orders as &$order) {
          if (!isset($order['placed_at'])) $order['placed_at'] = '1970-01-01 00:00:00';
          if (!isset($order['items']) || !is_array($order['items'])) $order['items'] = [];
        }
        unset($order);
        usort($sorted_orders, fn($a, $b) => strtotime($b['placed_at']) - strtotime($a['placed_at']));
        foreach ($sorted_orders as $index => $order):
    ?>
      <div class="product-card">
        <p><strong>Order <?= $index + 1 ?></strong> (<?= $order['status'] ?>) – Placed on <?= $order['placed_at'] ?> </p>
        <ul>
          <?php foreach ($order['items'] as $id => $qty): ?>
            <li><?= $products[$id]['name'] ?> × <?= $qty ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
      <form method="post"><button name="refund" class="btn">Request Refund</button></form>
    <?php else: ?>
      <p>No orders yet.</p>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php if (isset($_POST['show_register'])): ?>
  <div class="section">
    <h2>User Registration</h2>
    <form method="post">
      <label>Username:</label><br>
      <input type="text" name="username" required><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br>
      <button name="register" class="btn">Register</button>
    </form>
  </div>
<?php endif; ?>

<?php if (isset($_POST['show_login'])): ?>
  <div class="section">
    <h2>User Login</h2>
    <form method="post">
      <label>Username:</label><br>
      <input type="text" name="username" required><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br>
      <button name="login" class="btn">Login</button>
    </form>
  </div>
<?php endif; ?>

</div>
</body>
</html>