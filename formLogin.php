<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Login</title>
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
        color: rgb(0, 0, 0) !important;
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


      .login-container {
        min-height: calc(100vh - 150px); 
        background: url('img/brachiosaurus_background.jpg') no-repeat center center;
        background-size: cover;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
      }

      .login-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3); 
        filter: blur(3px); 
        z-index: 1;
      }

      .login-box {
        background-color: rgba(216, 210, 210, 0.81); 
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(190, 190, 190, 0.5); 
        max-width: 450px;
        width: 90%;
        position: relative;
        z-index: 2;
        color: rgb(0, 0, 0);
        padding: 50px; 
      }

      .login-logo {
        max-width: 150px; 
        margin-bottom: 25px;
      }

      .welcome-message {
        color: #cf1500; 
        font-size: 2.2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 30px; 
      }

      .login-box .form-label {
        color: #333; 
        font-weight: bold;
        text-align: left;
        display: block;
        margin-bottom: 8px;
      }

      .login-box .form-control {
        background-color: rgba(255, 255, 255, 0.6); 
        border: 1px solid #f7d40f; 
        color: black; 
        padding: 12px 15px;
        border-radius: 5px;
      }

      .login-box .form-control::placeholder {
        color: rgba(0, 0, 0, 0.5); 
      }

      .login-box .form-control:focus {
        background-color: rgba(255, 255, 255, 0.8); 
        border-color: #cf1500; 
        box-shadow: 0 0 0 0.25rem rgba(207, 21, 0, 0.25);
        color: black; 

      /* Botão de Login */
      .btn-login {
        background-color: #cf1500; 
        border-color: #cf1500;
        color: white;
        font-weight: bold;
        padding: 12px 20px; 
        font-size: 1.1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
      }

      .btn-login:hover {
        background-color: #a01000; 
        border-color: #a01000;
        color: white;
      }

      /* Link de Cadastro */
      .register-link {
        color: #cf1500 !important; 
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
      }

      .register-link:hover {
        color: #a01000 !important; /
        text-decoration: underline;
      }


      @media (max-width: 768px) {
        .login-container {
          padding: 20px 0;
        }
        .login-box {
          padding: 30px;
        }
        .welcome-message {
          font-size: 1.8rem;
        }
        .login-logo {
          max-width: 120px;
        }
      }

      @media (max-width: 480px) {
        .login-box {
          padding: 20px;
        }
        .welcome-message {
          font-size: 1.5rem;
        }
        .login-logo {
          max-width: 100px;
        }
      }
    </style>
  </head>


    <div class="container-fluid login-container d-flex justify-content-center align-items-center">
      <div class="login-box p-5 text-center wow fadeInUp" data-wow-delay="0.3s">
        <img
          class="login-logo img-fluid mb-4"
          src="img/Jurassic_Park_logo.png"
          alt="Jurassic Park Logo"
        />
        <h2 class="welcome-message mb-4">Venha viver uma aventura jurássica!</h2>

        <form action="login.php" method="POST">
          <div class="form-group mb-4">
            <label for="emailInput" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="emailInput"
              name="emailUsuario"
              placeholder="Seu email"
              required
            />
          </div>
          <div class="form-group mb-4">
            <label for="passwordInput" class="form-label">Senha</label>
            <input
              type="password"
              class="form-control"
              id="passwordInput"
              name="senhaUsuario"
              placeholder="Sua senha"
              required
            />
          </div>
          <button type="submit" class="btn btn-login w-100 mb-3">Login</button>
          <p class="small mb-0 text-dark-50">
            Ainda não possui login? <a href="formCadastro.php" class="register-link">Cadastre-se já!</a>
          </p>
        </form>
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
            <a class="btn btn-link" href="">Nossos serviços</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="text-light mb-4">Notícias</h5>
            <p>Em breve mais informações!</p>
            <div class="position-relative mx-auto" style="max-width: 400px">
              <input
                class="form-control border-0 w-100 py-3 ps-4 pe-5"
                type="text"
                placeholder="Seu email"
              />
              <button
                type="button"
                class="btn"
                style="
                  background-color: #cf1500;
                  border-color: #cf1500;
                  color: #ffffff;
                  padding: 8px 16px;
                  position: absolute;
                  top: 8px;
                  right: 8px;
                "
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
              &copy; <a class="border-bottom" href="#">Jurassic Park</a>, Todos os
              direitos reservados
            </div>
            <div class="col-md-6 text-center text-md-end">
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
    <a
      href="#"
      class="btn btn-lg btn-lg-square back-to-top"
      style="background-color: #cf1500; border-color: #cf1500; color: white;"
    >
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
</html>