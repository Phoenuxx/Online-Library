<?php
    require "header.php";
    
?>

    <main>
        <div class="container">
            <div class="row profile-name">
                <?php 
                    echo "<h1 >".ucfirst($_SESSION['userName'])."</h1>";
                ?>
            </div>
            
            <div class="row checkouts">
                <div class="col-12" id='checkout-profile-name'>
                    <div class="">
                        <div class="card-body">
                            <h1>Your Library</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col profile-name">
                    <h1 class="">Book</h2>
                </div>
                <div class="col profile-name">
                    <h1>Check Out Time</h2>
                </div>
                <div class="col profile-name">
                    <h1>Due Date</h2>
                </div>
                <div class="col profile-name">
                    <h1>Return Book</h2>
                </div>
            </div>
            <div class="row">
                <?php require "scripts/profileScript.php";?>
            </div>
        </div>
    
    </main>

<?php require "footer.php" ?>