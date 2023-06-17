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
            <div class="grid grid-cols-4">
                <?php foreach ($products as $product) { ?>
                    <div class="bg-white mx-auto mx-4 my-5 text-center w-52 overflow-hidden rounded-xl delete-checkbox shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300">
                        <input type="checkbox" name="delete-chk[]" class="delete-checkbox" value="<?php echo $product["id"]; ?>">
                        <h2 class="font-bold text-lg"><?php echo ($product["SKU"]); ?></h2>
                        <p><?php echo ($product["Pname"]); ?></p>
                        <p><?php echo ($product["Price"]); ?>$</p>
                        <p class="font-light">Type: <span class="font-medium"><?php echo ($product["Type"]); ?></span></p>
                        <!-- if the product type is furniture, size and weight values will be hidden. so height, width and length will be shown -->
                        <p class="font-medium <?php echo ($product["Type"] === 'Furniture' ? 'hidden' : ''); ?>">Size: <?php echo ($product["Size"]); ?>MB</p>
                        <p class="font-medium <?php echo ($product["Type"] === 'Furniture' ? 'hidden' : ''); ?>">Weight: <?php echo ($product["Weight"]); ?>kg</p>
                        <!-- if the product type is something else height, width, and length will be hidden only size and weight will be shown.  -->
                        <!-- <p class="font-medium <?php echo ($product["Type"] !== 'Furniture' ? 'hidden' : ''); ?>">Height: <?php echo ($product["Height"]); ?>M</p>
                        <p class="font-medium <?php echo ($product["Type"] !== 'Furniture' ? 'hidden' : ''); ?>">Width: <?php echo ($product["Width"]); ?>M</p>
                        <p class="font-medium mb-5 <?php echo ($product["Type"] !== 'Furniture' ? 'hidden' : ''); ?>">Length: <?php echo ($product["Length"]); ?>M</p> -->
                        <p class="font-medium mb-5 <?php echo ($product["Type"] !== 'Furniture' ? 'hidden' : ''); ?>">Dimensions: <?php echo ($product["Height"]); ?>x<?php echo ($product["Width"]); ?>x<?php echo ($product["Length"]); ?></p>


                    </div>
                <?php } ?>
            </div>
        </section>

    </form>

    <!-- Footer -->
    <footer class="py-6 bg-gray-200 text-gray-900 text-center mx-auto">
        <h3>Scandiweb Test Assignment </h3>
    </footer>
    <script>
        // Get all elements with class "font-medium"
        var elements = document.getElementsByClassName("font-medium");

        // Loop through the elements
        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];

            // Hide the element if it has the "hidden" class
            if (element.classList.contains("hidden")) {
                element.style.display = "none";
            }
            document.getElementById('dimensionsAlert').style.display = 'block';
        }
    </script>

</body>

</html>