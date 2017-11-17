<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<title>khyBEST</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<!-- <?php
  //echo "<a href=https://twitter.com>My Twitter</a>"
 ?> -->
 <?php
$target_dir = "wp-content/themes/khybest/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

		  <a class="active" href="javascript:void(0)">Home</a>
		  <a href="javascript:void(0)">News</a>
		  <a href="javascript:void(0)">Contact</a>
<<<<<<< HEAD
      <a href="about.php">About</a>
=======
		  <a href="">About</a>
>>>>>>> d57ed726e1f7fd6addcbe3f1addb96b5372c0d77
     
		</div>
	</div>
	<div class="content">
	   <div>
      <form method="post"  enctype="multipart/form-data">
        Brand: <input type="text" name="shirtname" id="shirt_name"><br>
         Size:  <input type="text" name="shirtsize" id="shirt_size"><br>
        Price: <input type="text" name="price" id="shirt_price">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <div id="image-holder">Display image</div>
         <input type="submit" value="Submit">
      </form>
    </div>
	</div>
  <script>
  $("#fileToUpload").on('change', function () {

    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "thumb-image"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    } else {
        alert("Pls select only images");
    }
});
</script>
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
