<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php'; ?>
<?php
$temp = 1;
if (isset($_POST['del_flight']) and isset($_SESSION['adminId'])) {
  $flight_id = $_POST['flight_id'];
  $sql = 'DELETE FROM Flight WHERE flight_id=?';
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('Location: ../index.php?error=sqlerror');
    exit();
  } else {
    $temp = 1;
    mysqli_stmt_bind_param($stmt, 'i', $flight_id);
    try {
      mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $t) {
      echo '<br><br><br><h3 style="color:#FF0000;text-align:center;">Không thể xóa chuyến có người đặt!</h3>';
    }

    $temp = 0;
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // header('Location: all_flights.php');
    echo ("<script> function myMessage() {location.href = 'all_flights.php';}setTimeout(myMessage, 1000);</script>");
    exit();
  }
}
?>

<style>
  table {
    background-color: white;
  }

  h1 {
    margin-top: 20px;
    margin-bottom: 20px;
    font-family: "Times New Roman";
    font-size: 45px !important;
    font-weight: lighter;
  }

  a:hover {
    text-decoration: none;
  }

  body {
    /* background-color: #B0E2FF; */
    background-color: #efefef;
  }

  th {
    font-size: 22px;
    /* font-weight: lighter; */
    /* font-family: 'Courier New', Courier, monospace; */
  }

  td {
    margin-top: 10px !important;
    font-size: 16px;
    font-weight: bold;
    font-family: "Times New Roman", !important;
  }
</style>
<main>
  <?php if (isset($_SESSION['adminId'])) { ?>
  <div class="container-md mt-2">
    <h1 class="display-4 text-center text-secondary">Danh sách các chuyến bay</h1>
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Thời gian đến</th>
          <th scope="col">Thời gian khởi hành</th>
          <th scope="col">Điểm khởi hành</th>
          <th scope="col">Điểm đến</th>
          <th scope="col">Máy bay</th>
          <th scope="col">Số ghế</th>
          <th scope="col">Giá</th>
          <th scope="col">Hành động </th>
        </tr>
      </thead>
      <tbody>

        <?php
    $sql = 'SELECT * FROM Flight ORDER BY flight_id DESC';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "
                  <tr class='text-center'>                  
                    <td scope='row'>
                      <a href='pass_list.php?flight_id=" . $row['flight_id'] . "'>
                      " . $row['flight_id'] . " </a> </td>
                    <td>" . $row['arrivale'] . "</td>
                    <td>" . $row['departure'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['Destination'] . "</td>
                    <td>" . $row['airline'] . "</td>
                    <td>" . $row['Seats'] . "</td>
                    <td> " . $row['Price'] . " VND</td>
                    <td>
                    <form action='all_flights.php' method='post'>
                      <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                      <button  class='btn' type='submit' name='del_flight'>
                      <i class='text-danger fa fa-trash'></i></button>
                    </form>
                    </td>                  
                  </tr>
                  ";
    }
        ?>

      </tbody>
    </table>

  </div>
  <?php } ?>

</main>