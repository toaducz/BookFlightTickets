<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php');
require 'helpers/init_conn_db.php';
?>
<?php
// session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>

<style>
	#errorModal {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		justify-content: center;
		align-items: center;
	}

	#modalContent {
		background-color: white;
		padding: 20px;
		border-radius: 5px;
		text-align: center;
	}

	.btn {
		background-color: #4CAF50;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.btn:hover {
		background-color: #45a049;
	}

	footer {

		bottom: 0;
		width: 100%;
		height: 2.5rem;
	}

	form.logout_form {
		background: transparent;
		padding: 10px !important;
	}

	body {

		background: #bdc3c7;
		background: -webkit-linear-gradient(to right, #ff8b3d, #ADD8E6);
		background: linear-gradient(to right, #ff8b3d, #ADD8E6);
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		font-family: 'Montserrat', sans-serif;

	}

	h5.text-light {
		margin-top: 10px;
	}

	@font-face {
		font-family: "Times New Roman";
	}

	h1 {
		font-family: 'product sans' !important;
		color: cornflowerblue;
		font-size: 50px;
		margin-top: 50px;
		text-align: center;
	}

	.main-agileinfo {
		margin: 50px auto;
		width: 80%;
	}

	/*--SAP--*/
	.sap_tabs {
		border-radius: 25px;
		clear: both;
		padding: 0;
	}

	.tab_box {
		background: #fd926d;
		padding: 2em;
	}

	.top1 {
		margin-top: 2%;
	}

	.resp-tabs-list {
		list-style: none;
		padding: 15px 0px;
		margin: 0 auto;
		text-align: center;
		/* background: rgb(33, 150, 243); */
		background: rgb(255, 140, 0);
	}

	.resp-tab-item {
		font-size: 1.1em;
		font-weight: 500;
		cursor: pointer;
		display: inline-block;
		margin: 0;
		text-align: center;
		list-style: none;
		outline: none;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		-ms-transition: all 0.3s;
		-o-transition: all 0.3s;
		transition: all 0.3s;
		text-transform: uppercase;
		margin: 0 1.2em 0;
		color: #ADD8E6;
		padding: 7px 15px;
	}

	.resp-tab-active {
		color: #fff;
	}

	.resp-tabs-container {
		padding: 0px;
		clear: left;
	}

	h2.resp-accordion {
		cursor: pointer;
		padding: 5px;
		display: none;
	}

	.resp-tab-content {
		display: none;
	}

	.resp-content-active,
	.resp-accordion-active {
		display: block;
	}

	form {
		background: rgba(3, 3, 3, 0.57);
		padding: 25px;
	}

	h3 {
		font-size: 16px;
		color: rgb(255, 255, 255);
		margin-bottom: 7px;
	}

	.from,
	.to,
	.date,
	.depart,
	.return {
		width: 48%;
		float: left;
	}

	.from,
	.to,
	.date {
		margin-bottom: 40px;
	}

	.from,
	.date,
	.depart {
		margin-right: 4%;
	}

	input[type="text"] {
		padding: 10px;
		width: 93%;
		float: left;
	}

	input#datepicker,
	input#datepicker1,
	input#datepicker2,
	input#datepicker3 {
		width: 85%;
		margin-bottom: 10px;
	}

	select#w3_country1 {
		padding: 10px;
		float: left;
	}

	label.checkbox {
		display: inline-block;
	}

	.checkbox {
		position: relative;
		font-size: 0.95em;
		font-weight: normal;
		color: #dedede;
		padding: 0em 0.5em 0em 2em;
	}

	.checkbox i {
		position: absolute;
		bottom: 1px;
		left: 2px;
		display: block;
		width: 18px;
		height: 18px;
		outline: none;
		background: #fff;
		border: 1px solid #6A67CE;
	}

	.checkbox i {
		font-size: 20px;
		font-weight: 400;
		color: #999;
		font-style: normal;
	}

	.checkbox input:checked+i:after {
		opacity: 1;
	}

	.checkbox input+i:after {
		position: absolute;
		opacity: 0;
		transition: opacity 0.1s;
		-o-transition: opacity 0.1s;
		-ms-transition: opacity 0.1s;
		-moz-transition: opacity 0.1s;
		-webkit-transition: opacity 0.1s;
	}

	.checkbox input+i:after {
		content: '';
		background: url("assets/images/tick.png") no-repeat 5px 5px;
		top: -1px;
		left: -1px;
		width: 15px;
		height: 15px;
		font: normal 12px/16px FontAwesome;
		text-align: center;
	}

	input[type="checkbox"] {
		opacity: 0;
		margin: 0;
		display: none;
	}

	.quantity-select .entry.value-minus {
		margin-left: 0;
	}

	.value-minus,
	.value-plus {
		height: 40px;
		line-height: 24px;
		width: 40px;
		margin-right: 3px;
		display: inline-block;
		cursor: pointer;
		position: relative;
		font-size: 18px;
		color: #fff;
		text-align: center;
		-webkit-user-select: none;
		-moz-user-select: none;
		border: 1px solid #b2b2b2;
		vertical-align: bottom;
	}

	.value {
		cursor: default;
		width: 40px;
		height: 33px;
		color: #000;
		line-height: 24px;
		border: 1px solid #E5E5E5;
		background-color: #fff;
		text-align: center;
		display: inline-block;
		margin-right: 3px;
		padding-top: 7px;
	}

	.quantity-select .entry.value-minus:hover,
	.quantity-select .entry.value-plus:hover {
		background: rgba(0, 0, 0, 0.6);
		;
	}

	.value-minus,
	.value-plus {
		height: 40px;
		line-height: 24px;
		width: 40px;
		margin-right: 3px;
		display: inline-block;
		cursor: pointer;
		position: relative;
		font-size: 18px;
		text-align: center;
		-webkit-user-select: none;
		-moz-user-select: none;
		border: 1px solid #b2b2b2;
		vertical-align: bottom;
	}

	.quantity-select .entry.value-minus:before,
	.quantity-select .entry.value-plus:before {
		content: "";
		width: 13px;
		height: 2px;
		background: #fff;
		left: 50%;
		margin-left: -7px;
		top: 50%;
		margin-top: -0.5px;
		position: absolute;
	}

	.quantity-select .entry.value-plus:after {
		content: "";
		height: 13px;
		width: 2px;
		background: #fff;
		left: 50%;
		margin-left: -1.4px;
		top: 50%;
		margin-top: -6.2px;
		position: absolute;
	}

	.numofppl,
	.adults,
	.child {
		width: 50%;
		float: left;
	}

	.class {
		width: 48%;
		float: left;
	}

	input[type="submit"] {
		font-size: 18px;
		color: #fff;
		background: #4caf50;
		border: none;
		outline: none;
		padding: 10px 20px;
		margin-top: 50px;
		cursor: pointer;
		transition: 0.5s all ease;
		-webkit-transition: 0.5s all ease;
		-moz-transition: 0.5s all ease;
		-o-transition: 0.5s all ease;
		-ms-transition: 0.5s all ease;
		margin-left: 37%;
	}

	input[type="submit"]:hover {
		background: #212121;
		color: #fff;
	}

	/*-- load-more --*/
	ul#myList {
		margin-bottom: 2em;
	}

	#myList li {
		display: none;
		list-style-type: none;
	}

	#loadMore,
	#showLess {
		display: inline-block;
		cursor: pointer;
		padding: 7px 20px;
		background: #fff;
		font-size: 14px;
		color: #fff;
		transition: 0.5s all ease;
		-webkit-transition: 0.5s all ease;
		-moz-transition: 0.5s all ease;
		-o-transition: 0.5s all ease;
		-ms-transition: 0.5s all ease;
		background: rgb(33, 150, 243);
	}

	#loadMore:hover {
		background: #212121;
		color: #fff;
	}

	.spcl {
		position: relative;
	}

	.ui-datepicker {
		width: 16.2%;
		padding: 0 0em 0;
	}

	.ui-datepicker .ui-datepicker-header {
		position: relative;
		padding: .56em 0;
		background: rgb(33, 150, 243);
		;
		text-transform: uppercase;
	}

	form.blackbg {
		background: rgba(3, 3, 3, 0.57);
	}

	/*-- //load-more --*/
	.footer-w3l {
		margin: 50px 0 15px 0;
	}

	.footer-w3l p {
		font-size: 14px;
		text-align: center;
		color: #000;
		line-height: 27px;
	}

	.footer-w3l p a {
		color: #000;
	}

	.footer-w3l p a:hover {
		text-decoration: underline;
	}

	/*-- responsive --*/
	@media (max-width:1440px) {
		.checkbox {
			font-size: 0.9em;
		}
	}

	@media (max-width:1366px) {
		.main-agileinfo {
			width: 53%;
		}
	}

	@media (max-width:1280px) {
		.main-agileinfo {
			width: 57%;
		}
	}

	@media (max-width:1080px) {
		h1 {
			color: #fff;
			font-size: 47px;
		}

		.main-agileinfo {
			width: 68%;
		}
	}

	@media (max-width:1024px) {
		.main-agileinfo {
			width: 71%;
		}
	}

	@media (max-width:991px) {

		.from,
		.to,
		.date,
		.depart,
		.return {
			width: 49%;
			float: left;
		}

		.from,
		.date,
		.depart {
			margin-right: 2%;
		}
	}

	@media (max-width:966px) {
		.main-agileinfo {
			width: 73%;
		}

	}

	@media (max-width:900px) {
		.checkbox {
			font-size: 0.82em;
		}
	}

	@media (max-width:800px) {
		.main-agileinfo {
			width: 81%;
		}
	}

	@media (max-width:768px) {
		.main-agileinfo {
			width: 85%;
		}

		.checkbox i {
			width: 15px;
			height: 15px;
		}

		.checkbox input+i:after {
			top: -3px;
			left: -3px;
		}
	}

	@media (max-width:736px) {
		.main-agileinfo {
			width: 88%;
			margin: 40px auto;
		}

		h1 {
			color: #fff;
			font-size: 43px;
			margin-top: 40px;
		}

		input[type="text"] {
			padding: 10px;
			width: 90%;
			float: left;
		}

		input#datepicker,
		input#datepicker1,
		input#datepicker2,
		input#datepicker3 {
			width: 79%;
		}

		.value-minus,
		.value-plus {
			height: 30px;
			width: 30px;
		}

		.value {
			width: 33px;
			height: 25px;
			padding-top: 6px;
		}
	}

	@media (max-width:667px) {
		.numofppl {
			width: 60%;
		}

		.roundtrip .date {
			width: 68%;
			float: left;
		}

		.roundtrip .class {
			width: 30%;
			float: left;
		}

		.oneway .depart,
		.multicity .depart {
			width: 68%;
		}
	}

	@media (max-width:600px) {
		select#w3_country1 {
			width: 100%;
		}
	}

	@media (max-width:568px) {
		h1 {
			font-size: 40px;
		}

		.resp-tab-item {
			padding: 7px 13px;
			margin: 0 1em 0;
		}

		.numofppl {
			width: 70%;
		}
	}

	@media (max-width:480px) {
		.resp-tab-item {
			padding: 7px 7px;
			margin: 0 0.7em 0;
		}

		input[type="text"] {
			padding: 10px;
			width: 86%;
			float: left;
		}

		.roundtrip .date {
			width: 100%;
			float: left;
		}

		input#datepicker,
		input#datepicker1,
		input#datepicker2,
		input#datepicker3 {
			width: 86%;
		}

		.roundtrip .class {
			width: 100%;
			float: left;
			margin-bottom: 40px;
		}

		.numofppl {
			width: 80%;
		}

		.oneway .depart,
		.multicity .depart {
			width: 100%;
		}
	}

	@media (max-width:414px) {
		h1 {
			font-size: 35px;
			margin-top: 30px;
		}

		.resp-tab-item {
			padding: 7px 7px;
			margin: 0 0.5em 0;
			font-size: 15px;
		}

		.numofppl {
			width: 100%;
		}
	}

	@media (max-width:384px) {
		h1 {
			font-size: 32px;
		}

		h3 {
			font-size: 15px;
		}

		.from,
		.to,
		.date,
		.depart,
		.return {
			width: 100%;
			float: left;
			margin-bottom: 25px;
		}

		.date {
			margin-bottom: 0;
		}

		.resp-tab-item {
			padding: 7px 7px;
			margin: 0 0em 0;
			font-size: 15px;
		}

		.class {
			width: 100%;
			float: left;
			margin-bottom: 40px;
		}

		input[type="text"] {
			padding: 10px;
			width: 91.5%;
		}

		input#datepicker,
		input#datepicker1,
		input#datepicker2,
		input#datepicker3 {
			width: 91.5%;
		}
	}

	@media (max-width:320px) {
		h1 {
			font-size: 26px;
			margin-top: 25px;
		}

		form {
			padding: 15px;
		}

		.resp-tab-item {
			padding: 7px 5px;
			margin: 0 0em 0;
			font-size: 14px;
		}

		.adults,
		.child {
			width: 100%;
			float: left;
		}

		.adults {
			margin-bottom: 25px;
		}
	}

	@font-face {
		font-family: "Times New Roman";

	}

	h1 {
		font-family: 'product sans';
		/* font-style: italic; */
		font-size: 40px !important;
	}
