<?php

$logado = $_SESSION['logado'] ?? false; 
$nomeUsuario = $_SESSION['nomeUsuario'] ?? ''; 
$primeiroNome = ''; 
$emailUsuario = $_SESSION['emailUsuario'] ?? ''; 
$tipoUsuario = $_SESSION['tipoUsuario'] ?? ''; 

if ($logado) {
    $nomeCompleto = explode(' ', $nomeUsuario); 
    $primeiroNome = $nomeCompleto[0] ?? ''; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Reservas</title>
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
        color: white !important;
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

      .reserve-container {
        min-height: calc(100vh - 150px); 
        background: url('img/brachiosaurus_background.jpg') no-repeat center center;
        background-size: cover;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
      }

      .reserve-container::before {
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

      .reserve-box {
        background-color: rgba(216, 210, 210, 0.81); 
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(190, 190, 190, 0.5); 
        max-width: 500px; 
        width: 90%;
        position: relative;
        z-index: 2;
        color: black; 
        padding: 40px;
      }

      .reserve-logo {
        max-width: 150px;
        margin-bottom: 25px;
      }

      .reserve-message {
        color: #cf1500; 
        font-size: 2.2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 20px;
        font-family: 'Quicksand', sans-serif; 
        font-weight: 700; 
      }

      .secondary-message {
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 30px;
      }

      .reserve-box .form-label {
        color: #333; 
        font-weight: bold;
        text-align: left;
        display: block;
        margin-bottom: 8px;
      }

      .reserve-box .form-control,
      .reserve-box .form-select { 
        background-color: rgba(255, 255, 255, 0.6);
        border: 1px solid #f7d40f;
        color: black; 
        padding: 12px 15px;
        border-radius: 5px;
      }

      .reserve-box .form-control::placeholder {
        color: rgba(0, 0, 0, 0.5);
      }

      .reserve-box .form-control:focus,
      .reserve-box .form-select:focus {
        background-color: rgba(255, 255, 255, 0.8);
        border-color: #cf1500;
        box-shadow: 0 0 0 0.25rem rgba(207, 21, 0, 0.25);
        color: black;
      }

      .form-check-input {
          border-color: #f7d40f;
      }
      .form-check-input:checked {
          background-color: #cf1500;
          border-color: #cf1500;
      }
      .form-check-label {
          color: #333; 
      }
      .btn-reserve {
        background-color: #cf1500;
        border-color: #cf1500;
        color: white;
        font-weight: bold;
        padding: 12px 20px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
      }

      .btn-reserve:hover {
        background-color: #a01000;
        border-color: #a01000;
        color: white;
      }

      @media (max-width: 768px) {
        .reserve-container {
          padding: 20px 0;
        }
        .reserve-box {
          padding: 30px;
        }
        .reserve-message {
          font-size: 1.8rem;
        }
        .reserve-logo {
          max-width: 120px;
        }
      }

      @media (max-width: 480px) {
        .reserve-box {
          padding: 20px;
        }
        .reserve-message {
          font-size: 1.5rem;
        }
        .reserve-logo {
          max-width: 100px;
        }
      }
    </style>
  </head>

  <body>
    <div class="container mt-3 mb-3">
        <?php
        if (isset($_GET['erroLogin']) && $_GET['erroLogin'] == 'naoLogado') {
            echo "<div class='alert alert-warning text-center'><strong>USUÁRIO</strong> não logado! Você precisa fazer login para acessar esta página.</div>";
        }
    
        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) { 
            echo "<div class='alert alert-info text-center'>Você está logado como: <strong>" . htmlspecialchars($emailUsuario) . "</strong></div>"; 
        }

        if(isset($_GET['reserva'])){ 
            $statusReserva = $_GET['reserva']; 
            if($statusReserva == 'sucesso'){ 
                echo "<div class='alert alert-success text-center'>Reserva realizada com sucesso!</div>"; 
            } elseif ($statusReserva == 'erro'){ 
                echo "<div class='alert alert-danger text-center'>Erro ao realizar a reserva. Tente novamente.</div>"; 
            } elseif ($statusReserva == 'erroValidacao'){ 
                echo "<div class='alert alert-warning text-center'>Por favor, preencha todos os campos corretamente.</div>"; 
            } elseif ($statusReserva == 'excluidoSucesso'){ 
                echo "<div class='alert alert-success text-center'>Sua reserva foi excluída com sucesso!</div>"; 
            }
        }
        ?>
    </div>
    
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
      <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
          <div class="h-100 d-inline-flex align-items-center py-3 me-4">
            <small class="fa fa-map-marker-alt text-primary me-2"></small>
            <small>Isla Nublar, Costa Rica</small>
          </div>
          <div class="h-100 d-inline-flex align-items-center py-3">
            <small class="far fa-clock text-primary me-2"></small>
            <small>Seg - Sex : 09:00 - 19:00 Sáb - Dom : 8:00 - 20:00</small>
          </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
          <div class="h-100 d-inline-flex align-items-center py-3 me-4">
            <small class="fa fa-phone-alt text-primary me-2 style"></small>
            <small>+001 120 1990</small>
          </div>
          <div class="h-100 d-inline-flex align-items-center">
            <a class="btn btn-sm-square bg-white text-primary me-1" href="">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn btn-sm-square bg-white text-primary me-1" href="">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="btn btn-sm-square bg-white text-primary me-1" href="">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="btn btn-sm-square bg-white text-primary me-0" href="">
              <i class="fab fa-instagram"></i>
            </a>
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
        <h1 class="m-0" style="color: #cf1500">Jurassic Park</h1>
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
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
              >Paginas</a
            >
            <div class="dropdown-menu rounded-0 rounded-bottom m-0">
              <a href="listaReservas.php" class="dropdown-item">Reservas</a>
              <a href="feedback.php" class="dropdown-item">Feedbacks</a>
            </div>
          </div>
          <a href="contato.php" class="nav-item nav-link">Entre em contato</a>
          <a href="listaDino.php" class="nav-item nav-link">Visualizar Dinossauros</a>
          <?php if ($logado) :?>
            <?php if ($tipoUsuario == 'administrador') :?>
                <a href="formDino.php" class="nav-item nav-link">Cadastrar Dinossauro</a>
                <?php endif;?>
            <a href="logout.php" class="nav-item nav-link">Sair</a>
            <span class="nav-item nav-link" style="color: #cf1500">Olá, <strong><?php echo htmlspecialchars($primeiroNome); ?></strong>! <i class="bi bi-emoji-smile"></i></span>
          <?php else :?>
            <a href="formLogin.php" class="nav-item nav-link">Login</a>
            <a href="cadastro.php" class="nav-item nav-link">Cadastro</a>
          <?php endif;?>

        </div>
        <a
          href="formReservas.php"
          class="btn"
          style="background-color: #cf1500; border-color: #cf1500; color: #ffffff;"
          >Faça sua reserva!<i class="fa fa-arrow-right ms-3"></i
        ></a>
      </div>
    </nav>