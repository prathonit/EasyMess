<nav class="navbar" role="navigation" aria-label="main navigation">
<div class="navbar-brand">
<a class="navbar-item" href="index.php">
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
      <a class="button is-light" href="adminbarcode.php">
        <strong>Barcode</strong>
      </a>
      <a class="button is-light" href="adminhome.php">
        <strong>Upcoming Graces</strong>
      </a>
      <a class="button is-primary" href="adminaccounts.php">
        <strong>Accounts</strong>
      </a>
      <a class="button is-light" href="logout.php">
        <i class="fas fa-power-off"></i>&nbsp;Logout
      </a>
    </div>
  </div>
</div>
</div>
</nav>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {

// Get all "navbar-burger" elements
const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

  // Add a click event on each of them
  $navbarBurgers.forEach( el => {
    el.addEventListener('click', () => {

      // Get the target from the "data-target" attribute
      const target = el.dataset.target;
      const $target = document.getElementById(target);

      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      el.classList.toggle('is-active');
      $target.classList.toggle('is-active');

    });
  });
}

});
</script>
