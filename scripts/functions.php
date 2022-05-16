<?php

//Sign up functions
function emptySignup($username, $email, $password, $password2) {
    $result;
    if(empty($username)  || empty($email)  || empty($password) || empty($password2)) {
        header("Location: ../signup.php?error=emptyfield&userID=".$username."&mail=".$email);
        $result = true;
    } else {
        $result = false;
    }
	return $result;
}

function invalidUsername($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
    } else {
        $result = false;
    }
	return $result;
}

function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
    } else {
        $result = false;
    }
	return $result;
}

function passwordMatch($password, $password2) {
    $result;
    if($password !== $password2) {
		$result = true;
    } else {
        $result = false;
    }
	return $result;
};

function addNewUser($conn, $username, $email, $password) {
    
	$sql = "INSERT INTO users (userID, userEmail, userPassword) VALUES(?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlerror");
		exit();
	}
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("Location: ../signup.php?signup=success");
};

//this function is used for sign up AND login
function usernameExists($conn, $username, $email) {
	
	$sql = "SELECT * FROM users WHERE userID=? OR userEmail=?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlerror");
		exit();
	};
		mysqli_stmt_bind_param($stmt, "ss", $username, $email);
		mysqli_stmt_execute($stmt);
		
		$resultData = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		} else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
};


//login functions
function emptyLogin($username, $password) {
    $result;
    if(empty($username)  || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
	return $result;
}

function loginUser($conn, $username, $password) {
    $usernameExists = usernameExists($conn, $username, $username);
	
	if($usernameExists == false) {
		header("Location: ../index.php?error=invalidlogin");
		exit();
	}
	
	$passwordHashed = $usernameExists["userPassword"];
	$checkPassword = password_verify($password, $passwordHashed);

	if(!$checkPassword) {
		header("Location: ../index.php?error=invalidlogin");
		exit();
	} elseif($checkPassword) {
		session_start();
		$_SESSION['ID'] = $usernameExists['id'];
		$_SESSION['userName'] = $usernameExists['userID'];
		header("Location: ../index.php");
		exit();
	}
}

//profile page functions
function fetchLibrary($conn, $id) {
	$sql = "SELECT * FROM books WHERE FK_readerID=?";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=libraryfetcherror");
		exit();
	};
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	$userLibrary = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	populateProfileLibrary($userLibrary);
};

function populateProfileLibrary($userLibrary) {
	//echo json_encode($userLibrary);
	foreach($userLibrary as $book => $book_value) {
		$_SESSION['bookid'] = $book_value['id'];
		echo $_SESSION['bookid'];
	 	echo  '<div class="row shelf">
	 			<div class="col ">
					<div>Title: '.json_encode($book_value['title']).'<br>Author: '.json_encode($book_value['author']).'<br>Genre: '.json_encode($book_value['genre1']).'</div>
				</div>
				<div class="col ">
				'.json_encode($book_value['checkOut']).'
				</div> 
				<div class="col ">
				'.json_encode($book_value['dueDate']).'
				</div> 
				<div class="col ">
				<form action="profile.php" method="GET">
				<button class="btn btn-warning return-button" type="submit" name="return-book" value="'.$_SESSION["bookid"].'">Click to Return Book</button>
				</form>
				</div> 
			</div>';
 	};
}

function returnBook($conn, $id) {
	echo 'test';
	$sql = "UPDATE books SET checkOut=NULL, dueDate=NULL, FK_readerID=NULL WHERE id=?";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../profile.php?error=libraryreturnerror");
		exit();
	};
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	header("Location: ../profile.php?return=success");
};
