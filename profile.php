<?php
    require "header.php";
    
?>

    <main>
        <div class="container">
            <div class="row profile-name">
                <?php 
                    echo "<h1 >".ucwords($_SESSION['userName'])."</h1>";
                ?>
            </div>
            
            <div class="row checkouts">
                <div class="col">
                    <div class="card-body">
                        <h1>Your Library</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col profile-name">
                    <h1 class="">Book</h1>
                </div>
                <div class="col profile-name">
                    <h1>Check Out Date</h1>
                </div>
                <div class="col profile-name">
                    <h1>Due Date</h1>
                </div>
                <div class="col profile-name">
                    <h1>Return Book</h1>
                </div>
            </div>
            <div class="row" id="message-row">
                <?php require "scripts/profileScript.php";?>
            </div>
            <div class="row">
            <?php
            if(isset($_GET['return-book'])) {
                echo '<p>Book successfully returned</p>';
            } 
            ?>
            </div>
        </div>
    
    </main>

<?php require "footer.php" ?>