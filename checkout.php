
<?php
include 'admin/db_connect.php';
session_start();
if (isset($_POST['id'])) {
    foreach ($_POST as $k => $val) {
        $$k = $val;
        $_SESSION[$k] = $val; // Set session variables
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="<?php echo $img ?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2 class="mt-3"><?php echo $name ?></h2>
                <p><strong>Category:</strong> <?php echo $category ?></p>
                <p><strong>Amount to be Paid:</strong> <?php echo number_format($startBid, 2) ?></p>
                <p><strong>Description:</strong></p>
                <p class="mb-4"><small><i><?php echo $description ?></i></small></p>

                <!-- Update the form action and add a hidden input field for session data -->
                <form id="payment-form" action="express_stk.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $id ?>">
                    <input type="hidden" name="amount" value="<?php echo $startBid ?>">
                    <input type="hidden" name="unique_id" value="<?php echo uniqid('payment_') ?>">
                    <input type="hidden" name="img" value="<?php echo $img ?>">
                    <input type="hidden" name="name" value="<?php echo $name ?>">
                    <input type="hidden" name="category" value="<?php echo $category ?>">
                    <input type="hidden" name="description" value="<?php echo $description ?>">
                    
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                    </div>
                    
                    <!-- Your existing payment button with a unique ID -->
                    <button type="submit" class="btn btn-success" id="pay_now_btn_<?php echo $id ?>">Pay Now</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add the full version of Bootstrap JS scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


