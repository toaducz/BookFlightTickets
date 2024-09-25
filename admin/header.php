<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
        <title>Online Flight Booking</title>          
        <link rel = "icon" href =  
            "../assets/images/brand.png" 
        type = "image/x-icon">          
    </head>
<style>
@font-face {
  font-family: "Times New Roman";
}
button.btn-outline-light:hover {
  color: cornflowerblue !important;
}
  .navbar-custom {
    /* background-color: #6495ED; */
    background-color: #3a3a3a;
    /* font-family: 'Bangers', cursive; */
    font-family: "Times New Roman", cursive;    
  }
  h4 {
    font-size: 23px !important;
  }
</style>
    <body>

        <nav class="navbar navbar-custom navbar-expand-lg navbar-dark">
          <a class="navbar-brand text-light" href="index.php"><h4>Trang chủ</h4></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <?php
              if(isset($_SESSION['adminId'])) { ?>
                <ul class="navbar-nav mr-auto">
                 <li class="nav-item">
                    <a class="nav-link" href="flight.php">
                      <h5 class="ml-2"> Thêm chuyến bay</h5>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="all_flights.php">
                      <h5>Danh sách các chuyến bay</h5>
                    </a>
                  </li>   
                  <li class="nav-item">
                    <a class="nav-link" href="list_airlines.php">
                      <h5>Danh sách máy bay</h5>
                    </a>
                  </li>              
                  <li class="nav-item">
                    <a class="nav-link" href="customer.php">
                      <h4>Danh sách tài khoản</h4>
                    </a>
                  </li>  
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="pass_list.php">
                      <h4>Danh sách khách</h4>
                    </a>
                  </li>                    -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="nav-item">
                    <div class="dropdown mt-2">
                      <button class="btn bg-transparent dropdown-toggle text-white" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" 
                          aria-haspopup="true" aria-expanded="false">
                        
                        <i class="fa fa-plus text-white"></i> Thêm máy bay </td>
                      </button>  
                      <div class="dropdown-menu">
                        <form class="px-2 py-2"  action="../includes/admin/airline.inc.php" method="post">
                          <div class="form-group">
                            <input type="text" class="form-control" name="airline" 
                              placeholder="Tên máy bay">
                            <input type="number" class="form-control mt-3" name="seats" 
                              placeholder="Tổng số ghế">                              
                          </div>  
                          <button type="submit" name="air_but" 
                            class="btn btn-success w-100">Thêm</button>
                        </form>
                      </div>
                    </div>  
                  </li>           
                </ul>                 
                <form action="../includes/logout.inc.php" method="POST">
                <button class="btn btn-outline-light m-2" type="submit">
                    Đăng xuất </button>
                </form> 
            </div>
            <?php } ?>

        </nav>
