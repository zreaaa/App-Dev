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
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #4a4242ff;
  color: #222;
  line-height: 1.6;
}

/* Navbar */
.navbar {
  background-color: #2d2d2d;
  color: #fff;
  padding: 40px 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  min-height: 100px;
}

.navbar .logo {
  font-size: 36px;
  font-weight: 800;
  letter-spacing: 3px;
  color: #f4a261;
  cursor: pointer;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

.navbar .nav-group {
  display: flex;
  align-items: center;
  gap: 10px;
}

.navbar .nav-group:first-child {
  position: absolute;
  left: 40px;
}

.navbar .nav-group:last-child {
  position: absolute;
  right: 40px;
}

.navbar input[type="text"] {
  width: 120px;
  padding: 6px 10px;
  border-radius: 6px;
  transition: width 0.3s ease;
  background-color: #fff;
  border: none;
  font-weight: 500;
}

.navbar input[type="text"]:focus {
  width: 200px;
  background-color: #f4a261;
  color: #fff;
}

/* Sections */
.section {
  padding: 40px;
  background-color: #fff;
  margin: 20px auto;
  max-width: 1000px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

/* Product Grid */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}
.product-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  text-align: center;
}
.product-card img {
  max-width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
}
.product-card strong {
  display: block;
  margin: 10px 0 5px;
  font-size: 18px;
  color: #2d2d2d;
}

/* Buttons */
.btn, .product-card button {
  background-color: #2d2d2d;
  color: #fff;
  padding: 10px 20px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s ease;
}
.btn:hover,
.product-card button:hover {
  background-color: #f4a261;
  color: #fff;
}

/* Forms */
input[type="text"], input[type="password"], input[type="email"], input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-top: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Profile/Admin Styles */
.profile-card, .profile-form, .cart-section, .order-section {
  background-color: #fff;
  padding: 25px;
  border-radius: 10px;
  margin-bottom: 30px;
  box-shadow: 0 1px 6px rgba(0,0,0,0.08);
}

.avatar {
  font-size: 64px;
  color: #aaa;
}
/* General Button Style */
.btn,
.navbar button,
.product-card button {
  background-color: #4a4a4a; /* lighter than navbar */
  color: #fff;
  padding: 10px 18px;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

/* Hover Style */
.btn:hover,
.navbar button:hover,
.product-card button:hover {
  background-color: #f4a261;
  color: #fff;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Admin delete button */
button[style*="background:red"] {
  background-color: #e63946 !important;
}
button[style*="background:red"]:hover {
  background-color: #c62828 !important;
}

/* Admin update (green) */
button[style*="background:green"] {
  background-color: #2a9d8f !important;
}
button[style*="background:green"]:hover {
  background-color: #21867a !important;
}

.registration-success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px 20px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    margin: 20px auto;
    width: fit-content;
    font-weight: bold;
    text-align: center;
}


</style>

</head>
<body>
<?php
session_start();
include 'threadlinedb.php';



$products = [
  1 => ['name' => 'Denim Jacket', 'price' => 1299, 'category' => 'adults', 'image' => 'threadlinejpg/denimjacket.jpg'],
  2 => ['name' => 'Basic Tee', 'price' => 499, 'category' => 'teens', 'image' => 'threadlinejpg/basictee.jpg'],
  3 => ['name' => 'Sweatpants', 'price' => 899, 'category' => 'kids', 'image' => 'threadlinejpg/sweatpants.jpg'],
  4 => ['name' => 'Chino Shorts', 'price' => 899, 'category' => 'adults', 'image' => 'threadlinejpg/chinoshorts.jpg'],
  5 => ['name' => 'Graphic Hoodie', 'price' => 1099, 'category' => 'teens', 'image' => 'threadlinejpg/graphichoodie.jpg'],
  6 => ['name' => 'Kids Polo Shirt', 'price' => 799, 'category' => 'kids', 'image' => 'threadlinejpg/kidspoloshirt.jpg'],
  7 => ['name' => 'Adult Tank Top', 'price' => 599, 'category' => 'adults', 'image' => 'threadlinejpg/adulttanktop.jpg'],
  8 => ['name' => 'Teen Shorts', 'price' => 699, 'category' => 'teens', 'image' => 'threadlinejpg/teenshorts.jpg'],
  9 => ['name' => 'Kids Cargo Shorts', 'price' => 699, 'category' => 'kids', 'image' => 'threadlinejpg/kidscargoshort.jpg'],
  10 => ['name' => 'Adult Blazer', 'price' => 1799, 'category' => 'adults', 'image' => 'threadlinejpg/adultblazer.jpg'],
  11 => ['name' => 'Adult Long Sleeve Shirt', 'price' => 899, 'category' => 'adults', 'image' => 'threadlinejpg/adultlongsleeveshirt.jpg'],
  12 => ['name' => 'Adult Joggers', 'price' => 999, 'category' => 'adults', 'image' => 'threadlinejpg/adultjoggers.jpg'],
  13 => ['name' => 'Teen Denim Skirt', 'price' => 849, 'category' => 'teens', 'image' => 'threadlinejpg/teendenimskirt.jpg'],
  14 => ['name' => 'Teen Varsity Jacket', 'price' => 1299, 'category' => 'teens', 'image' => 'threadlinejpg/teenvarsityjacket.jpg'],
  15 => ['name' => 'Teen Turtleneck', 'price' => 749, 'category' => 'teens', 'image' => 'threadlinejpg/teenturtleneck.jpg'],
  16 => ['name' => 'Kids Tracksuit', 'price' => 999, 'category' => 'kids', 'image' => 'threadlinejpg/kidstracksuit.jpg'],
  17 => ['name' => 'Kids T-shirt Pack', 'price' => 699, 'category' => 'kids', 'image' => 'threadlinejpg/kidstshirtpack.jpg'],
  18 => ['name' => 'Kids Dress', 'price' => 899, 'category' => 'kids', 'image' => 'threadlinejpg/kidsdress.jpg']
];


if (isset($_GET['logout'])) {
  session_unset(); session_destroy(); header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); exit;
}
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "<div class='registration-success'>✅ User has been registered!</div>";
    } else {
        echo "<div class='registration-success' style='background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;'>❌ Registration failed: " . $stmt->error . "</div>";
    }
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = 
            ['username' => $username,'email' => '','address' => '','role' => $role];
        } else {
            echo "<div class='section'><div class='message error'>❌ Incorrect password.</div></div>";
        }
    } else {
        echo "<div class='section'><div class='message error'>❌ Username not found.</div></div>";
    }
}