</style>
<div id="errorModal">
	<div id="modalContent">
		<h3 style="color: red;"><?php echo $error_message; ?></h3>
		<button class="btn" onclick="window.location.href = 'index.php';">OK</button>
	</div>
</div>

<script>
	<?php if ($error_message): ?>
		$(document).ready(function () {
			$('#errorModal').show();
		});
	<?php endif; ?>
</script>
<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] === 'sameval') {
		echo '<script>alert("Chọn giá trị khác nhau cho thành phố khởi hành và thành phố đến")</script>';
	} else if ($_GET['error'] === 'seldep') {
		echo '<script>alert("Chọn thành phố khởi hành")</script>';
	} else if ($_GET['error'] === 'selarr') {
		echo "<script>alert('Chọn thành phố đến')</script>";
	}
}
?>
<link rel="stylesheet" type="text/css"
	href="styles%2c_bootstrap4%2c_bootstrap.min.css%2bplugins%2c_font-awesome-4.7.0%2c_css%2c_font-awesome.min.css%2bplugins%2c_OwlCarousel2-2.2.1%2c_owl.carousel.css%2bplugins%2c_OwlCarousel2-2.2.1%2c_owl" />
<meta name="keywords" />
<script
	type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } ;</script>
<div class="main-agileinfo">
	<!-- <h3 class="text-light brand mt-2">
			<img src="assets/images/airtic.png" 
				height="105px" width="105px" alt="">Hệ thống đặt vé máy bay trực tuyến</h3> -->
	<div class="slideshow-container">
		<div class="mySlides fade">
			<div class="numbertext"></div>
			<img src="assets/images/1.jpg" style="width:100%">
		</div>

		<div class="mySlides fade">
			<div class="numbertext"></div>
			<img src="assets/images/Tokyo.jpg" style="width:100%">
		</div>

		<div class="mySlides fade">
			<div class="numbertext"></div>
			<img src="assets/images/hanoi.jpg" style="width:100%">
		</div>

		<a class="prev" onclick="plusSlides(-1)">❮</a>
		<a class="next" onclick="plusSlides(1)">❯</a>

	</div>
	<!-- <br> -->
	<div class="sap_tabs">
		<div id="horizontalTab">
			<ul class="resp-tabs-list">
				<li class="resp-tab-item"><span>Khứ hồi</span></li>
				<li class="resp-tab-item"><span>Một chiều</span></li>
			</ul>
			<div class="clearfix"> </div>
			<div class="resp-tabs-container">
				<div class="tab-1 resp-tab-content roundtrip">
					<form action="book_flight.php" method="post">
						<input type="hidden" name="type" value="round">
						<div class="from">
							<h3 style="color: rgba(255, 255, 255, 0.767);">Từ</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select class="" name="dep_city" id="w3_country1">';

							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='" . $row["city"] . "'>" . $row["city"] . "</option>";
							}
							?>
							</select>
						</div>
						<div class="to">
							<h3 style="color: rgba(255, 255, 255, 0.767);">Đến</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="arr_city" id="w3_country1">';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='" . $row["city"] . "'>" . $row["city"] . "</option>";
							}
							?>
							</select>
						</div>
						<div class="clear"></div>
						<div class="date">
							<div class="depart">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Khởi hành</h3>
								<input class="form-control" name="dep_date" type="date" onfocus="this.value = '';"
									onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>

							<div class="return">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Trở về</h3>
								<input class="form-control" name="ret_date" type="date" onfocus="this.value = '';"
									onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>
							<input type="hidden" name="code" value="1">
							<div class="clear"></div>
						</div>
						<div class="class">
							<h3 style="color: rgba(255, 255, 255, 0.767);">Khoang dịch vụ</h3>
							<select id="w3_country1" name="f_class" onchange="change_country(this.value)"
								class="frm-field required">
								<option value="E">Phổ thông</option>
								<option value="B">Thương gia</option>
							</select>

						</div>
						<div class="clear"></div>
						<div class="numofppl">
							<div class="adults">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Hành khách</h3>
								<div class="quantity">
									<div class="quantity-select">
										<div class="entry value-minus">&nbsp;</div>
										<div class="entry value"><span>1</span></div>
										<input type="hidden" name="passengers" class="input_val" value="1">
										<div class="entry value-plus active">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<input type="hidden" name="code" value="1">
						<input type="submit" value="Tìm kiếm" name="search_but">
					</form>
				</div>
				<div class="tab-1 resp-tab-content oneway">
					<form action="book_flight.php" method="post">
						<input type="hidden" name="type" value="one">
						<div class="from">
							<h3 style="color: rgba(255, 255, 255, 0.767);">Từ</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="dep_city" id="w3_country1">';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='" . $row["city"] . "'>" . $row["city"] . "</option>";
							}
							?>
							</select>
						</div>
						<div class="to">
							<h3>Đến</h3>
							<?php
							$sql = 'SELECT * FROM Cities ';
							$stmt = mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo '<select value="0" name="arr_city" id="w3_country1">';
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='" . $row["city"] . "'>" . $row["city"] . "</option>";
							}
							?>
							</select>
						</div>
						<div class="clear"></div>
						<div class="date">
							<div class="depart">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Khởi hành</h3>
								<input name="dep_date" type="date" class="form-control" onfocus="this.value = '';"
									onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
							</div>
						</div>
						<div class="class">
							<h3 style="color: rgba(255, 255, 255, 0.767);">Khoang dịch vụ</h3>
							<select id="w3_country1" name="f_class" onchange="change_country(this.value)"
								class="frm-field required">
								<option value="E">Phổ thông</option>
								<option value="B">Thương gia</option>
							</select>

						</div>
						<div class="clear"></div>
						<div class="numofppl">
							<div class="adults">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Hành khách</h3>
								<div class="quantity">
									<div class="quantity-select">
										<div class="entry value-minus">&nbsp;</div>
										<div class="entry value"><span>1</span></div>
										<input type="hidden" name="passengers" class="input_val" value="1">
										<div class="entry value-plus active">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<input type="hidden" name="code" value="0">
						<input type="submit" value="Tìm kiếm" name="search_but">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<style>
	.intro {
		width: 100%;
		background: #fff;
		z-index: 1
	}

	.intro_background {
		top: -128px;
		left: 0;
		width: 100%;
		height: 20px;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center center
	}

	.intro_container {
		width: 100%;
		border-bottom: solid 2px #e4e6e8;
		padding-top: 0px;
		padding-bottom: 0px
	}

	.intro_icon {
		width: 70px;
		height: 71px
	}

	.intro_icon img {
		max-width: 100%
	}

	.intro_content {
		padding-left: 28px
	}

	.intro_title {
		font-family: "Times New Roman", sans-serif;
		font-size: 18px;
		color: #181818;
		font-weight: 400
	}

	.destinations {
		width: 100%;
		background: #fff;
		padding-top: 115px;
		padding-bottom: 116px
	}

	div.card {
		-webkit-transition: 0.4s ease;
		transition: 0.4s ease;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.col-lg-6:hover div.card {
		-webkit-transform: scale(1.08);
		transform: scale(0.89);
	}

	/* .card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
	overflow: hidden;
} */
	.card img {
		width: 100%;
		height: 370px;
		object-fit: cover;
		transition: all .25s ease;
	}

	* {
		box-sizing: border-box
	}

	body {
		font-family: Verdana, sans-serif;
		margin: 0
	}

	.mySlides {
		display: none
	}

	img {
		vertical-align: middle;
	}

	/* Slideshow container */
	.slideshow-container {
		position: relative;
		margin: auto;
		height: 52vh;
		width: 100%;
		overflow: hidden;
	}

	/* Next & previous buttons */
	.prev,
	.next {
		cursor: pointer;
		position: absolute;
		top: 50%;
		width: auto;
		padding: 16px;
		margin-top: -22px;
		color: white;
		font-weight: bold;
		font-size: 18px;
		transition: 0.6s ease;
		border-radius: 0 3px 3px 0;
		user-select: none;
	}

	/* Position the "next button" to the right */
	.next {
		right: 0;
		border-radius: 3px 0 0 3px;
	}

	/* On hover, add a black background color with a little bit see-through */
	.prev:hover,
	.next:hover {
		background-color: rgba(0, 0, 0, 0.8);
	}

	/* Caption text */
	.text {
		color: #f2f2f2;
		font-size: 15px;
		padding: 8px 12px;
		position: absolute;
		bottom: 8px;
		width: 100%;
		text-align: center;
	}

	/* Number text (1/3 etc) */
	.numbertext {
		color: #f2f2f2;
		font-size: 12px;
		padding: 8px 12px;
		position: absolute;
		top: 0;
	}

	/* The dots/bullets/indicators */
	.dot {
		cursor: pointer;
		height: 15px;
		width: 15px;
		margin: 0 2px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
		transition: background-color 0.6s ease;
	}

	.active,
	.dot:hover {
		background-color: #717171;
	}

	/* Fading animation */
	.fade {
		animation-name: fade;
		animation-duration: 1.5s;
		animation-fill-mode: forwards;
	}

	@keyframes fade {
		from {
			opacity: .4
		}

		to {
			opacity: 1
		}
	}

	/* On smaller screens, decrease text size */
	@media only screen and (max-width: 300px) {

		.prev,
		.next,
		.text {
			font-size: 11px
		}
	}
</style>
<!-- test -->

<div class="conatiner-fluid p-4" style="background-color: whitesmoke;margin-top:150px;">
	<!-- <h2 class="text-center mb-3 mt-3 display-4"
	   style="font-style: normal;font-size:80px;">Main Attractions In India</h2>   
	<div class="row p-5 pb-0"> -->
	<div class="intro">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="row">
						<!-- Intro Item -->
						<div class="col-lg-4 intro_col">

							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/sale_qc.jpg" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Đăng ký Jetmail</div>
										<div class="content_item text-center">Hãy là một trong những người đầu tiên biết
											về địa điểm và thời gian chúng
											tôi bay. Chúng tôi cũng sẽ thông báo cho bạn về việc bán vé máy bay và các
											ưu đãi hấp dẫn khác.
										</div>
									</div>
									<div class="container bg-light text-center">
										<a href="register.php"><button type="button" class="btn btn-primary m-3">Đăng ký
												ngay</button></a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 intro_col">

							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/covid_qc.jpg" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Trung tâm trợ giúp
											COVID-19</div>
										<div class="content_item text-center">Hãy cập nhật những thông tin quan trọng về
											du lịch trong thời gian này. Truy cập Trung tâm trợ
											giúp COVID-19 của chúng tôi trước khi bạn đặt chỗ và trước khi bạn đi du
											lịch.
										</div>
									</div>
									<div class="container bg-light text-center">
										<button type="button" class="btn btn-primary m-3">Đọc thêm</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 intro_col">

							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/traval_qc.webp" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Yêu cầu đi lại</div>
										<div class="content_item text-center">Trước khi bạn đặt chỗ và trước khi đi du
											lịch, hãy kiểm tra các yêu cầu nhập cảnh và
											xuất cảnh mới nhất đối với các điểm đến trên khắp thế giới bằng bản đồ tương
											tác.
										</div>
									</div>
									<div class="container bg-light text-center">
										<button type="button" class="btn btn-primary m-3">Tìm hiểu thêm</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<footer class="">
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

<?php subview('footer.php'); ?>

<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default',
			width: 'auto',
			fit: true
		});
	});		
