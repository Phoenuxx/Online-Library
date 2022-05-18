<?php

//Sign up functions
function emptySignup($username, $email, $password, $password2) {
    $result;
    if(empty($username)  || empty($email)  || empty($password) || empty($password2)) {
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
		// trim(json_encode($variable), removes " from string) trims the " character from the json styled strings
	 	echo  '<div class="row shelf">
	 			<div class="col ">
					<div>Title: '.trim(json_encode($book_value['title']),'"').'<br>Author: '.trim(json_encode($book_value['author']),'"').'<br>Genre: '.trim(json_encode($book_value['genre1']),'"').'</div>
				</div>
				<div class="col ">
				'.trim(json_encode($book_value['checkOut']),'"').'
				</div> 
				<div class="col ">
				'.trim(json_encode($book_value['dueDate']),'"').'
				</div> 
				<div class="col ">
				<form action="scripts/profileScript.php" method="GET">
				<button class="btn btn-warning return-button" type="submit" name="return-book" value="'.$book_value['id'].'">Click to Return Book</button>
				</form>
				</div> 
			</div>';
 	};
}

function returnBook($conn, $id) {
	$sql = "UPDATE books SET checkOut=NULL, dueDate=NULL, FK_readerID=NULL WHERE id=?";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../profile.php?error=libraryreturnerror");
		exit();
	};
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
};


// admin page functions

// function countBooks($conn) {
// 	echo 'test';
// 	$sql = "SELECT COUNT(*) FROM books";
// 	$stmt = mysqli_stmt_init($conn);
	
// 	if(!mysqli_stmt_prepare($stmt, $sql)) {
// 		header("Location: ../profile.php?error=libraryreturnerror");
// 		exit();
// 	};
// 		mysqli_stmt_execute($stmt);
// 		mysqli_stmt_close($stmt);
		
// };

function emptyBook($title, $author, $genre, $pages) {
    $result;
    if(empty($title)  || empty($author)  || empty($genre) || empty($pages)) {
		$result = true;
    } else {
        $result = false;
    }
	return $result;
}

function addNewBook($conn, $title, $author, $genre, $genre2, $pages) {
    $currentDateTime = date("'Y-m-d G:i:s'");
	$sql = "INSERT INTO books (title, author, genre1, genre2, pages, date_added) VALUES(?, ?, ?, ?, ?, $currentDateTime)";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../admin.php?addbook=sqlerror");
		exit();
	}
		mysqli_stmt_bind_param($stmt, "ssssi", $title, $author, $genre, $genre2, $pages);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("Location: ../admin.php?addbook=success.$currentDateTime");
};

function removeBook($conn, $title) {
	$sql = "DELETE FROM books WHERE title=? ORDER BY id LIMIT 1";
	$stmt = mysqli_stmt_init($conn);
	$bookReturnedSuccess = false;
	
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../admin.php?removebook=sqlerror");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $title);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
};

//Library page

function populateMainLibrary($mainLibrary) {
	//echo json_encode($userLibrary);
	foreach($mainLibrary as $book => $book_value) {
		// trim(json_encode($variable,")  trims the " character from the json styled strings
	 	echo  '	<div class="col-9 ">
					<div class="row shelf">
						<div class="col-4">
							<div>Title: '.trim(json_encode($book_value['title']),'"').'<br>Author: '.trim(json_encode($book_value['author']),'"').'<br>Genre: '.trim(json_encode($book_value['genre1']),'"').'</div>
						</div>
						<div class="col-4">'
							.trim(json_encode($book_value['genre1']),'"').
						'</div> 
						<div class="col-4">'
							.trim(json_encode($book_value['pages']),'"').
						'</div>
						
					</div>
				</div>'
				;
		echo (isset($_SESSION['userName']) && $_SESSION['userName'] !== "Admin") ?  
			'<div class="col-3 ">
				<form action="scripts/libraryScript.php" method="GET">
					<button class="btn btn-success return-button" type="submit" name="checkout-book" value="'.$book_value['id'].'">Click to Checkout Book</button>
				</form>
			</div>' : 
			'<div class="col-3 ">
				<button class="btn btn-success return-button" type="submit" name="checkout-book" value="'.$book_value['id'].'" disabled>Click to Checkout Book</button>
			</div>'; 
				
						
 	};
};

//TODO stop checkout button from redirecting to libraryscripts.php
				
function checkoutBook($conn, $id, $bookID) {
	$currentDate = date("'Y-m-d'");
	$returnDate = date("'Y-m-d'", strtotime('+14 days'));
	$sql = "UPDATE books SET checkOut=$currentDate, dueDate=$returnDate, FK_readerID=? WHERE id=?";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../profile.php?error=librarycheckouterror");
		exit();
	};
		mysqli_stmt_bind_param($stmt, "ii", $id, $bookID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
};