if (isset($_POST['update_profile'])) {
  $_SESSION['user']['email'] = $_POST['email'];
  $_SESSION['user']['address'] = $_POST['address'];
}
if (isset($_POST['change_password'])) {
  $username = $_SESSION['user']['username'];
  $currentPassword = $_POST['current_password'];
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($newPassword !== $confirmPassword) {
    echo "<div class='section'><p>❌ New passwords do not match.</p></div>";
  } else {
    // Get current hashed password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($currentPassword, $hashed)) {
      echo "<div class='section'><p>❌ Current password is incorrect.</p></div>";
    } else {
      // Update password
      $newHashed = password_hash($newPassword, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
      $stmt->bind_param("ss", $newHashed, $username);
      $stmt->execute();
      echo "<div class='section'><p>✅ Password successfully updated.</p></div>";
    }
  }
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
    if (!empty($_SESSION['cart']) && !empty($_SESSION['user']['username'])) {
        $username = $_SESSION['user']['username'];
        $items_json = json_encode($_SESSION['cart']);
        $status = 'Processing';
        $placed_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO orders (username, items, status, placed_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $items_json, $status, $placed_at);
        $stmt->execute();

        unset($_SESSION['cart']);
    }
}

if (isset($_POST['refund'])) {
  $username = $_SESSION['user']['username'];

  // Check if there's an existing refund request
  $check = $conn->prepare("SELECT COUNT(*) FROM orders WHERE username = ? AND refund_requested = 1 AND (refund_approved IS NULL OR refund_approved = 0)");
  $check->bind_param("s", $username);
  $check->execute();
  $check->bind_result($count);
  $check->fetch();
  $check->close();

  if ($count == 0) {
    $stmt = $conn->prepare("UPDATE orders SET refund_requested = 1, refund_approved = 0 WHERE username = ? AND refund_requested = 0 ORDER BY placed_at DESC LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    echo "<p>📩 Refund request sent to admin for approval.</p>";
  } else {
    echo "<p>⚠️ You already have a refund request pending or approved.</p>";
  }
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
      <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
        <button onclick="location.href='?page=admin'">🛠️ Admin</button>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<div class="section">
    <?php if (empty($_SESSION['logged_in'])): // Check if not logged in first ?>
        <?php if (!isset($_POST['show_register']) && !isset($_POST['show_login'])): ?>
            <div style="text-align: center;">
                <form method="post" style="display: inline-block; margin: 10px;">
                    <button name="show_register" class="btn">Sign Up</button>
                </form>
                <form method="post" style="display: inline-block; margin: 10px;">
                    <button name="show_login" class="btn">Sign In</button>
                </form>
            </div>
        <?php endif; ?>
    <?php elseif ($page == 'account'): // Now, if logged in, check for 'account' page ?>
        <div class="account-grid">
            <div class="profile-card">
                <div class="avatar">👤</div>
                <div class="username"><?= htmlspecialchars($_SESSION['user']['username']) ?></div>
                <a href="?logout=true">Logout</a>
            </div>

            <div class="profile-form">
                <h2>Account Information</h2>
                <form method="post">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>

                    <label>Address</label>
                    <input name="address" value="<?= htmlspecialchars($_SESSION['user']['address']) ?>" required>

                    <button name="update_profile" class="btn">Update Profile</button>
                </form>
            </div>
        </div>

        <div class="profile-form" style="margin-top: 30px;">
            <h2>Change Password</h2>
            <form method="post">
                <label>Current Password</label>
                <input type="password" name="current_password" required>

                <label>New Password</label>
                <input type="password" name="new_password" required>

                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required>

                <button name="change_password" class="btn">Update Password</button>
            </form>
        </div>
    <?php elseif ($page == 'cart'): // Check for 'cart' page ?>
        <div class="cart-section">
            <h2>Shopping Bag</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
                    <div class="product-card">
                        <form method="post">
                            <?= htmlspecialchars($products[$id]['name']) ?> – ₱<?= number_format($products[$id]['price'], 2) ?> ×
                            <input type="number" name="quantity" value="<?= htmlspecialchars($qty) ?>" min="1">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
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
    <?php elseif ($page == 'admin' && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): // Check for 'admin' page and admin role ?>
        <div class="section">
            <h2>👑 Admin Control Panel</h2>
            <h3>Refund Requests</h3>
            <?php
            // Handle refund approval
            if (isset($_POST['approve_refund'])) {
                $orderId = $_POST['order_id'];
                $stmt = $conn->prepare("UPDATE orders SET refund_approved = 1 WHERE id = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                echo "<p>✅ Refund for Order #$orderId has been approved.</p>";
            }

            // Handle refund decline
            if (isset($_POST['decline_refund'])) {
                $orderId = $_POST['order_id'];
                $stmt = $conn->prepare("UPDATE orders SET refund_approved = -1 WHERE id = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                echo "<p>❌ Refund for Order #$orderId has been declined.</p>";
            }

            $refunds = $conn->query("SELECT id, username, status, placed_at FROM orders WHERE refund_requested = 1 AND (refund_approved IS NULL OR refund_approved = 0)");
            if ($refunds->num_rows > 0) {
                while ($r = $refunds->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    echo "<p><strong>" . htmlspecialchars($r['username']) . "</strong> requested a refund for Order #" . htmlspecialchars($r['id']) . " placed on " . htmlspecialchars($r['placed_at']) . " (" . htmlspecialchars($r['status']) . ")</p>";
                    echo "<form method='post' style='display:inline-block;'>
                                <input type='hidden' name='order_id' value='" . htmlspecialchars($r['id']) . "'>
                                <button name='approve_refund' class='btn' style='background:green;'>Approve</button>
                            </form>
                            <form method='post' style='display:inline-block;'>
                                <input type='hidden' name='order_id' value='" . htmlspecialchars($r['id']) . "'>
                                <button name='decline_refund' class='btn' style='background:red;'>Decline</button>
                            </form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No pending refund requests.</p>";
            }
            ?>

            <?php
            if (isset($_POST['delete_user'])) {
                $userToDelete = $_POST['user_to_delete'];
                if ($userToDelete !== $_SESSION['user']['username']) {
                    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
                    $stmt->bind_param("s", $userToDelete);
                    $stmt->execute();
                    echo "<p>✅ Deleted user: " . htmlspecialchars($userToDelete) . "</p>";
                } else {
                    echo "<p>⚠️ You cannot delete yourself.</p>";
                }
            }

            if (isset($_POST['delete_order'])) {
                $orderId = $_POST['order_id'];
                $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                echo "<p>🗑️ Order #" . htmlspecialchars($orderId) . " deleted.</p>";
            }

            if (isset($_POST['update_status'])) {
                $orderId = $_POST['order_id'];
                $newStatus = $_POST['new_status'];
                $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
                $stmt->bind_param("si", $newStatus, $orderId);
                $stmt->execute();
                echo "<p>✅ Order #" . htmlspecialchars($orderId) . " status updated to <strong>" . htmlspecialchars($newStatus) . "</strong>.</p>";
            }
            ?>

            <h3>All Users</h3>
            <ul>
                <?php
                $users = $conn->query("SELECT username, role FROM users");
                while ($user = $users->fetch_assoc()):
                ?>
                    <li>
                        <strong><?= htmlspecialchars($user['username']) ?></strong> (<?= htmlspecialchars($user['role']) ?>)
                        <?php if ($user['username'] !== $_SESSION['user']['username']): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_to_delete" value="<?= htmlspecialchars($user['username']) ?>">
                                <button name="delete_user" class="btn" style="background:red;">Delete</button>
                            </form>
                        <?php else: ?>
                            <em>(You)</em>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>

            <h3>All Orders</h3>
            <?php
            $orders = $conn->query("SELECT id, username, items, status, placed_at FROM orders ORDER BY placed_at DESC");
            if ($orders->num_rows > 0):
                while ($order = $orders->fetch_assoc()):
                    $items = json_decode($order['items'], true);
            ?>
                    <div class="product-card">
                        <p><strong><?= htmlspecialchars($order['username']) ?></strong> – <?= htmlspecialchars($order['status']) ?> on <?= htmlspecialchars($order['placed_at']) ?></p>
                        <ul>
                            <?php foreach ($items as $id => $qty): ?>
                                <li><?= htmlspecialchars($products[$id]['name']) ?> × <?= htmlspecialchars($qty) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <form method="post" style="margin-bottom: 10px;">
                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                            <select name="new_status">
                                <option value="Processing" <?= $order['status'] === 'Processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="Shipped" <?= $order['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="Completed" <?= $order['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                            <button name="update_status" class="btn" style="background:green;">Update Status</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                            <button name="delete_order" class="btn" style="background:red;">Delete Order</button>
                        </form>
                    </div>
                <?php endwhile; else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>

    <?php else: // This is the default case: logged in and not on 'cart' or 'admin' page (implies 'main' or 'account' in your logic) ?>
        <div class="product-grid grid">
            <?php foreach ($filtered as $id => $p): ?>
                <div class="product-card" style="padding: 20px; border: 1px solid #ccc; margin-bottom: 20px; text-align: center;">
                    <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px;"><br>
                    <strong><?= htmlspecialchars($p['name']) ?></strong><br>
                    ₱<?= number_format($p['price'], 2) ?><br>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($_SESSION['logged_in']) && $page != 'admin' && $page != 'cart'): ?>
            <div class="order-section">
                <h2>Order History</h2>
                <?php
                $username = $_SESSION['user']['username'] ?? '';

                $stmt = $conn->prepare("SELECT id, items, status, placed_at, refund_requested, refund_approved FROM orders WHERE username = ? ORDER BY placed_at DESC");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0):
                    while ($order = $result->fetch_assoc()):
                        $items = json_decode($order['items'], true);
                ?>
                        <div class="product-card">
                            <p><strong>Order #<?= htmlspecialchars($order['id']) ?></strong> (<?= htmlspecialchars($order['status']) ?>) – Placed on <?= htmlspecialchars($order['placed_at']) ?></p>
                            <ul>
                                <?php foreach ($items as $id => $qty): ?>
                                    <li><?= htmlspecialchars($products[$id]['name']) ?> × <?= htmlspecialchars($qty) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($order['refund_requested']): ?>
                                <?php if ($order['refund_approved'] == 1): ?>
                                    <p>📨 Refund request: ✅ Approved</p>
                                <?php elseif ($order['refund_approved'] == -1): ?>
                                    <p>📨 Refund request: ❌ Declined</p>
                                <?php else: ?>
                                    <p>📨 Refund request: ⏳ Pending approval</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>

                    <?php
                    $refundCheck = $conn->prepare("SELECT COUNT(*) FROM orders WHERE username = ? AND refund_requested = 1 AND (refund_approved IS NULL OR refund_approved = 0)");
                    $refundCheck->bind_param("s", $username);
                    $refundCheck->execute();
                    $refundCheck->bind_result($refundCount);
                    $refundCheck->fetch();
                    $refundCheck->close();

                    if ($refundCount == 0): ?>
                        <form method="post">
                            <button name="refund" class="btn">Request Refund</button>
                        </form>
                    <?php else: ?>
                        <p>📩 Refund request already sent. Please wait for admin approval.</p>
                    <?php endif; ?>

                <?php else: ?>
                    <p>No orders yet.</p>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    <?php endif; // End of the main if/elseif/else block ?>

    <?php if (isset($_POST['show_register']) && empty($_SESSION['logged_in'])): ?>
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

    <?php if (isset($_POST['show_login']) && empty($_SESSION['logged_in'])): ?>
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