</script>
<script>
	$('.value-plus').on('click', function () {
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) + 1;
		divUpd.text(newVal);
		$('.input_val').val(newVal);
	});

	$('.value-minus').on('click', function () {
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) - 1;
		if (newVal >= 1) {
			divUpd.text(newVal);
			$('.input_val').val(newVal);
		}
	});
</script>
<!--//quantity-->
<!--load more-->
<script>
	$(document).ready(function () {
		size_li = $("#myList li").size();
		x = 1;
		$('#myList li:lt(' + x + ')').show();
		$('#loadMore').click(function () {
			x = (x + 1 <= size_li) ? x + 1 : size_li;
			$('#myList li:lt(' + x + ')').show();
		});
		$('#showLess').click(function () {
			x = (x - 1 < 0) ? 1 : x - 1;
			$('#myList li').not(':lt(' + x + ')').hide();
		});
	});

</script>
<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("dot");
		if (n > slides.length) { slideIndex = 1 }
		if (n < 1) { slideIndex = slides.length }
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " active";
	}
</script>
<?php include_once 'helpers/helper.php'; ?>
	<?php subview('header.php'); 
    require 'helpers/init_conn_db.php';                      
	?> 	
<style>

footer {
  
  bottom: 0;
  width: 100%;
  height: 2.5rem;            
}
form.logout_form {
	background: transparent;
	padding: 10px !important;
}
body {
	
	background: #bdc3c7; 
	background: -webkit-linear-gradient(to right,  #ff8b3d,   #ADD8E6); 
	background: linear-gradient(to right,  #ff8b3d, #ADD8E6 ); 
}

h1,h2,h3,h4,h5,h6{
	font-family: 'Montserrat', sans-serif;
	
}
h5.text-light {
	margin-top: 10px;
}
@font-face {
  font-family: "Times New Roman";
}
h1{
    font-family :'product sans' !important;
	color:cornflowerblue ;
	font-size:50px;
	margin-top:50px;
	text-align:center;
}

.main-agileinfo{
	margin:50px auto;
	width:80%;
}
/*--SAP--*/
.sap_tabs{
	border-radius: 25px;
	clear:both;
	padding: 0;
}
.tab_box{
	background:#fd926d;
	padding: 2em;
}
.top1{
	margin-top: 2%;
}
.resp-tabs-list {
    list-style: none;
    padding: 15px 0px;
    margin: 0 auto;
    text-align: center;
	/* background: rgb(33, 150, 243); */
	background: rgb(255,140,0);
}
.resp-tab-item {
    font-size: 1.1em;
    font-weight: 500;
    cursor: pointer;
    display: inline-block;
    margin: 0;
    text-align: center;
    list-style: none;
    outline: none;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    text-transform: uppercase;
    margin: 0 1.2em 0;
	color:#ADD8E6;
	padding:7px 15px;
}

.resp-tab-active {
	color:#fff;	
}
.resp-tabs-container {
	padding: 0px;
	clear: left;	
}
h2.resp-accordion {
	cursor: pointer;
	padding: 5px;
	display: none;
}
.resp-tab-content {
	display: none;
}
.resp-content-active, .resp-accordion-active {
   display: block;
}
form {
    background:rgba(3, 3, 3, 0.57);
    padding: 25px;
}

h3 {
    font-size: 16px;
    color:rgb(255, 255, 255);
    margin-bottom: 7px;
}
.from,.to,.date,.depart,.return{
	width:48%;
	float:left;
}

.from,.to,.date{
	margin-bottom:40px;
}
.from,.date,.depart{
	margin-right:4%;
}
input[type="text"]{
	padding:10px;
	width:93%;
	float:left;
}
input#datepicker,input#datepicker1,input#datepicker2,input#datepicker3 {
    width: 85%;
	margin-bottom:10px;
}
select#w3_country1 {
    padding: 10px;
	float:left;
}
label.checkbox {
  display: inline-block;
}
.checkbox {
    position: relative;
    font-size: 0.95em;
    font-weight: normal;
    color:#dedede;
    padding: 0em 0.5em 0em 2em;
}
.checkbox i {
    position: absolute;
    bottom: 1px;
    left: 2px;
    display: block;
    width: 18px;
    height: 18px;
    outline: none;
    background: #fff;
    border: 1px solid #6A67CE;
}
.checkbox i {
    font-size: 20px;
    font-weight: 400;
    color: #999;
    font-style: normal;
}
.checkbox input:checked + i:after {
    opacity: 1;
}
.checkbox input + i:after {
    position: absolute;
    opacity: 0;
    transition: opacity 0.1s;
    -o-transition: opacity 0.1s;
    -ms-transition: opacity 0.1s;
    -moz-transition: opacity 0.1s;
    -webkit-transition: opacity 0.1s;
}
.checkbox input + i:after {
    content: '';
    background: url("assets/images/tick.png") no-repeat 5px 5px;
    top: -1px;
    left: -1px;
    width: 15px;
    height: 15px;
    font: normal 12px/16px FontAwesome;
    text-align: center;
}
input[type="checkbox"]{
	opacity:0;
	margin:0;
	display:none;
}

