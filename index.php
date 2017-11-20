
<?php
require_once 'dbconfig.php';
session_start();
?>
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
<!-- <?php //get_header(); ?> -->
<?php
  // to connect to database


  //end

  //retrie data from database
  $sql = "SELECT id, shirtName, shirtSize, Price, RegisterDate, image  FROM shirtID";
  $result = $conn->query($sql);
  $conn->close();
  //end
?>

	<style>

<?php include 'style.css'; ?>
	</style>

<!-- <?php
  //echo "<a href=https://twitter.com>My Twitter</a>"
 ?> -->

 <div id="wrapper" >
    <div id="header">
        <h1><a href="<?php //echo get_option('home'); ?>"><?php //bloginfo('name'); ?></a></h1>
    </div>
</div>
  <div id="main">
 
   <div id="sideNav" style="background-color: white;">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
  

    <div id="navbar">
		  <a class="active" href="javascript:void(0)">Home</a>
		  <a href="javascript:void(0)">News</a>
		  <a href="javascript:void(0)">Contact</a>

      <a href="about.php">About</a>


     
		</div>
	</div>
	<div class="content">
	   <div>
      <form action="upload.php" method="post"  enctype="multipart/form-data">
        Brand: <input type="text" name="shirtname" id="shirt_name"><br>
         Size:  <input type="text" name="shirtsize" id="shirt_size"><br>
        Price: <input type="text" name="price" id="shirt_price">
    <input type="file" name="fileToUpload" id="fileUpload">
    <div id="image-holder">Display image</div>
         <input type="submit" value="Submit">
      </form>
    </div>
	</div>
  <script>
  $("#fileUpload").on('change', function () {

    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || extn =="PNG" || extn =="JPG") {
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
      // echo "<div class='imgMain'>
      //           <tr>
      //             <th>ID</th>
      //             <th>Branch</th>
      //             <th>Size</th>
      //             <th>Image</th>
      //             <th>Price</th>
      //             <th>Added Date</th>
      //           </tr>";
      // output data of each row
    	echo "<div class='imgMain'>";
      while($row = $result->fetch_assoc()) {

            //header("Content-type: wp-content/themes/khybest/uploads/png");
         
         echo "<div class='subImg'"; 
          //. $row["id"]."</td>";
          echo "<p>" . $row["shirtName"]."</p>";
          echo "<p>" . $row["shirtSize"]."</p>";
          echo "<div>".
                    "<img id ='imgshirt' src='uploads/".$row['image']."'/>".        
                "</div>";
          echo "<p>" . $row["Price"]."</p>";
          //echo "<td>" . $row["RegisterDate"]."</td></tr>";
          echo "</div>";
        }
        echo "</div>";
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
    navbar.classList.add("sticky");
navbar.style.marginTop = "0px";
    
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
<div class="navigation">
        <?php //posts_nav_link(); ?>
        </div>
        <?php //get_header(); ?>
<?php //get_sidebar(); ?>
<?php //get_about(); ?>
 	<?php
// remove all session variables
session_unset(); 

//destroy the session 
session_destroy();

//echo "All session variables are now removed, and the session is destroyed." 
?>
</body>
</html>
