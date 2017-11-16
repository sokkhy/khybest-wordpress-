<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<title>khyBEST</title>
	<link rel="stylesheet" href="style.css">
</head>
<body onscroll="myFunction()">

  <?php
  // to connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname="productID";
//end

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// use prepared statment to insert data
$stmt = $conn->prepare("INSERT INTO shirtID (shirtName, shirtSize, Price) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $shirtName, $shirtSize, $Price);
//validate form 
if(!empty($_POST['shirtname']) && !empty($_POST['shirtsize']) && !empty($_POST['price'])){
$shirtName = $_POST["shirtname"];
$shirtSize=$_POST["shirtsize"];
$Price = $_POST["price"];
$stmt->execute();
}

//end

//select data from database
$sql = "SELECT id, shirtName, shirtSize, Price, RegisterDate  FROM shirtID";
$result = $conn->query($sql);
$conn->close();
//end
?>

	<style>
<?php include 'style.css'; ?>
	</style>
<div id="main">
 
	<div id="sideNav" style="background-color: white;">
	  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
	

		<div id="navbar">
<?php
 echo "<a href=https://twitter.com>My Twitter</a>"
 ?>
		  <a class="active" href="javascript:void(0)">Home</a>
		  <a href="javascript:void(0)">News</a>
		  <a href="javascript:void(0)">Contact</a>
		  <a href="">About</a>
     
		</div>
	</div>
	<div class="content">
	   <div>
    <form method="post">
      Brand<input type="text" name="shirtname" id="shirt_name"><br>
      Size<input type="text" name="shirtsize" id="shirt_size"><br>
      Price<input type="text" name="price" id="shirt_price">
      <input type="submit" value="Submit">
    </form>
  </div>
	</div>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="#">About</a>
	  <a href="#">Services</a>
	  <a href="#">Clients</a>
	  <a href="#">Contact</a>
     <a href="#">Policy</a>
	</div>

<div class="showItem">
  <!-- retreive data from database to display -->
  <?php
  if ($result->num_rows > 0) {
    echo "<table>
              <tr>
                <th>ID</th>
                <th>Branch</th>
                <th>Size</th>
                <th>Price</th>
              </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]."</td>";
        echo "<td>" . $row["shirtName"]."</td>";
         echo "<td>" . $row["shirtSize"]."</td>";
          echo "<td>" . $row["Price"]."</td>";
          echo "<td>" . $row["RegisterDate"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
<!-- end -->
</div>

</div>

<script>
var navbar = document.getElementById("sideNav");
var sticky = navbar.offsetTop;


function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    
  } else {
    navbar.classList.remove("sticky");
 
  }
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}
</script>

</body>
</html>