.quantity-select .entry.value-minus {
    margin-left: 0;
}
.value-minus, .value-plus {
    height: 40px;
    line-height: 24px;
    width: 40px;
    margin-right: 3px;
    display: inline-block;
    cursor: pointer;
    position: relative;
    font-size: 18px;
    color: #fff;
    text-align: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    border: 1px solid #b2b2b2;
    vertical-align: bottom;
}

.value {
    cursor: default;
    width: 40px;
    height:33px;
    color: #000;
    line-height: 24px;
    border: 1px solid #E5E5E5;
    background-color: #fff;
    text-align: center;
    display: inline-block;
    margin-right: 3px;
	padding-top:7px;
}

.quantity-select .entry.value-minus:hover, .quantity-select .entry.value-plus:hover {
    background:rgba(0, 0, 0, 0.6);;
}
.value-minus, .value-plus {
    height: 40px;
    line-height: 24px;
    width: 40px;
    margin-right: 3px;
    display: inline-block;
    cursor: pointer;
    position: relative;
    font-size: 18px;
    text-align: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    border: 1px solid #b2b2b2;
    vertical-align: bottom;
}
.quantity-select .entry.value-minus:before, .quantity-select .entry.value-plus:before {
    content: "";
    width: 13px;
    height: 2px;
    background: #fff;
    left: 50%;
    margin-left: -7px;
    top: 50%;
    margin-top: -0.5px;
    position: absolute;
}
.quantity-select .entry.value-plus:after {
    content: "";
    height: 13px;
    width: 2px;
    background: #fff;
    left: 50%;
    margin-left: -1.4px;
    top: 50%;
    margin-top: -6.2px;
    position: absolute;
}

