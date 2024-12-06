<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
      <ul class="nav flex-column">

          <?php
            $uri = $_SERVER['REQUEST_URI'];
            $uriAr = explode("/", $uri);
            $page = end($uriAr);
          ?>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'index.php') ? 'active' : ''; ?>" href="index.php">
              <span data-feather="home"></span>
              Admins <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'investigator.php') ? 'active' : ''; ?>" href="investigator.php">
              <span data-feather="shopping-cart"></span>
              Investigators
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'news.php') ? 'active' : ''; ?>" href="news.php">
              <span data-feather="shopping-cart"></span>
              Announcements
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'products.php') ? 'active' : ''; ?>" href="products.php">
              <span data-feather="shopping-cart"></span>
              Evidences
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'blockchain-data.php') ? 'active' : ''; ?>" href="blockchain-data.php">
              <span data-feather="shopping-cart"></span>
              Evidences Blockchain
            </a>
          </li>

      </ul>


  </div>
</nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Hello <?php echo $_SESSION["admin_name"]; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>
