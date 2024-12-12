
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>School Transcript</title>

    <!-- Bootstrap core CSS -->
    <link href="landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="landing/assets/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="landing/assets/css/animated.css">
    <link rel="stylesheet" href="landing/assets/css/owl.css">

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="#" class="logo">
              <img width="80" height="80" src="landing/assets/images/logo.png" alt="Transcript Logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              @yield('menu')
              <li><div class="gradient-button"><a href="{{ route('backpack.dashboard') }}"><i class="fa fa-sign-in-alt"></i> Gestão</a></div></li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>

  @yield('content')

  <footer id="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Registre seu endereço de e-mail </h4>
          </div>
        </div>
        <div class="col-lg-6 offset-lg-3">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">Subscrever <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Contact Us</h4>
            <p>Zona Comercial, Lobito  - Bg., Angola</p>
            <p><a href="tel:943962996">943962996</a></p>
            <p><a href="mailto:gabriel.vieira24@outlook.com">gabriel.vieira24@outlook.com</a></p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Menu</h4>
            <ul>
              <li><a href="{{ route('backpack.dashboard') }}">Gestão</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Links Uteis</h4>
            <ul>
              <li><a href="{{ route('privacy-policy') }}">Politica de Privacidade</a></li>
              <li><a href="{{ route('terms-conditions') }}">Termos e Condições</a></li>
              <li><a href="{{ route('delete') }}">Delete Account</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Transcript - Históricos Escolares</h4>
            <div class="logo">
              <img src="landing/assets/images/logo.png" alt="">
            </div>
            <p>Transcript é uma ferramenta para estudantes e professores que permite o compartilhamento de notas e avaliações.</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="copyright-text">
            <p>Copyright © 2024. All Rights Reserved. 
          <br>By: <a href="https://github.com/gabrielgits" target="_blank" title="css templates">GV</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="landing/vendor/jquery/jquery.min.js"></script>
  <script src="landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landing/assets/js/owl-carousel.js"></script>
  <script src="landing/assets/js/animation.js"></script>
  <script src="landing/assets/js/imagesloaded.js"></script>
  <script src="landing/assets/js/popup.js"></script>
  <script src="landing/assets/js/custom.js"></script>
</body>
</html>