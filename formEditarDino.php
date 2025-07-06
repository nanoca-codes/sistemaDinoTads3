<?php
session_start();

include "conexaoBD.php";

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

$logado = false;
$nomeUsuario = '';
$primeiroNome = '';
$emailUsuario = '';
$tipoUsuario = '';
$idUsuario = null;

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] !== 'administrador') {
    header('location: formLogin.php?erroLogin=naoAutorizado');
    exit();
} else {
    $logado = true;
    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $emailUsuario = $_SESSION['emailUsuario'];
    $tipoUsuario = isset($_SESSION['tipoUsuario']) ? $_SESSION['tipoUsuario'] : '';

    $nomeCompleto = explode(' ', $nomeUsuario);
    $primeiroNome = $nomeCompleto[0];
}

$idDinossauro = 0;
$nomeDinossauro = '';
$especieDinossauro = '';
$dietaDinossauro = '';
$generoDinossauro = '';
$fotoDinossauro = ''; 

$mensagemDisplay = "";

if(isset($_GET['id'])){
    $idDinossauro = intval($_GET['id']);

    if ($idDinossauro <= 0) {
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>ID do dinossauro inválido.</div>";
    } else {
        $buscarDino = "SELECT idDinossauro, nomeDinossauro, especieDinossauro, dietaDinossauro, generoDinossauro, fotoDinossauro
                       FROM dinossauros
                       WHERE idDinossauro = ?";
        
        if ($stmt = mysqli_prepare($conn, $buscarDino)) {
            mysqli_stmt_bind_param($stmt, "i", $idDinossauro);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            
            if ($registro = mysqli_fetch_assoc($resultado)) {
                $idDinossauro = $registro['idDinossauro'];
                $nomeDinossauro = $registro['nomeDinossauro'];
                $especieDinossauro = $registro['especieDinossauro'];
                $dietaDinossauro = $registro['dietaDinossauro'];
                $generoDinossauro = $registro['generoDinossauro'];
                $fotoDinossauro = $registro['fotoDinossauro'];
            } else {
                $mensagemDisplay .= "<div class='alert alert-danger text-center'>Dinossauro não encontrado.</div>";
                $idDinossauro = 0;
            }
            mysqli_stmt_close($stmt);
        } else {
            $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro ao preparar a consulta de busca do dinossauro.</div>";
            $idDinossauro = 0;
        }
    }
} else {
    $mensagemDisplay .= "<div class='alert alert-danger text-center'>Nenhum dinossauro especificado para edição.</div>";
}
mysqli_close($conn);

