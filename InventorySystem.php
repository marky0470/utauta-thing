<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define a function to create a connection to the database
function connect() {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "inventory_system";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $conn;
}

$conn = connect();

if($conn->connect_error){
  die("Connection Failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the "add" button has been clicked
  if (isset($_POST["add"])) {
    // Get the input values from the form
    $item_name = isset($_POST["item_name"]) ? $_POST["item_name"] : "";
    $category = isset($_POST["category"]) ? $_POST["category"] : "";
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";
    $ceiling_price = isset($_POST["ceiling"]) ? $_POST["ceiling"] : "";
    $base_price = isset($_POST["base"]) ? $_POST["base"] : "";

    // Insert the new item into the database
    $sql = "INSERT INTO inventory (item_name, category, quantity, price, ceiling_price, base_price) VALUES ('$item_name', '$category', '$quantity', '$price', '$ceiling_price', '$base_price')";
    if ($conn->query($sql) === TRUE) {
      echo "Item added successfully";
      header("Location: additem.html");
      exit();
    } else {
      echo "Error adding item: " . $conn->error;
    }
  }

  // Check if the "update" button has been clicked
  if (isset($_POST["update"])) {
    // Get the input values from the form
    $id = $_POST["id"];
    $category = $_POST["category"];
    $item_name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $ceiling_price = $_POST["ceiling"];
    $base_price = $_POST["base"];

    // Update the item in the database
    $sql = "UPDATE inventory SET item_name='$item_name', category='$category', quantity='$quantity', price='$price', ceiling_price='$ceiling_price', base_price='$base_price' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
      header("Location: modifyitem.html");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  // Check if the "delete" button has been clicked
  if (isset($_POST["delete"])) {
    // Get the ID of the item to delete
    $id = $_POST["id"];

    // Delete the item from the database
    $sql = "DELETE FROM inventory WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
      header("Location: deleteitem.html");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}

?>