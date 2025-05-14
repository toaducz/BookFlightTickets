<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php';?>
<?php
if(isset($_POST['del_customer']) and isset($_SESSION['adminId'])) {
  $user_id = $_POST['user_id'];
  $sql = 'DELETE FROM passenger_profile WHERE user_id=?';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();            
  } else {  

    mysqli_stmt_bind_param($stmt,'i',$user_id);
    try {
      mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $t) {
      echo '<br><br><br><h3 style="color:#FF0000;text-align:center;">Không thể xóa người dùng!</h3>';
    }
    // header('Location: all_flights.php');
  }
  $sql = 'DELETE FROM ticket WHERE user_id=?';
  if(!mysqli_stmt_prepare($stmt,$sql)) {
    header('Location: ../index.php?error=sqlerror');
    exit();            
  } 
  else {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
  }
  $sql = 'DELETE FROM payment WHERE user_id=?';
  if(!mysqli_stmt_prepare($stmt,$sql)) {
    header('Location: ../index.php?error=sqlerror');
    exit();            
  } 
  else {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
  }

  $sql = 'DELETE FROM users WHERE user_id=?';
  if(!mysqli_stmt_prepare($stmt,$sql)) {
    header('Location: ../index.php?error=sqlerror');
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    try {
      mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $t) {
      echo '<br><br><br><h3 style="color:#FF0000;text-align:center;"></h3>';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }

  echo("<script>location.href = 'customer.php';</script>");
  exit(); 
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
  text-align: center;
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
  text-align: center;
  /* font-weight: lighter; */
  /* font-family: 'Courier New', Courier, monospace; */
}
td {
  margin-top: 10px !important;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  font-family: "Times New Roman",  !important;
}
</style>
    <main>
        <?php if(isset($_SESSION['adminId'])) { ?>
          <div class="container-md mt-2">
            <h1 class="display-4 text-center text-secondary"
              >Danh sách tài khoản</h1>
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Usename</th>
                  <th scope="col">Email</th>
                  <th scope="col">Hành động</th>
                </tr>
              </thead>
              <tbody>
                
                <?php
                $sql = 'SELECT * FROM users ORDER BY user_id ASC';
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "
                  <tr class='text-center'>                  
                    <td scope='row'>
                      <a href='pass_list.php?user_id=".$row['user_id']."'>
                      ".$row['user_id']." </a> </td>
                    <td>".$row['username']."</td>
                    <td>".$row['email']."</td>
                    <td>
                    <form action='customer.php' method='post'>
                    <input name='user_id' type='hidden' value=".$row['user_id'].">
                    <button  class='btn' type='submit' name='del_customer'>
                    <i class='text-danger fa fa-trash'></i></button>
                    </td>
                  </form>
                  </tr>
                  ";
                }
                ?>

              </tbody>
            </table>

          </div>
        <?php } ?>

    </main>
	