if (isset($_GET['statusDino'])) {
    $status = $_GET['statusDino'];
    if ($status == 'atualizadoSucesso') {
        $mensagemDisplay .= "<div class='alert alert-success text-center'>Dinossauro atualizado com sucesso!</div>";
    } elseif ($status == 'erroValidacaoEdicao') {
        $mensagemDisplay .= "<div class='alert alert-warning text-center'>Erro na validação dos dados do dinossauro. Por favor, preencha todos os campos corretamente.</div>";
    } elseif ($status == 'naoAtualizado') {
        $mensagemDisplay .= "<div class='alert alert-info text-center'>Nenhuma alteração foi feita no dinossauro.</div>";
    } elseif ($status == 'erroExecucaoBD') {
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro ao executar a atualização no banco de dados.</div>";
    } elseif ($status == 'erroQueryPreparacao') {
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro na preparação da consulta de atualização.</div>";
    } elseif ($status == 'erroConexaoBD') {
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro de conexão com o banco de dados.</div>";
    } elseif ($status == 'erroUpload') {
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro ao fazer upload da nova imagem.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Editar Dinossauro</title>
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
      .text-primary { color: #cf1500 !important; }
      .bg-primary { background-color: #cf1500 !important; }
      .btn.btn-sm-square.bg-white.text-primary { border: 1px solid #cf1500; }
      .btn.btn-sm-square.bg-white.text-primary:hover { background-color: #cf1500; color: white !important; }
      .fa-phone-alt, .fa-map-marker-alt, .far.fa-clock, .fab.fa-facebook-f, .fab.fa-twitter, .fab.fa-linkedin-in, .fab.fa-instagram { color: #cf1500 !important; }
      .btn-jurassic { background-color: #cf1500; border-color: #cf1500; color: #ffffff; }
      .btn-jurassic:hover { background-color: #a31100; border-color: #a31100; color: #ffffff; }

      .edit-container {
        min-height: calc(100vh - 150px);
        background: url('img/brachiosaurus_background.jpg') no-repeat center center;
        background-size: cover;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
      }
      .edit-container::before {
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
      .edit-box {
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
      .edit-logo {
        max-width: 150px;
        margin-bottom: 25px;
      }
      .edit-message {
        color: #cf1500;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 2.2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 20px;
      }
      .edit-box .form-label {
        color: #333;
        font-weight: bold;
        text-align: left;
        display: block;
        margin-bottom: 8px;
      }
      .edit-box .form-control,
      .edit-box .form-select {
        background-color: rgba(255, 255, 255, 0.6);
        border: 1px solid #f7d40f;
        color: black;
        padding: 12px 15px;
        border-radius: 5px;
      }
      .edit-box .form-control:focus,
      .edit-box .form-select:focus {
        border-color: #cf1500;
        box-shadow: 0 0 0 0.25rem rgba(207, 21, 0, 0.25);
      }
      .edit-box .form-check-input {
          border-color: #f7d40f;
      }
      .edit-box .form-check-input:checked {
          background-color: #cf1500;
          border-color: #cf1500;
      }
      .edit-box .form-check-label {
          color: #333;
      }
      .current-photo {
          max-width: 150px;
          height: auto;
          margin-top: 10px;
          border: 1px solid #ddd;
          border-radius: 5px;
      }
      .btn-save-changes {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-weight: bold;
        padding: 12px 20px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
      }
      .btn-save-changes:hover {
        background-color: #218838;
      }
      .btn-back-list {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        font-weight: bold;
        padding: 12px 20px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
      }
      .btn-back-list:hover {
        background-color: #5a6268;
      }

      @media (max-width: 768px) {
        .edit-box { padding: 30px; }
        .edit-message { font-size: 1.8rem; }
      }
      @media (max-width: 480px) {
        .edit-box { padding: 20px; }
        .edit-message { font-size: 1.5rem; }
      }
    </style>
  </head>

  <body>
    <?php include("header.php"); ?> <div class="container mt-3 mb-3">
        <?php echo $mensagemDisplay; ?>
    </div>

    <div class="container-fluid edit-container d-flex justify-content-center align-items-center">
      <div class="edit-box p-5 text-center wow fadeInUp" data-wow-delay="0.3s">
        <img
          class="edit-logo img-fluid mb-4"
          src="img/Jurassic_Park_logo.png"
          alt="Jurassic Park Logo"
        />
        <h2 class="edit-message mb-4">Editar Dinossauro</h2>
        
        <?php if ($idDinossauro > 0) :?>
        <form action="editarDino.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="idDinossauro" name="idDinossauro" value="<?php echo htmlspecialchars($idDinossauro); ?>">
          <input type="hidden" id="fotoAtual" name="fotoAtual" value="<?php echo htmlspecialchars($fotoDinossauro); ?>">
          
          <div class="form-group mb-3 text-start">
            <label for="nomeDinossauro" class="form-label">Nome do Dinossauro</label>
            <input
              type="text"
              class="form-control"
              id="nomeDinossauro"
              name="nomeDinossauro"
              placeholder="Ex: T-Rex"
              value="<?php echo htmlspecialchars($nomeDinossauro); ?>"
              required
            />
          </div>
          <div class="form-group mb-3 text-start">
            <label for="especieDinossauro" class="form-label">Espécie</label>
            <input
              type="text"
              class="form-control"
              id="especieDinossauro"
              name="especieDinossauro"
              placeholder="Ex: Tyrannosaurus Rex"
              value="<?php echo htmlspecialchars($especieDinossauro); ?>"
              required
            />
          </div>
          <div class="form-group mb-3 text-start">
            <label for="dietaDinossauro" class="form-label">Dieta</label>
            <select class="form-select" id="dietaDinossauro" name="dietaDinossauro" required>
              <option value="">Selecione a dieta</option>
              <option value="Carnívoro" <?php echo ($dietaDinossauro == 'Carnívoro') ? 'selected' : ''; ?>>Carnívoro</option>
              <option value="Herbívoro" <?php echo ($dietaDinossauro == 'Herbívoro') ? 'selected' : ''; ?>>Herbívoro</option>
              <option value="Onívoro" <?php echo ($dietaDinossauro == 'Onívoro') ? 'selected' : ''; ?>>Onívoro</option>
            </select>
          </div>
          <div class="form-group mb-3 text-start">
            <label for="generoDinossauro" class="form-label">Gênero</label>
            <select class="form-select" id="generoDinossauro" name="generoDinossauro" required>
              <option value="">Selecione o gênero</option>
              <option value="Macho" <?php echo ($generoDinossauro == 'Macho') ? 'selected' : ''; ?>>Macho</option>
              <option value="Fêmea" <?php echo ($generoDinossauro == 'Fêmea') ? 'selected' : ''; ?>>Fêmea</option>
            </select>
          </div>
          <div class="form-group mb-4 text-start">
            <label for="fotoDinossauro" class="form-label">Nova Foto do Dinossauro (opcional)</label>
            <?php if (!empty($fotoDinossauro) && file_exists($fotoDinossauro)) : ?>
                <div class="mb-2">
                    <small class="text-muted">Foto atual:</small><br>
                    <img src="<?php echo htmlspecialchars($fotoDinossauro); ?>" alt="Foto atual do dinossauro" class="img-thumbnail current-photo">
                </div>
            <?php endif; ?>
            <input
              type="file"
              class="form-control"
              id="fotoDinossauro"
              name="fotoDinossauro"
              accept="image/*"
            />
            <small class="form-text text-muted">Deixe em branco para manter a foto atual.</small>
          </div>
          
          <button type="submit" class="btn btn-save-changes w-100 mb-2">Salvar Alterações</button>
          <a href="listaDino.php" class="btn btn-back-list w-100">Voltar para Lista de Dinossauros</a>
        </form>
        <?php else : ?>
            <a href="listaDino.php" class="btn btn-back-list w-100">Voltar para Lista de Dinossauros</a>
        <?php endif; ?>
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
            <h5 class="text-light mb-4">Links rápidos</h5>
            <a class="btn btn-link" href="">Sobre nós</a>
            <a class="btn btn-link" href="">Entre em contato</a>
            <a class="btn btn-link" href="">Suporte</a>
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
                Assinar
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