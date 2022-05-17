<?php require "header.php"; ?>

    <main> 
        <div class="container">
            <div class="row">
            <?php
            if(isset($_GET['addbookerror'])) {
                switch ($_GET['addbookerror']) {
                    case "emptyfield":
                        echo '<p> please fill in all fields</p>';
                        break;
                }
            } 
            elseif(isset($_GET['signup'])) { 
                echo '<p> You signed up Successfully!</p>';
            }
            ?>

            </div>
            <div class="row"> 
                <div class="profile-name">Add New Book</div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="scripts/adminScript.php" method="POST">
                        <input type="text" name="title" placeholder="Title"><br>
                        <input type="text" name="author" placeholder="Author"><br>
                        <input type="text" name="genre" placeholder="Genre"><br>
                        <input type="text" name="genre2" placeholder="genre 2 (Optional)"><br>
                        <input type="integer" name="pages" placeholder="Page count"><br>
                        <button type="submit" name="new-book-submit">Add Book</button>
                    </form>
                </div>
                <div class="col profile-name">Remove Book
                    <form action="scripts/adminScript.php" method="POST">
                        <input type="text" name="title" placeholder="Book Title"><br>
                        <button type="submit" name="remove-book">Remove Book</button>
                    </form>
                </div>
              
                    
                
            </div>
            </div>
        </div>
    
    </main>

<?php require "footer.php" ?>