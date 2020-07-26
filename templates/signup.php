<?php
            require_once 'header.php';
            require_once '../includes/signup.inc.php';
            require_once '../includes/compoments.php';

?>
  <div class="container">
      <main>
          <div class="wrapper-main">
              <section class="section-default">
                  <h1>Sign up</h1>
                  <?php
                    if (isset($_GET['error'])){
                        if ($_GET['error'] == 'nullFields'){
                            messageAlter('Fill in all these fields');
                        }
                        if ($_GET['error'] == 'invalid'){
                            messageAlter('Your email or username is not valid');
                        }
                        if ($_GET['error'] == 'passwordNotCheck'){
                            messageAlter('Your password is not the same, please check again');
                        }
                        if ($_GET['error'] == 'UsernameExists'){
                            messageAlter('This username have been exists, please choose another username');
                        }
                    }
                  ?>
                  <form class="form-signup" method="post" action="../includes/signup.inc.php">
                      <div class="form-group">
                          <input class="form-control" type="text" name="username" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter your e-mail">
                      </div>
                      <div class="form-group">
                          <input class="form-control" type="password" name="password" placeholder="Enter your password">
                      </div>
                      <div class="form-group">
                          <input class="form-control" type="password" name="password_check" placeholder="Enter your password again">
                      </div>
                      <div class="form-group">
                          <button class="btn btn-outline-success" type="submit" name="button_signup">Sign up</button>
                      </div>
                  </form>
              </section>
          </div>
      </main>
  </div>

<?php
    require_once 'footer.php';
?>
