<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
  include 'config/dependencies.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyMess</title>
    <link rel="stylesheet" href="assets/style/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <span class="has-text-weight-bold is-size-4">EasyMess</span>
      <!-- <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"> -->
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">


    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
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