.numofppl,.adults,.child{
	width:50%;
	float:left;
}
.class{
	width:48%;
	float:left;
}
input[type="submit"] {
    font-size: 18px;
    color: #fff;
    background:#4caf50;
    border: none;
    outline: none;
    padding: 10px 20px;
    margin-top: 50px;
	cursor:pointer;
	 transition: 0.5s all ease;
    -webkit-transition: 0.5s all ease;
    -moz-transition: 0.5s all ease;
    -o-transition: 0.5s all ease;
    -ms-transition: 0.5s all ease;
	margin-left:37%;
}
input[type="submit"]:hover  {
    background:#212121;
	color:#fff;
}
/*-- load-more --*/
ul#myList{
	margin-bottom:2em;
}
#myList li{ 
	display:none;
	list-style-type:none;
}
#loadMore,#showLess {
	display: inline-block;
    cursor: pointer;
    padding: 7px 20px;
    background: #fff;
    font-size: 14px;
    color: #fff;
    transition: 0.5s all ease;
    -webkit-transition: 0.5s all ease;
    -moz-transition: 0.5s all ease;
    -o-transition: 0.5s all ease;
    -ms-transition: 0.5s all ease;
    background: rgb(33, 150, 243);
}
#loadMore:hover  {
    background:#212121;
	color:#fff;
}

