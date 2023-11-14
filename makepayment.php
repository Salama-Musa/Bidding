<?php
// Retrieve the captured details
$img = $_POST['img'];
$name = $_POST['name'];
$category = $_POST['category'];
$startBid = $_POST['startBid'];
$bidEndDatetime = $_POST['bidEndDatetime'];
$description = $_POST['description'];

// Add your payment logic here
// ...

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Your Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">View Your Order</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $img; ?>" alt="Item Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><?php echo $category; ?></td>
                    </tr>
                    <tr>
                        <td>Starting Amount:</td>
                        <td>KES<?php echo $startBid; ?></td>
                    </tr>
                    <tr>
                        <td>Bid End Date:</td>
                        <td><?php echo $bidEndDatetime; ?></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><?php echo $description; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control form-control-sm" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" class="form-control form-control-sm" id="location" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Item Price:</label>
                                <input type="text" class="form-control form-control-sm" id="price" name="price" value="KES<?php echo $startBid; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="item_name">Item Name:</label>
                                <input type="text" class="form-control form-control-sm" id="item_name" name="item_name" value="<?php echo $name; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-right" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-success">Make Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
