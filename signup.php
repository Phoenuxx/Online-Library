<?php require "header.php"; ?>

<main>


    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card-title"> Signup</div>
            <?php
            if(isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case "emptyfield":
                        echo '<p> please fill in all fields</p>';
                        break;
                    case "usernametaken":
                        echo '<p> Sorry but the Username or Email is not available</p>';
                        break;
                        case "invalidusername":
                            echo '<p> please enter valid Username</p>';
                            break;
                    case "invalidemail":
                        echo '<p> please enter valid Email</p>';
                        break;
                    case "invalidpassword":
                        echo '<p> please enter valid Password</p>';
                        break;
                }
            } 
            elseif(isset($_GET['signup'])) { 
                echo '<p> You signed up Successfully!</p>';
            }
            ?>
            <form action="scripts/signupScript.php" method="POST">
                <input type="text" name="userID" placeholder="Username"><br>
                <input type="text" name="userEmail" placeholder="Email"><br>
                <input type="password" name="pwd" placeholder="Password"><br>
                <input type="password" name="pwd2" placeholder="Repeat Password"><br>
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </div>
        <div class="col"></div>
    </div>

</main>

<?php require "footer.php" ?>