.spcl{
	position:relative;
}

.ui-datepicker {width:16.2%;
	padding: 0 0em 0;
	}
	.ui-datepicker .ui-datepicker-header {
	  position: relative;
	  padding: .56em 0;
	  background:rgb(33, 150, 243);;
	  text-transform: uppercase;
	}

form.blackbg{
	background:rgba(3, 3, 3, 0.57);
}
/*-- //load-more --*/
.footer-w3l {
    margin: 50px 0 15px 0;
}
.footer-w3l p{
	font-size:14px;
	text-align:center;
	color:#000;
	line-height:27px;
}
.footer-w3l p a{
	color:#000;
}
.footer-w3l p a:hover{
	text-decoration:underline;
}
/*-- responsive --*/
 @media (max-width:1440px){
	.checkbox {
		font-size: 0.9em;
	}
}
 @media (max-width:1366px){
	.main-agileinfo {
		width: 53%;
	}
}
 @media (max-width:1280px){
	.main-agileinfo {
		width: 57%;
	}
}
 @media (max-width:1080px){
	h1 {
		color: #fff;
		font-size: 47px;
	}
	.main-agileinfo {
		width: 68%;
	}
}
 @media (max-width:1024px){
	.main-agileinfo {
		width: 71%;
	}
}
 @media (max-width:991px){
	.from, .to, .date, .depart, .return {
		width: 49%;
		float: left;
	}
	.from, .date, .depart {
		margin-right: 2%;
	}
}
 @media (max-width:966px){
	.main-agileinfo {
		width: 73%;
	}
	
}
 @media (max-width:900px){
	.checkbox {
		font-size: 0.82em;
	}
}
 @media (max-width:800px){
	.main-agileinfo {
		width: 81%;
	}
}
 @media (max-width:768px){
	.main-agileinfo {
		width: 85%;
	}
	.checkbox i {
		width: 15px;
		height: 15px;
	}
	.checkbox input + i:after {
		top: -3px;
		left: -3px;
	}
}
 @media (max-width:736px){
	.main-agileinfo {
		width: 88%;
		margin:40px auto;
	}
	h1 {
		color: #fff;
		font-size: 43px;
		margin-top:40px;
	}
	input[type="text"] {
		padding: 10px;
		width: 90%;
		float: left;
	}
	input#datepicker, input#datepicker1, input#datepicker2, input#datepicker3 {
		width: 79%;
	}
	.value-minus, .value-plus {
		height: 30px;
		width: 30px;
	}
	.value {
		width: 33px;
		height: 25px;
		padding-top: 6px;
	}
}
 @media (max-width:667px){
	.numofppl {
		width: 60%;
	}
	.roundtrip .date {
		width: 68%;
		float:left;
	}
	.roundtrip .class{
		width:30%;
		float:left;
	}
	.oneway .depart,.multicity .depart{
		width: 68%;
	}
}
 @media (max-width:600px){
	select#w3_country1 {
		width: 100%;
	}
}
 @media (max-width:568px){
	h1 {
		font-size: 40px;
	}
	.resp-tab-item {
		padding: 7px 13px;
		margin: 0 1em 0;
	}
	.numofppl {
		width: 70%;
	}
}
 @media (max-width:480px){
	.resp-tab-item {
		padding: 7px 7px;
		margin: 0 0.7em 0;
	}
	 input[type="text"] {
		padding: 10px;
		width: 86%;
		float: left;
	}
	.roundtrip .date {
		width: 100%;
		float: left;
	}
	input#datepicker, input#datepicker1, input#datepicker2, input#datepicker3 {
		width: 86%;
	}
	.roundtrip .class{
		width: 100%;
		float: left;
		margin-bottom:40px;
	}
	.numofppl {
		width: 80%;
	}
	.oneway .depart, .multicity .depart {
		width: 100%;
	}
}
 @media (max-width:414px){
	h1 {
		font-size: 35px;
		margin-top:30px;
	}
	.resp-tab-item {
		padding: 7px 7px;
		margin: 0 0.5em 0;
		font-size: 15px;
	}
	.numofppl {
		width: 100%;
	}
}
 @media (max-width:384px){
	h1 {
		font-size: 32px;
	}
	h3 {
		font-size: 15px;
	}
	.from, .to, .date, .depart, .return {
		width: 100%;
		float: left;
		margin-bottom:25px;
	}
	.date{
		margin-bottom:0;
	}
	.resp-tab-item {
		padding: 7px 7px;
		margin: 0 0em 0;
		font-size: 15px;
	}
	.class {
		width: 100%;
		float: left;
		margin-bottom: 40px;
	}
	input[type="text"] {
		padding: 10px;
		width: 91.5%;
	}
	input#datepicker, input#datepicker1, input#datepicker2, input#datepicker3 {
		width: 91.5%;
	}
}
 @media (max-width:320px){
	h1 {
		font-size: 26px;
		margin-top:25px;
	}
	form{
		padding:15px;
	}
	.resp-tab-item {
		padding: 7px 5px;
		margin: 0 0em 0;
		font-size: 14px;
	}
	.adults, .child {
		width: 100%;
		float: left;
	}
	.adults{
		margin-bottom:25px;
	}
}
@font-face {
  font-family: "Times New Roman";

}
h1 {
	font-family: 'product sans';
    /* font-style: italic; */
    font-size: 40px !important;	
}	
</style>
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'sameval') {
		  echo '<script>alert("Chọn giá trị khác nhau cho thành phố khởi hành và thành phố đến")</script>';
      } else if($_GET['error'] === 'seldep') {
          echo '<script>alert("Chọn thành phố khởi hành")</script>';
      } else if($_GET['error'] === 'selarr') {
          echo"<script>alert('Chọn thành phố đến')</script>";
      }
    }
