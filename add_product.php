<?php
include("./config/dbconnect.php");

// var_dump($_POST);

$commonFields = "`SKU`, `Pname`, `Price`, `Type`"; // these are the default values. every card/product must have these.

$typeSpecificFields = array();
$typeSpecificValues = array();

if (isset($_POST["submit"])) {
  // this is to show what has been collected from the form when the user clicks "SUBMIT BUTTON"
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  if (isset($_POST['SKU']) && isset($_POST['Pname']) && isset($_POST['Price']) && isset($_POST['Type'])) {
    $SKU = mysqli_real_escape_string($conn, $_POST['SKU']);
    $name = mysqli_real_escape_string($conn, $_POST['Pname']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);

    $commonValues = "'" . $SKU . "', '" . $name . "', '" . $price . "', '" . $type . "'";

    $typeSpecificFields = array();
    $typeSpecificValues = array();

    // this code makes the form change when the user inputs a diffrent type of product. happens when the user selects the type in the options provided.
    switch ($type) {
      case 'DVD':
        $size = mysqli_real_escape_string($conn, $_POST['Size']);
        $typeSpecificFields[] = "`Size`";
        $typeSpecificValues[] = "'" . $size . "'";
        break;
      case 'Book':
        $weight = mysqli_real_escape_string($conn, $_POST['Weight']);
        $typeSpecificFields[] = "`Weight`";
        $typeSpecificValues[] = "'" . $weight . "'";
        break;
      case 'Furniture':
        $height = mysqli_real_escape_string($conn, $_POST['Height']);
        $width = mysqli_real_escape_string($conn, $_POST['Width']);
        $length = mysqli_real_escape_string($conn, $_POST['Length']);
        $typeSpecificFields[] = "`Height`";
        $typeSpecificFields[] = "`Width`";
        $typeSpecificFields[] = "`Length`";
        $typeSpecificValues[] = "'" . $height . "'";
        $typeSpecificValues[] = "'" . $width . "'";
        $typeSpecificValues[] = "'" . $length . "'";
        break;

      default:

        break;
    }

    echo "Common Values: " . $commonValues . "<br>";
    echo "Type Specific Values: " . implode(', ', $typeSpecificValues) . "<br>";

    $typeSpecificFields = implode(',', $typeSpecificFields);
    $typeSpecificValues = implode(',', $typeSpecificValues);

    // inserts the input form data into the database
    $sql = "INSERT INTO `products` ($commonFields, $typeSpecificFields) VALUES ($commonValues, $typeSpecificValues)";

    if (mysqli_query($conn, $sql)) {
      // Show a success message
      //echo "New record created successfully.";
    } else {
      // Show an error message
      echo "Error: " . mysqli_error($conn);
    }
  } else {
    echo "Error: Some required fields are missing.";
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
      <form id="product_form" method="post" class="form" action="add_product.php">
        <div>
          <label for="sku" class="mb-3 block text-base font-medium text-[#07074D]">SKU:</label>
          <input type="text" id="sku" name="SKU" placeholder="Enter SKU..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
        </div>
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" name="Pname" placeholder="Enter Product Name..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
        </div>
        <div>
          <label for="price">Price:</label>
          <input type="text" id="price" name="Price" placeholder="Enter Price..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
        </div>
        <div>
          <label for="productType" class="mb-3 block text-base font-medium text-[#07074D]">Product Type:</label>
          <select id="productType" name="Type" class="bg-gray-100 rounded-md w-full border border-[#e0e0e0] p-2 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]">
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
          </select>
        </div>
        <div id="typeSpecificFields">
          <!-- DVD-specific field. appear when the user switches to product type DVD -->
          <div id="dvdFields" style="display: none;">
            <label for="size" class="text-base font-medium text-[#07074D] mt-5">Size (MB):</label>
            <input type="text" id="size" name="Size" class="bg-gray-100 mt-5 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]"><br>
          </div>
          <!-- Book-specific field  appear when the user seleccts prduct type BOOK-->
          <div id="bookFields" style="display: none;">
            <label for="weight" class="text-base font-medium text-[#07074D] mt-5">Weight (Kg):</label>
            <input type="text" id="weight" name="Weight" class=" mt-5 bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]">
          </div>
          <div class="form-group" id="dimensionsAlert" style="display: none;">
            <div class="alert alert-danger" role="alert">
              Please provide the dimensions of the furniture.
            </div>
          </div>
          <!-- Furniture-specific fields appear when the user selects product type "FURNITURE"-->
          <div id="furnitureFields" style="display: none;">
            <label for="height" class="text-base font-medium text-[#07074D]">Height:</label>
            <input type="text" id="height" name="Height" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]"><br><br>
            <label for="width" class="text-base font-medium text-[#07074D]">Width:</label>
            <input type="text" id="width" name="Width" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]">
            <label for="length" class="text-base font-medium text-[#07074D]">Length:</label>
            <input type="text" id="length" name="Length" class="bg-gray-100 rounded-md w-32 border border-[#e0e0e0] p-1 focus:border-[#6A64F1] text-base font-medium text-[#6B7280]">
          </div>
        </div>



        <input class=" mt-5 hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none" type="submit" name="submit" value="Submit">
      </form>
    </div>

  </div>
  </div>

  <script>
    // Ensures the form switches effectively and the respective fields are displayed
    document.getElementById('productType').addEventListener('change', function() {
      var selectedType = this.value.toLowerCase();
      var specificFields = document.getElementById('typeSpecificFields').querySelectorAll('div');

      for (var i = 0; i < specificFields.length; i++) {
        specificFields[i].style.display = 'none';
      }

      document.getElementById(selectedType + 'Fields').style.display = 'block';

      if (selectedType === 'furniture') {
      
      document.getElementById('dimensionsAlert').style.display = 'block';
    } else {
      
      document.getElementById('dimensionsAlert').style.display = 'none';
    }


    });
  </script>

</body>

</html>