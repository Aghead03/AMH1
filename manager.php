<?php include("header.php"); ?>
<?php

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "cartf23";
$conn1 = new PDO("mysql:host=$servername;dbname=$dbname",$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
$conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn1->exec("SET CHARACTER SET UTF8");

$conn = mysqli_connect("localhost","root","","cartf23");
$id='';
$name='';
$price='';
$description='';
$image='';
$update = false;
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $stm = "DELETE FROM products WHERE id=$id";
    mysqli_query($conn,$stm)or die($mysqli->error());
}

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $image=$_POST['image'];
    $stm = "UPDATE products SET name='$name',price=$price,description='$description',image='$image' WHERE id=$id";
    mysqli_query($conn,$stm)or die($mysqli->error());
}


if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $stm = "SELECT * FROM products WHERE id=$id";
   $result =  mysqli_query($conn,$stm)or die($mysqli->error());
    if(count($result)==1)
    {
        
        $row = $result->fetch_array();
        $id = $row['id'];
        $name=$row['name'];
        $price = $row['price'];
        $description = $row['description'];
        $image = $row['image'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>pro</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <div id="myNav" class="menu_sid">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="menu_sid-content">
            <a href="#protien">Our Protien</a>
            <a href="#about">About Us</a>
            <a href="#testimonial">Testimonial</a>
            <a href="#contact">Contact Us</a>
        </div>
    </div>
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="menu_sitbar">
                <ul class="menu">
                    <li><button type="button">
                <img  onclick="openNav()" src="images/menu_icon.png" alt="#"/>
                </button>
                    </li>
                </ul>
                <ul class="social_icon">
                    <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="header_full_bg">
                <div class="header_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="logo">
                                    <a href="index.php"><img src="images/AMH-logo-oval-black.png" hight='170px' width='170px'  alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="banner_text">
                                    <h1>AMH<br> CAR STORE</h1>
                                    <a class="get_btn" href="index.php" role="button">Home</a> 
                                    <a class="get_btn" href="manager.php" role="button">Manager</a>       </div>
                            </div>
                            <div class="col-md-7">
                                <img class="bann_img" src="images/bann.png" alt="#" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <!-- our protien  -->
    <div id="protien" class="protien_main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our cars</h2>
                    </div>
                </div>
            </div>
            <div class="row">

            <?php
  if(isset($_POST['submit']))
  {
      
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $image = $_POST['image'];
     
      
      $stm = "INSERT INTO products (name,price,description,image) VALUES ('$name',$price,'$description','$image');";
      try{
          mysqli_query($conn,$stm);
          echo "New record created successfully";
 
    
      }catch(Exception $e)
 
      {
      echo "error1111";
      }
      $conn = null;
    
 
  }
 
 $sql = "SELECT * FROM products ";
      $data = mysqli_query($conn,$sql);
      if(!$data)
      {
          die('');
      }
      else
        {
            ?>
 <table border="1">
   <tr>
   
       <th >Name</th>
       <th>Price</th>
       <th>Description</th>
       <th>Image</th>
   </tr>
 
 
 <?php
          
         while( $category = mysqli_fetch_array($data))
         {
             ?>
              <tr>
                  <td>
                      <?php echo $category['name']; ?>
                  </td>
                  <td>
                      <?php echo $category['price'];?>
                  </td>
                  <td>
                      <?php echo $category['description'];?>
                  </td>
                  <td>
                   <img src= "   <?php echo $category['image'];?>" width="100px" hight="100px">
                  </td>
                  <td>
                      <a href="manager.php?edit=<?php echo $category['id']; ?>" >Edit</a>
                      <a href="manager.php?delete=<?php echo $category['id']; ?>" >Delete</a>
                  </td>
              </tr>
 
 <?php
 
         }?>
         </table>
         <form action="manager.php" method="POST">
            
             Name:<input type="text" name="name" id="name" value="<?php echo $name; ?>"/><br><br>
             Price:<input type="text" name="price" id="price" value="<?php echo $price; ?>"/><br><br>
             Description:<input type="text" name="description" id="description" value="<?php echo $description; ?>"/><br><br>
             Image:<input type="text" name="image" id="image" value="<?php echo $image; ?>"/><br><br>
             <input type="hidden" name="id" id="id" value = "<?php echo $id; ?>"/><br><br>
             <?php
 
                  if($update == true):
 
             ?>
             <input type="submit" name="update" value="update" />
             <?php else: ?>
             <input type="submit" name="submit" value="Add" />
             <?php endif; ?>
         </form>
         
         <?php
          
        }
      
      $conn->close();
 ?>
            </div>
        </div>
    </div>
    <!-- end our protien  -->
    <!-- about -->
    <div id="about" class="about">
        <div class="container-fluid">
            <div class="row d_flex">
                <div class="col-md-6">
                    <div class="titlepage">
                        <h2>About Us</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or</p>
                        <a class="read_more" href="Javascript:void(0)"> Read More</a>
                    </div>
                </div>
                <div class="col-md-6 pad_right0">
                    <div class="about_img ">
                        <figure><img src="images/BMW-E46-PNG-File.png" alt="#" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    
    <!--  contact -->
    <div id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Request a call back</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form id="request" class="main_form">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Full Name" type="type" name="Full Name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email " type="type" name="Email ">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="daih_bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="conta">
                                <li><i class="fa fa-phone" aria-hidden="true"></i> Call Now +01 123467890</li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Location</li>
                                <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <img class="tex_left" src="images/logo2.png" alt="#" />
                    </div>
                    <div class=" col-md-3 col-sm-6">
                        <p class="variat">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum </p>
                    </div>
                    <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                        <h3>Information </h3>
                        <ul class="link_menu">
                            <li> There are many </li>
                            <li> variations of pas</li>
                            <li> sages of Lorem </li>
                            <li> Ipsum available, </li>
                            <li>but the majority </li>
                            <li>have suffered </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                        <h3>Helpful Links</h3>
                        <ul class="link_menu">
                            <li> There are many </li>
                            <li> variations of pas</li>
                            <li> sages of Lorem </li>
                            <li> Ipsum available, </li>
                            <li>but the majority </li>
                            <li>have suffered </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                        <h3>Supported</h3>
                        <ul class="link_menu">
                            <li> There are many </li>
                            <li> variations of pas</li>
                            <li> sages of Lorem </li>
                            <li> Ipsum available, </li>
                            <li>but the majority </li>
                            <li>have suffered </li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <ul class="social2_icon">
                            <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <p>© 2019 All Rights Reserved.<a href="https://html.design/"> Free html Templates</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
</body>

</html>