?>
<link rel="stylesheet" type="text/css"
        href="styles%2c_bootstrap4%2c_bootstrap.min.css%2bplugins%2c_font-awesome-4.7.0%2c_css%2c_font-awesome.min.css%2bplugins%2c_OwlCarousel2-2.2.1%2c_owl.carousel.css%2bplugins%2c_OwlCarousel2-2.2.1%2c_owl" />
	<meta name="keywords"/>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } ;</script>	
	<div class="main-agileinfo">
		<!-- <h3 class="text-light brand mt-2">
			<img src="assets/images/airtic.png" 
				height="105px" width="105px" alt="">Hệ thống đặt vé máy bay trực tuyến</h3> -->
		<div class="slideshow-container">
			<div class="mySlides fade">
				<div class="numbertext"></div>
				<img src="assets/images/1.jpg" style="width:100%">
				</div>

				<div class="mySlides fade">
				<div class="numbertext"></div>
				<img src="assets/images/Tokyo.jpg" style="width:100%">
				</div>

				<div class="mySlides fade">
				<div class="numbertext"></div>
				<img src="assets/images/hanoi.jpg" style="width:100%">
			</div>

			<a class="prev" onclick="plusSlides(-1)">❮</a>
			<a class="next" onclick="plusSlides(1)">❯</a>

		</div>
		<!-- <br> -->
		<div class="sap_tabs">			
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"><span>Khứ hồi</span></li>
					<li class="resp-tab-item"><span>Một chiều</span></li>
				</ul>	
				<div class="clearfix"> </div>	
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content roundtrip">
						<form action="book_flight.php" method="post">
							<input type="hidden" name="type" value="round">
							<div class="from">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Từ</h3>
								<?php
								$sql = 'SELECT * FROM Cities ';
								$stmt = mysqli_stmt_init($conn);
								mysqli_stmt_prepare($stmt,$sql);         
								mysqli_stmt_execute($stmt);          
								$result = mysqli_stmt_get_result($stmt);    
								echo '<select class="" name="dep_city" id="w3_country1">';
								
								while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='".$row["city"]."'>" . $row["city"]. "</option>";
								}
								?>
								</select>  
							</div>
							<div class="to">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Đến</h3>
								<?php
								$sql = 'SELECT * FROM Cities ';
								$stmt = mysqli_stmt_init($conn);
								mysqli_stmt_prepare($stmt,$sql);         
								mysqli_stmt_execute($stmt);          
								$result = mysqli_stmt_get_result($stmt);
                                echo '<select value="0" name="arr_city" id="w3_country1">';
								while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='".$row["city"]."'>" . $row["city"]. "</option>";
								}
								?>
								</select>							
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3 style="color: rgba(255, 255, 255, 0.767);">Khởi hành</h3>
									<input class="form-control" name="dep_date" type="date"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
								</div>
	
								<div class="return">
									<h3 style="color: rgba(255, 255, 255, 0.767);">Trở về</h3>
									<input class="form-control"  name="ret_date" type="date" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
								</div>
								<input type="hidden" name="code" value="1">
								<div class="clear"></div>
							</div>
							<div class="class">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Khoang dịch vụ</h3>
								<select id="w3_country1" 
									name="f_class" onchange="change_country(this.value)" class="frm-field required">
									<option value="E">Phổ thông</option>  
									<option value="B">Thương gia</option>   
								</select>

							</div>
							<div class="clear"></div>
							<div class="numofppl">
								<div class="adults">
									<h3 style="color: rgba(255, 255, 255, 0.767);">Hành khách</h3>
									<div class="quantity"> 
										<div class="quantity-select">                           
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value"><span>1</span></div>
											<input type="hidden" name="passengers"
												 class="input_val" value="1">
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
							<input type="hidden" name="code" value="1">
							<input type="submit"  value="Tìm kiếm" name="search_but">
						</form>						
					</div>
					<div class="tab-1 resp-tab-content oneway">
						<form action="book_flight.php" method="post">
							<input type="hidden" name="type" value="one">
							<div class="from">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Từ</h3>								
								<?php
								$sql = 'SELECT * FROM Cities ';
								$stmt = mysqli_stmt_init($conn);
								mysqli_stmt_prepare($stmt,$sql);         
								mysqli_stmt_execute($stmt);          
								$result = mysqli_stmt_get_result($stmt);    
								echo '<select value="0" name="dep_city" id="w3_country1">';
								while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='".$row["city"]."'>" . $row["city"]. "</option>";
								}
								?>
								</select> 														
							</div>
							<div class="to">
								<h3>Đến</h3>								
								<?php
								$sql = 'SELECT * FROM Cities ';
								$stmt = mysqli_stmt_init($conn);
								mysqli_stmt_prepare($stmt,$sql);         
								mysqli_stmt_execute($stmt);          
								$result = mysqli_stmt_get_result($stmt);    
								echo '<select value="0" name="arr_city" id="w3_country1">';
								while ($row = mysqli_fetch_assoc($result)) {
								echo "<option value='".$row["city"]."'>" . $row["city"]. "</option>";
								}
								?>
								</select>									
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3 style="color: rgba(255, 255, 255, 0.767);">Khởi hành</h3>
									<input name="dep_date" type="date" 
										class="form-control"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
								</div>
							</div>
							<div class="class">
								<h3 style="color: rgba(255, 255, 255, 0.767);">Khoang dịch vụ</h3>
								<select id="w3_country1" name="f_class"
									onchange="change_country(this.value)" class="frm-field required">
									<option value="E">Phổ thông</option>  
									<option value="B">Thương gia</option>   
								</select>

							</div>
							<div class="clear"></div>
							<div class="numofppl">
								<div class="adults">
									<h3 style="color: rgba(255, 255, 255, 0.767);">Hành khách</h3>
									<div class="quantity"> 
										<div class="quantity-select">                           
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value"><span>1</span></div>
											<input type="hidden" name="passengers"
												 class="input_val" value="1">											
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
							<input type="hidden" name="code" value="0">
							<input type="submit" value="Tìm kiếm" name="search_but">
						</form>																				
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<style>
.intro{width:100%;background:#fff;z-index:1}
.intro_background{top:-128px;left:0;width:100%;height:20px;background-repeat:no-repeat;background-size:cover;background-position:center center}
.intro_container{width:100%;border-bottom:solid 2px #e4e6e8;padding-top:0px;padding-bottom:0px}
.intro_icon{width:70px;height:71px}
.intro_icon img{max-width:100%}
.intro_content{padding-left:28px}
.intro_title{font-family:"Times New Roman",sans-serif;font-size:18px;color:#181818;font-weight:400}
.destinations{width:100%;background:#fff;padding-top:115px;padding-bottom:116px}
div.card {
  -webkit-transition: 0.4s ease;
  transition: 0.4s ease;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  
}

.col-lg-6:hover div.card {
  -webkit-transform: scale(1.08);
  transform: scale(0.89);
}
/* .card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
} */
.card img{
  width: 100%;
  height: 370px;
  object-fit:cover; 
  transition: all .25s ease;
} 

* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  	position: relative;
  	margin: auto;
  	height:52vh;
	width:100%;
	overflow: hidden;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
  animation-fill-mode: forwards; 
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}

</style>
<!-- test -->

<div class="conatiner-fluid p-4" style="background-color: whitesmoke;margin-top:150px;">
   <!-- <h2 class="text-center mb-3 mt-3 display-4"
	   style="font-style: normal;font-size:80px;">Main Attractions In India</h2>   
	<div class="row p-5 pb-0"> -->
	<div class="intro">			
		<div class="container">
			<div class="row">
				<div class="col">					
					<div class="row">
						<!-- Intro Item -->
						<div class="col-lg-4 intro_col">
							
							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/sale_qc.jpg" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Đăng ký Jetmail</div>
										<div class="content_item text-center">Hãy là một trong những người đầu tiên biết về địa điểm và thời gian chúng 
											tôi bay. Chúng tôi cũng sẽ thông báo cho bạn về việc bán vé máy bay và các ưu đãi hấp dẫn khác.
										</div>
									</div>
									<div class="container bg-light text-center">
										<a href="register.php"><button type="button" class="btn btn-primary m-3" >Đăng ký ngay</button></a>                                                                                            
									</div>
								</div>
							</div>								
						</div>

						<div class="col-lg-4 intro_col">
							
							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/covid_qc.jpg" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Trung tâm trợ giúp COVID-19</div>
										<div class="content_item text-center">Hãy cập nhật những thông tin quan trọng về du lịch trong thời gian này. Truy cập Trung tâm trợ 
											giúp COVID-19 của chúng tôi trước khi bạn đặt chỗ và trước khi bạn đi du lịch.
										</div>
									</div>
									<div class="container bg-light text-center">
										<button type="button" class="btn btn-primary m-3">Đọc thêm</button>                                                                                            
									</div>
								</div>
							</div>								
						</div>

						<div class="col-lg-4 intro_col">
							
							<div class="intro_item d-flex flex-row align-items-end justify-content-start">
								<div class="card">
									<img src="assets/images/traval_qc.webp" alt="" class="rounded-top">
									<div class="container">
										<div class="header_item text-center font-weight-bold m-3">Yêu cầu đi lại</div>
										<div class="content_item text-center">Trước khi bạn đặt chỗ và trước khi đi du lịch, hãy kiểm tra các yêu cầu nhập cảnh và 
											xuất cảnh mới nhất đối với các điểm đến trên khắp thế giới bằng bản đồ tương tác.
										</div>
									</div>
									<div class="container bg-light text-center">
										<button type="button" class="btn btn-primary m-3">Tìm hiểu thêm</button>                                                                                            
									</div>
								</div>
							</div>								
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>

<footer class="">
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

    <?php subview('footer.php'); ?> 

		<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default',         
					width: 'auto', 
					fit: true   
				});
			});		
		</script>
		<script>
		$('.value-plus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			divUpd.text(newVal);
			$('.input_val').val(newVal);
		});

		$('.value-minus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			if(newVal>=1) {
				divUpd.text(newVal);
				$('.input_val').val(newVal);
			} 
		});
		</script>
								<!--//quantity-->
						<!--load more-->
		<script>
	$(document).ready(function () {
		size_li = $("#myList li").size();
		x=1;
		$('#myList li:lt('+x+')').show();
		$('#loadMore').click(function () {
			x= (x+1 <= size_li) ? x+1 : size_li;
			$('#myList li:lt('+x+')').show();
		});
		$('#showLess').click(function () {
			x=(x-1<0) ? 1 : x-1;
			$('#myList li').not(':lt('+x+')').hide();
		});
	});
	
</script>
<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	showSlides(slideIndex = n);
	}

	function showSlides(n) {
	let i;
	let slides = document.getElementsByClassName("mySlides");
	let dots = document.getElementsByClassName("dot");
	if (n > slides.length) {slideIndex = 1}    
	if (n < 1) {slideIndex = slides.length}
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	}
	slides[slideIndex-1].style.display = "block";  
	dots[slideIndex-1].className += " active";
	}
</script>