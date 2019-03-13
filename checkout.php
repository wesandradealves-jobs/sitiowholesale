<?php
// Redirect to the home page if id parameter not found in URL
if(empty($_GET['id'])){
    header("Location: index.php");
}

// Include and initialize database class
include 'DB.class.php';
$db = new DB;

// Include and initialize paypal class
include 'PaypalExpress.class.php';
$paypal = new PaypalExpress;

// Get product ID from URL
$productID = $_GET['id'];

// Get product details
$conditions = array(
    'where' => array('id' => $productID),
    'return_type' => 'single'
);
$productData = $db->getRows('products', $conditions);

// Redirect to the home page if product not found
if(empty($productData)){
    header("Location: index.php");
}
?>

<div class="item">
    <!-- Product details -->
    <img src="images/<?php echo $productData['image']; ?>"/>
    <p>Name: <?php echo $productData['name']; ?></p>
    <p>Price: <?php echo $productData['price']; ?></p>
    
    <!-- Checkout button -->
    <div id="paypal-button"></div>
</div>