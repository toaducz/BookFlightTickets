<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php');
require 'helpers/init_conn_db.php';
?>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
<style>
  table {
    background-color: white;
  }

  @font-face {
    font-family: "Times New Roman", Times, serif;
  }

  h1 {
    font-family: "Times New Roman" !important;
    color: #424242;
    font-size: 40px !important;
    margin-top: 20px;
    text-align: center;
  }

  h3 {
    color: #FFFFFF;
    text-align: center;
  }

  body {
    background: #bdc3c7;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #ff8b3d, #ADD8E6);
    background: linear-gradient(to right, #ff8b3d, #ADD8E6);
  }

  th {
    font-size: 22px;
    /* font-family: 'Courier New', Courier, monospace; */
  }

  td {
    margin-top: 10px !important;
    font-size: 16px;
    font-weight: bold;
    /* color: #3931af; */
    color: #424242;
  }
</style>
<main>
  <?php
        if (isset($_POST['search_but'])) {
          $dep_date = $_POST['dep_date'];
          $code = $_POST['code'];
          if ($code == 1) {
            $ret_date = $_POST['ret_date'];
          }
          $dep_city = $_POST['dep_city'];
          $arr_city = $_POST['arr_city'];
          $type = $_POST['type'];
          $f_class = $_POST['f_class'];
          $passengers = $_POST['passengers'];

          if ($dep_city === $arr_city) {
            header('Location: index.php?error=sameval');
            exit();
          }
          if ($dep_city === '0') {
            header('Location: index.php?error=seldep');
            exit();
          }
          if ($arr_city === '0') {
            header('Location: index.php?error=selarr');
            exit();
          }
          if ($arr_city === '0') {
            error_reporting(E_ERROR | E_PARSE);
          }
        ?>
  <div class="container-md mt-2">
    <h1 class="display-4 text-center text-light">Chuyến từ: <br>
      <?php echo $dep_city; ?>
      đến
      <?php echo $arr_city; ?>
    </h1><br>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr class="text-center">
          <th scope="col">Tên máy bay</th>
          <th scope="col">Thời gian đi</th>
          <th scope="col">Thời gian đến</th>
          <th scope="col">Tình trạng</th>
          <th scope="col">Phí</th>
          <th scope="col">Đặt</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = 'SELECT * FROM flight WHERE source=? AND Destination =? AND 
                    DATE(departure)=? ORDER BY Price';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_bind_param($stmt, 'sss', $dep_city, $arr_city, $dep_date);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          $stmt1 = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt1, $sql);
          mysqli_stmt_bind_param($stmt1, 'sss', $dep_city, $arr_city, $dep_date);
          mysqli_stmt_execute($stmt1);
          $result1 = mysqli_stmt_get_result($stmt1);
          $temp = mysqli_fetch_assoc($result1);
          if ($temp <= 0) {
            echo "<br><h3>Không có kết quả ...</h3><br>";
          }
          while ($row = mysqli_fetch_assoc($result)) {

            $price = (int) $row['Price'] * (int) $passengers;
            if ($type === 'round') {
              $price = $price * 2;
            }
            if ($f_class == 'B') {
              $price += 0.5 * $price;
            }
            if ($row['status'] === '') {
              $status = "Chưa khởi hành";
              $alert = 'alert-primary';
            } else if ($row['status'] === 'dep') {
              $status = "Đã khởi hành";
              $alert = 'alert-info';
            } else if ($row['status'] === 'issue') {
              $status = "bị hoãn";
              $alert = 'alert-danger';
            } else if ($row['status'] === 'arr') {
              $status = "Đã đến";
              $alert = 'alert-success';
            }
            echo "
                          <tr class='text-center'>                  
                            <td>" . $row['airline'] . "</td>
                            <td>" . $row['departure'] . "</td>
                            <td>" . $row['arrivale'] . "</td>
                            <td>
                              <div>
                                  <div class='alert " . $alert . " text-center mb-0 pt-1 pb-1' 
                                      role='alert'>
                                      " . $status . "
                                  </div>
                              </div>  
                            </td>                   
                            <td>$ " . $price . "</td>
                            ";
            if (isset($_SESSION['userId']) && $row['status'] === '' && $type === "one") {
              echo " <td>
                            <form action='pass_form.php' method='post'>
                            <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                              <input name='type' type='hidden' value=" . $type . ">
                              <input name='code' type='hidden' value=" . $code . ">
                              <input name='passengers' type='hidden' value=" . $passengers . ">
                              <input name='price' type='hidden' value=" . $price . ">
                              <input name='class' type='hidden' value=" . $f_class . ">
                              <button name='book_but' type='submit' 
                              class='btn btn-success mt-0'>
                              <div style=''>
                              <i class='fa fa-lg fa-check'></i>  
                              </div>
                            </button>
                            </form>
                            </td>                                                       
                            ";
            } elseif (isset($_SESSION['userId']) && $row['status'] === '' && $type === "round") {
              echo " <td>
                            <form action='pass_form.php' method='post'>
                            <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                              <input name='type' type='hidden' value=" . $type . ">
                              <input name='code' type='hidden' value=" . $code . ">
                              <input name='passengers' type='hidden' value=" . $passengers . ">
                              <input name='price' type='hidden' value=" . $price . ">
                              <input name='ret_date' type='hidden' value=" . $ret_date . ">
                              <input name='class' type='hidden' value=" . $f_class . ">
                              <button name='book_but' type='submit' 
                              class='btn btn-success mt-0'>
                              <div style=''>
                              <i class='fa fa-lg fa-check'></i>  
                              </div>
                            </button>
                            </form>
                            </td>                                                       
                            ";
            } elseif (isset($_SESSION['userId']) && $row['status'] === 'dep') {
              echo "<td>Không khả dụng</td>";
            } else {
              if ($row['status'] === '' && $type === "one") {
                echo " <td>
                            <form action='non-login.php' method='post'>
                            <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                              <input name='type' type='hidden' value=" . $type . ">
                              <input name='code' type='hidden' value=" . $code . ">
                              <input name='passengers' type='hidden' value=" . $passengers . ">
                              <input name='price' type='hidden' value=" . $price . ">
                              <input name='class' type='hidden' value=" . $f_class . ">
                              <button name='book_but' type='submit' 
                              class='btn btn-success mt-0'>
                              <div style=''>
                              <i class='fa fa-lg fa-check'></i>  
                              </div>
                            </button>
                            </form>
                            </td>                                                       
                            ";
              }
              if ($row['status'] === '' && $type === "round") {
                echo " <td>
                <form action='non-login.php' method='post'>
                <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                  <input name='type' type='hidden' value=" . $type . ">
                  <input name='code' type='hidden' value=" . $code . ">
                  <input name='passengers' type='hidden' value=" . $passengers . ">
                  <input name='price' type='hidden' value=" . $price . ">
                  <input name='ret_date' type='hidden' value=" . $ret_date . ">
                  <input name='class' type='hidden' value=" . $f_class . ">
                  <button name='book_but' type='submit' 
                  class='btn btn-success mt-0'>
                  <div style=''>
                  <i class='fa fa-lg fa-check'></i>  
                  </div>
                </button>
                </form>
                </td>                                                       
                ";
              }
            }
            echo '</tr> ';
          }

                ?>

      </tbody>
    </table>

  </div>
  <?php } ?>

</main>
<?php subview('footer.php'); ?>
<footer style="position: absolute; bottom: 0; width: 100%; height: 2.5rem;">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom text-uppercase">
    <div class="container text-center text-md-start">
      <div class="row">
        <div class="col-md-3 col-lg-4 col-xl-6 mx-auto font-weight-bold text-white">
          <span>Liện hệ với chúng tôi:</span>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-6 mx-auto">
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="me-4 link-secondary">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 my-auto">
          <img src="assets/images/Jetstarlogo.svg" style="width:100%">
        </div>

        <div class="col-md-2 col-lg-2 col-xl-3 mx-auto mb-4">
          <p class="font-weight-bold mb-4">
            Jetstar
          </p>
          <p>
            <a href="#!" class="text-reset">Giới thiệu công ty</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Đội bay</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Đối tác</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Thông tin truyền thông</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Trách nhiệm xã hội</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Quan hệ cổ đông</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Thông tin đấu thầu</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mb-4">
          <h6 class="font-weight-bold mb-4">
            Pháp lý
          </h6>
          <p>
            <a href="#!" class="text-reset">Các điều kiện & điều khoản</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Điều lệ vận chuyển</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Điều kiện sử dụng Cookies</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Bảo mật thông tin</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="font-weight-bold mb-4">Liên hệ</h6>
          <p><i class="fas fa-home me-3 text-secondary"></i> 19 Nguyễn Hữu Thọ, Quận 7, Tân Phòng, HCM</p>
          <p>
            <i class="fas fa-envelope me-3 text-secondary"></i>
            jetstar@gmail.com
          </p>
          <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
        </div>
      </div>
    </div>
  </section>
</footer>