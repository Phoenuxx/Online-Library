<?php 
    require "header.php";
    require_once 'scripts/dbHandlerScript.php';
    require_once 'scripts/functions.php';
    function loadLibrary($conn) {

        $sql = "SELECT * FROM books WHERE FK_readerID iS NULL";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=libraryfetcherror");
            exit();
        };
            
            mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $mainLibrary = mysqli_fetch_all ($result, MYSQLI_ASSOC);
        populateMainLibrary($mainLibrary);
    };
    
?>

    <main> 
        <div class="container">
            <div class="row">
                <h1 class="profile-name">Library</h1>
            </div>
            <div class="row">
                <div class="col profile-name"> <h1 class="profile-name">Book Details</h1></div>
                <div class="col profile-name"> <h1 class="profile-name">Genre</h1></div>
                <div class="col profile-name"> <h1 class="profile-name">Page Count</h1></div>
                <div class="col profile-name"> <h1 class="profile-name">Check out</h1></div>
            </div>
            <div class="row">
                <?php loadLibrary($conn); ?>
            </div>
        </div>
    
    </main>

<?php require "footer.php" ?>