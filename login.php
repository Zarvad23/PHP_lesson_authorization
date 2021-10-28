<?php
	session_start();
?>

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>	 
<?php

if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: intropage.php");
}

if(isset($_POST["login"])){

	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$username=htmlspecialchars($_POST['username']);
		$password=htmlspecialchars($_POST['password']);
		$query =mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'");
		$numrows=mysqli_num_rows($query);
		if($numrows!=0)
		{
			while($row=mysqli_fetch_assoc($query))
			{
				$dbusername=$row['username'];
				$dbpassword=$row['password'];
			}
			if($username == $dbusername && $password == $dbpassword)
			{
	// старое место расположения
	//  session_start();
				$_SESSION['session_username']=$username;	 
				/* Перенаправление браузера */
				header("Location: intropage.php");
			}
		} else {
	//  $message = "Invalid username or password!";

			echo  "Invalid username or password!";
		}
	} else {
		$message = "All fields are required!";
	}
}
?>
	<div class="container h-100">
		<div id="login" class="row justify-content-center mt-5">
			<div class="col-5 form-container shadow-sm p-3 mb-3 mt-5 bg-white rounded">
				<h1 class="h1 mb-3 mt-3 border p-3 rounded text-center">Зарифуллин Вадим</h1>
				<form action="" id="loginform" method="post" name="loginform" class="d-flex flex-column">
					<p><label class="form-label w-100" for="user_login">Имя пользователя<br>
					<input class="form-control" id="username" name="username" type="text" value=""></label></p>
					<p><label class="form-label w-100" for="user_pass">Пароль<br>
					<input class="form-control" id="password" name="password"  type="password" value=""></label></p> 
					<p class="submit"><input class="btn btn-primary w-100" name="login"type= "submit" value="Log In"></p>
					<p class="regtext">Еще не зарегистрированы?<a href="register.php" class="card-link">Регистрация</a>!</p>
				</form>
			</div>
		</div>
	</div>
<?php include("includes/footer.php"); ?>