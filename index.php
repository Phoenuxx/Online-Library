<?php require "header.php"; ?>

    <main> 
        <div class="container">
            <div class="row">
                <div class=col> </div>
                <div class=col>
                    <?php 

                        echo (isset($_SESSION['userName'])) ? "You are logged in" : "You are logged out";
                        if(isset($_GET['error'])) {
                            if($_GET['error'] == 'invalidlogin') {
                                echo "<p>Incorrect login information. Please try again</p>";
                            }
                        }
                    ?>
                </div>
                <div class=col></div>
            </div>
        </div>
    
    </main>

<?php require "footer.php" ?>