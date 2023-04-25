<?php
include("./config/dbconnect.php");
// echo "Debugging statement: PHP code is being executed.<br>";

// query for fetching data
$sql = "SELECT * FROM products";

$res = mysqli_query($conn, $sql);

// query to get the results
$products = mysqli_fetch_all($res, MYSQLI_ASSOC);

//fetching the rows as arrays
mysqli_free_result($res);

//close the connection
mysqli_close($conn);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <!-- Title -->
    <div class="pt-16 bg-white justify-between flex">
        <h1 class="text-center text-2xl font-bold text-gray-800">Product List</h1>
        <div class='flex gap-6'>
            <a class='bg-blue-500 text-white rounded-md px-2 py-2 cursor hover:bg-blue-700' href="./add_product.php"><button>Add</button> </a>
        </div>
    </div>

    <!-- Product List -->
    <form action="delete.php" method="POST">
        <div class="flex justify-end gap-6">
            <input class='border border-red-300 text-red-500 p-2 rounded-md shadow-md hover:bg-red-600 hover:text-white cursor' id="delete-product-btn" type="submit" name="deleteBtn" value="Mass Delete">
        </div>
        <section class="py-10 bg-gray-100">
            <div class="grid grid-cols-4 ">
                <?php foreach ($products as $product) { ?>
                    <div class="bg-white mx-auto mx-4 my-5 text-center w-48 h-48 overflow-hidden rounded-xl delete-checkbox shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300">
                        <input type="checkbox" name="delete-chk[]" class="delete-checkbox" value="<?php echo $product["id"]; ?>">
                        <h2 class="font-bold text-lg"><?php echo ($product["SKU"]); ?></h2>
                        <p><?php echo ($product["Pname"]); ?></p>
                        <p><?php echo ($product["Price"]); ?>$</p>
                        <p class="font-bold">Size: <?php echo ($product["Type"]); ?></p>
                    </div>
                <?php } ?>
            </div>
            
            
        </section>
    </form>

    <!-- Footer -->
    <footer class="py-6 bg-gray-200 text-gray-900 text-center mx-auto">
        <h3>Scandiweb Test Assignment </h3>
    </footer>

</body>

</html>
