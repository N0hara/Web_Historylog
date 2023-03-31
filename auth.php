<?php 
session_start();
include 'db_conn.php';

if (isset($_POST['name']) && isset($_POST['password'])) {
	
	$name = $_POST['name'];
	$password = $_POST['password'];

	if (empty($name)) {
		header("Location: login.php?error=name is required");
	}else if (empty($password)){
		header("Location: login.php?error=Password is required&name=$name");
	}else {
		$stmt = $conn->prepare("SELECT * FROM users WHERE name=?");
		$stmt->execute([$name]);

		if ($stmt->rowCount() === 1) {
			$user = $stmt->fetch();

			$user_id = $user['id'];
			$user_name = $user['name'];
			$user_password = $user['password'];

			if ($name === $user_name) {
				if (password_verify($password, $user_password)) {
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_name'] = $user_name;
					header("Location: index.php");

				}else {
					header("Location: login.php?error=Incorect User name or password&name=$name");
				}
			}else {
				header("Location: login.php?error=Incorect User name or password&name=$name");
			}
		}else {
			header("Location: login.php?error=Incorect User name or password&name=$name");
		}
	}
}

