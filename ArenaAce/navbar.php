  <!-- navbar section starts -->

  <nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="assets/images/logo.png" class="img-fluid" alt="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Ita</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sport.php">Sports</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="search.php">Book</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="blog.php">Blogs</a>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Gallery
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="gallery.php">Image Gallery</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Video Gallery</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user-profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <form action="#" class="d-flex align-items-center justify-content-center">
                    <!-- <input type="search" name="search_arena" id="search_arena" class="form-control" placeholder="search arena by location"> -->
                    <!-- <button type="submit" name="search">
                      <i class="fa-solid fa-magnifying-glass-location"></i></button> -->
                </form>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php
            if(isset($_SESSION['username']) && $_SESSION['username']==true){
              echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
            }
            else{
              echo '<li class="nav-item"><a href="userLogin.php" class="nav-link">Login</a></li>';
              echo '<li class="nav-item"><a href="userRegister.php" class="nav-link">Register</a></li>';
            }
          ?>
            
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- navbar section ends -->