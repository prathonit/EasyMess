<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
  include 'config/dependencies.php';
?>
<!DOCTYPE html>
<html>
  <?php
      include 'assets/includes/head.php';
   ?>
  <body>
  <?php
      include 'assets/includes/nav.php';
   ?>
<section>
  <div class="hero is-fullheight is-primary is-bold">
    <div class="hero-body">
      <div class="container">
        <section class="section">
          <div class="container">
            <form class="" action="authenticate.php" method="post">
              <fieldset>

              <div class="field has-addons">


                <div class="control has-icons-left">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <input class="input" type="text" name="username" value="" required>

                </div>
                <div class="control">
                  <button class="button is-static">@hyderabad.bits-pilani.ac.in</button>
                </div>

              </div>
              <div class="field has-addons" >


                <div class="control has-icons-left">
                  <span class="icon is-small is-left">
                      <i class="fas fa-key"></i>
                  </span>
                  <input class="input" type="password" name="password" value="" required>
                </div>

              </div>
              <div class="field">
                <div class="control">
                  <input type="submit" value="login" class="button is-primary">
                </div>
            </div>
          </fieldset>
            </form>
              </div>
        </section>

    </div>
  </div>
</section>


<section class="section">
  <footer class="footer">
    <div class="content has-text-centered">
      &copy; 2020 BPHC  <strong>All Rights Reserved</strong>

    </div>
  </footer>
</section>
  </body>
</html>
