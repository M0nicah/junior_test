<?php
include("./config/dbconnect.php");

if (isset($_POST["submit"])) {
  $SKU = mysqli_real_escape_string($conn, $_POST['SKU']);
  $name = mysqli_real_escape_string($conn, $_POST['Pname']);
  $price = mysqli_real_escape_string($conn, $_POST['Price']);
  $type = mysqli_real_escape_string($conn, $_POST['Type']);

  $sql = "INSERT INTO `products` (`id`, `SKU`, `Pname`, `Price`, `Type`) VALUES (NULL, '$SKU','$name','$price', '$type')";

  if (mysqli_query($conn, $sql)) {
    // Show a success message
    // echo "New record created successfully.";
  } else {
    // Show an error message
    echo "Error: " . mysqli_error($conn);
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Add</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="pt-16 bg-white justify-between flex">
    <h1 class="text-center text-2xl font-bold text-gray-800">Product Add</h1>
    <div class='flex gap-4 px-2'>
      <a class='bg-blue-500 font-bold text-white rounded-md p-2 cursor hover:bg-blue-700' href="./product.php" name="add_product">Save </a>
      <a class='border border-red-300 font-bold text-red-500 p-2 rounded-md shadow-md hover:bg-red-600 hover:text-white cursor' id="delete-product-btn" href='./product.php'>Cancel</a>
    </div>

  </div>


  <div class="flex items-center justify-center p-12 bg-blue-100">
    <div class="mx-auto w-full max-w-[550px] bg-white p-5 rounded-md shadow-lg ">
      <form method="POST" id="product_form" class="form">
        <div class="mb-5">
          <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
            Product SKU
          </label>
          <input type="text" name="SKU" id="sku" placeholder="Enter SKU..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <div class="mb-5">
          <label for="pname" class="mb-3 block text-base font-medium text-[#07074D]">
            Product Name
          </label>
          <input type="text" name="Pname" id="name" placeholder="Product Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <div class="mb-5">
          <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
            Price
          </label>
          <input type="number" name="Price" id="price" placeholder="Price" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <div class="mb-5">
          <label for="Type" class="mb-3 block text-base font-medium text-[#07074D]">
            Type Switcher
          </label>
          <select name="Type" id="Type" class="bg-gray-100 rounded-md w-full border border-[#e0e0e0] p-2 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]" onchange="toggleFields">
            <option value="dvd">DVD</option>
            <option value="book">Book</option>
            <option value="furniture">Furniture</option>
          </select><br><br>

          <div id="dvd_fields" style="display:none;">
            <label for="size" class="text-base font-medium text-[#07074D]">Size (MB):</label>
            <input type="text" id="size" name="size"><br><br>
          </div>

          <div id="book_fields" style="display:none;">
            <label for="weight" class="text-base font-medium text-[#07074D]">Weight (Kg):</label>
            <input type="text" id="weight" name="weight"><br><br>
          </div>

          <div id="furniture_fields" style="display:none;">
            <label for="height" class="text-base font-medium text-[#07074D]">Height (cm):</label>
            <input type="text" id="height" name="height" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]"><br><br>

            <label for="width" class="text-base font-medium text-[#07074D]">Width (cm):</label>
            <input type="text" id="width" name="width" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]"><br><br>

            <label for="length" class=" text-base font-medium text-[#07074D]">Length (cm):</label>
            <input type="text" id="length" name="length" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]"><br><br>
          </div>
          <input type="text" name="type" id="type" placeholder="Enter Text..." class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
        </div>
        <div>
          <input class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none" type="submit" name="submit" value="Submit">


        </div>
      </form>
    </div>
  </div>

  <script>
    const toggleFields = () => {
      const dvdFields = document.getElementById("dvd_fields");
      const bookFields = document.getElementById("book_fields");
      const furnitureFields = document.getElementById("furniture_fields");
      const productType = document.getElementById("productType");

      if (productType.value === "dvd") {
        dvdFields.style.display = "block";
        bookFields.style.display = "none";
        furnitureFields.style.display = "none";
      } else if (productType.value === "book") {
        dvdFields.style.display = "none";
        bookFields.style.display = "block";
        furnitureFields.style.display = "none";
      } else if (productType.value === "furniture") {
        dvdFields.style.display = "none";
        bookFields.style.display = "none";
        furnitureFields.style.display = "block";
      }
    };

    const productTypeSelect = document.getElementById("productType");
    productTypeSelect.addEventListener("change", toggleFields);
  </script>
</body>

</html>