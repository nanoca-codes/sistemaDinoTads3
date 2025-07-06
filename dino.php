<!DOCTYPE html>
<php lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Venha viver uma aventura jurassica</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />


    <link href="img/Jurassic_Park_logo.png" rel="icon" />

   
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

  
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

 
    <link href="css/bootstrap.min.css" rel="stylesheet" />


    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>

    <div
      id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem"
        role="status"
      >
        <span class="sr-only">Carregando...</span>
      </div>
    </div>
  
    <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
       <style>
    .text-primary {
      color: #cf1500 !important;
    }
    .bg-primary {
      background-color: #cf1500 !important;
    }
    .btn.btn-sm-square.bg-white.text-primary {
      border: 1px solid #cf1500;
    }
    .btn.btn-sm-square.bg-white.text-primary:hover {
      background-color: #cf1500;
      color: #ffffff !important;
    }
    .fa-phone-alt,
    .fa-map-marker-alt,
    .far.fa-clock,
    .fab.fa-facebook-f,
    .fab.fa-twitter,
    .fab.fa-linkedin-in,
    .fab.fa-instagram {
      color: #cf1500 !important;
    }
  </style>
      <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
          <div class="h-100 d-inline-flex align-items-center py-3 me-4">
            <small class="fa fa-map-marker-alt text-primary me-2"></small>
            <small>Isla Nublar, Costa Rica</small>
          </div>
          <div class="h-100 d-inline-flex align-items-center py-3">
            <small class="far fa-clock text-primary me-2"></small>
            <small>Seg - Sex : 09:00 - 19:00  Sáb - Dom : 8:00 - 20:00</small>
          </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
          <div class="h-100 d-inline-flex align-items-center py-3 me-4">
            <small class="fa fa-phone-alt text-primary me-2"></small>
            <small>+001 120 1990</small>
          </div>
          <div class="h-100 d-inline-flex align-items-center">
            <a class="btn btn-sm-square bg-white text-primary me-1" href=""
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a class="btn btn-sm-square bg-white text-primary me-1" href=""
              ><i class="fab fa-twitter"></i
            ></a>
            <a class="btn btn-sm-square bg-white text-primary me-1" href=""
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a class="btn btn-sm-square bg-white text-primary me-0" href=""
              ><i class="fab fa-instagram"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  
    <nav
      class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <a href="index.php" class="navbar-brand p-0">
        <img class="img-fluid me-3" src="img/Jurassic_Park_logo.png" alt="Icon" />
        <h1 class="m-0" style="color:#cf1500">Jurassic Park</h1>
      </a>
      <button
        type="button"
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
          <a href="index.php" class="nav-item nav-link">Home</a>
          <a href="sobre.php" class="nav-item nav-link">Sobre</a>
          <a href="servicos.php" class="nav-item nav-link">Serviços</a>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle active"
              data-bs-toggle="dropdown"
              >Paginas</a
            >
            <div class="dropdown-menu rounded-0 rounded-bottom m-0">
              <a href="dino.php" class="dropdown-item active">Nossos dinossauros</a>
              <a href="listaReservas.php" class="dropdown-item">Reservas</a>
              <a href="horario.php" class="dropdown-item">Horas de visita</a>
              <a href="feedback.php" class="dropdown-item">Feedbacks</a>
            </div>
          </div>
          <a href="contato.php" class="nav-item nav-link">Entre em contato</a>
        </div>
        <a href="" class="btn" style="background-color: #cf1500; border-color: #cf1500; color: #ffffff;"
          >Faça sua reserva!<i class="fa fa-arrow-right ms-3"></i
        ></a>
      </div>
    </nav>
 
    <div
      class="container-fluid header-bg py-5 mb-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <h1 class="display-4 text-white mb-3 animated slideInDown">
          Nossos dinossauros
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Paginas</a>
            </li>
            <li class="breadcrumb-item text-primary active" aria-current="page">
              Nossos dinossauros
            </li>
          </ol>
        </nav>
      </div>
    </div>
 
    <div class="container-xxl py-5">
      <div class="container">
        <div
          class="row g-5 mb-5 align-items-end wow fadeInUp"
          data-wow-delay="0.1s"
        >
          <div class="col-lg-6">
            <p><span class="text-primary me-2"></span>Nossos dinossauros</p>
            <h1 class="display-5 mb-0">
              De uma olhada em nossos <span class="text-primary">dinossauros</span> 
          </div>
          <div class="col-lg-6 text-lg-end">
            <a class="btn" style="background-color: #cf1500; border-color: #cf1500; color: #ffffff"; py-3 px-5 href=""
              >Explore mais dinos!</a
            >
          </div>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4">
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/fotoDino1.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/fotoDino1.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">T-rex</h5>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/triceratops.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/triceratops.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">Triceratops</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="row g-4">
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/carnotauro.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/carnotauro.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">Carnotauro</h5>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/espinossauro.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/espinossauro.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">Espinossauro</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="row g-4">
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/anquilossauro.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/anquilossauro.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">Anquilossauro</h5>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12">
                <a
                  class="animal-item"
                  href="img/parassaurolofo.jpg"
                  data-lightbox="animal"
                >
                  <div class="position-relative">
                    <img class="img-fluid" src="img/parassaurolofo.jpg" alt="" />
                    <div class="animal-text p-4">
                      <p class="text-white small text-uppercase mb-0">Dinossauro</p>
                      <h5 class="text-white mb-0">Parassaurolofo</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
    <div
      class="container-fluid footer bg-dark text-light footer mt-5 pt-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Endereço</h5>
            <p class="mb-2">
              <i class="fa fa-map-marker-alt me-3"></i>Isla Nublar, Costa Rica
            </p>
            <p class="mb-2">
              <i class="fa fa-phone-alt me-3"></i>+001 120 1990
            </p>
            <p class="mb-2">
              <i class="fa fa-envelope me-3"></i>ingen_jurassicpark@gmail.com
            </p>
            <div class="d-flex pt-2">
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-twitter"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-youtube"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Links rapidos</h5>
            <a class="btn btn-link" href="">Sobre nós</a>
            <a class="btn btn-link" href="">Entre em contato</a>
            <a class="btn btn-link" href="">Suporte</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Links populares</h5>
            <a class="btn btn-link" href="">Sobre nós</a>
            <a class="btn btn-link" href="">Entre em contato</a>
            <a class="btn btn-link" href="">Nosso serviços</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Notícias</h5>
            <p>Em breve mais informções!</p>
            <div class="position-relative mx-auto" style="max-width: 400px">
              <input
                class="form-control border-0 w-100 py-3 ps-4 pe-5"
                type="text"
                placeholder="Seu email"
              />
              <button
              type="button"
              class="btn"
              style="background-color: #cf1500; border-color: #cf1500; color: #ffffff; padding: 8px 16px; position: absolute; top: 8px; right: 8px;"
            >
              Sign Up
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Jurassic Park</a>, Todos os direitos reservados
            </div>
            <div class="col-md-6 text-center text-md-end">
              <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
              Designed By
              <a class="border-bottom" href="https://htmlcodex.com"
                >HTML Codex</a
              >
              <br />Distributed By:
              <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div>
          </div>
        </div>
      </div>
    </div>
 
     <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background-color: #cf1500; border-color: #cf1500; color: white;">
  <i class="bi bi-arrow-up"></i>
</a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="js/main.js"></script>
  </body>
</php>
