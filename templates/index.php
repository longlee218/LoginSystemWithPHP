<?php require_once "header.php"?>
   <div class="container mt-5">
          <main>
              <section>
                    <?php
                        if (isset($_SESSION['user_id'])){
                            echo "<div class='center'><h1>You are login</h1></div>";
                        }else{
                            echo "<div class='center'><h1>You are logout</h1></div>";
                        }
                    ?>
              </section>
          </main>
   </div>
<?php require_once "footer.php" ?>
