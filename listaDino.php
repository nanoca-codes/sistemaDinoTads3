<?php 
include("validarSessao.php"); 
include("header.php");

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

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario'])) {
    header('location: formLogin.php?erroLogin=naoLogado');
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

$termoPesquisaNome = "";
$termoPesquisaEspecie = "";
$termoPesquisaDieta = "";

$condicoesSQL = "WHERE 1=1";

if (isset($_GET['pesquisaNome']) && !empty($_GET['pesquisaNome'])) {
    $termoPesquisaNome = testar_entrada($_GET['pesquisaNome']);
    $condicoesSQL .= " AND nomeDinossauro LIKE ?";
}

if (isset($_GET['pesquisaEspecie']) && !empty($_GET['pesquisaEspecie'])) {
    $termoPesquisaEspecie = testar_entrada($_GET['pesquisaEspecie']);
    $condicoesSQL .= " AND especieDinossauro LIKE ?";
}

if (isset($_GET['pesquisaDieta']) && !empty($_GET['pesquisaDieta'])) {
    $termoPesquisaDieta = testar_entrada($_GET['pesquisaDieta']);
    $condicoesSQL .= " AND dietaDinossauro = ?";
}

$queryDinossauros = "SELECT idDinossauro, nomeDinossauro, especieDinossauro, dietaDinossauro, generoDinossauro, fotoDinossauro
                     FROM dinossauros " . $condicoesSQL . " ORDER BY nomeDinossauro ASC";

$dinossauros = [];
$tiposBind = "";
$parametrosBind = [];

if ($stmt = mysqli_prepare($conn, $queryDinossauros)) {
    if (!empty($termoPesquisaNome)) {
        $termoPesquisaNomeLike = '%' . $termoPesquisaNome . '%';
        $tiposBind .= "s";
        $parametrosBind[] = $termoPesquisaNomeLike;
    }
    if (!empty($termoPesquisaEspecie)) {
        $termoPesquisaEspecieLike = '%' . $termoPesquisaEspecie . '%';
        $tiposBind .= "s";
        $parametrosBind[] = $termoPesquisaEspecieLike;
    }
    if (!empty($termoPesquisaDieta)) {
        $tiposBind .= "s";
        $parametrosBind[] = $termoPesquisaDieta;
    }

    if (!empty($tiposBind)) {
        mysqli_stmt_bind_param($stmt, $tiposBind, ...$parametrosBind);
    }
    
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($resultado)) {
        $dinossauros[] = $row;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Nossos Dinossauros</title>
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

      .dinos-hero {
        background: linear-gradient(rgba(216, 216, 216, 0.7), rgba(173, 173, 173, 0.7)), url('img/dino_list_background.jpg') no-repeat center center;
        background-size: cover;
        padding: 100px 0;
        color: white;
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
      }
      .dinos-hero h1 {
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 3.5rem;
        text-shadow: 2px 2px 4px #cf1500; color: #cf1500;
      }
      .dinos-hero p {
        font-size: 1.2rem;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
      }

      .dinos-section {
        padding: 50px 0;
        background-color: #f0f2f5;
      }
      .dinos-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-bottom: 30px;
        overflow: hidden;
      }
      .dinos-card .card-header {
        background-color: #cf1500;
        color: white;
        padding: 20px 30px;
        margin: -40px -40px 30px -40px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 1.8rem;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }
      .dinos-card .card-header + * {
        margin-top: 30px;
      }
      
      .search-form {
        background-color: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 40px;
        border: 1px solid #e0e0e0;
      }
      .search-form .form-control, .search-form .form-select {
        border-radius: 6px;
        border-color: #ddd;
      }
      .search-form .form-control:focus, .search-form .form-select:focus {
        border-color: #cf1500;
        box-shadow: 0 0 0 0.25rem rgba(207, 21, 0, 0.25);
      }
      .search-form .btn-jurassic {
        border-radius: 6px;
      }

      .table {
        margin-bottom: 0;
      }
      .table thead th {
        background-color: #cf1500;
        color: white;
        border-color: #a31100;
        font-weight: 600;
        font-size: 1rem;
        padding: 15px 12px;
      }
      .table tbody tr td {
        vertical-align: middle;
        padding: 12px;
      }
      .table tbody tr:nth-child(even) {
        background-color: #fefefe;
      }
      .table tbody tr:hover {
        background-color: #f5f5f5;
      }
      .btn-action {
        padding: 8px 15px;
        font-size: 0.875rem;
        border-radius: 5px;
        transition: all 0.3s ease;
      }
      .btn-edit {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
      }
      .btn-edit:hover {
        background-color: #218838;
        border-color: #1e7e34;
      }
      .btn-delete {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
      }
      .btn-delete:hover {
        background-color: #c82333;
        border-color: #bd2130;
      }
      .dino-foto {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #cf1500;
      }

      .alert {
        border-radius: 8px;
        font-size: 1.1rem;
        padding: 15px 20px;
        margin-bottom: 20px;
      }

      @media (max-width: 768px) {
        .dinos-hero h1 {
          font-size: 2.5rem;
        }
        .dinos-hero p {
          font-size: 1rem;
        }
        .dinos-card {
          padding: 20px;
        }
        .dinos-card .card-header {
          margin: -20px -20px 20px -20px;
          padding: 15px;
          font-size: 1.5rem;
        }
        .table thead th, .table tbody tr td {
          padding: 10px;
          font-size: 0.9rem;
        }
        .btn-action {
          padding: 6px 10px;
          font-size: 0.8rem;
        }
        .dino-foto {
            width: 60px;
            height: 60px;
        }
      }
    </style>
  </head>
    <div class="container-fluid dinos-hero">
        <div class="container">
            <h1 class="display-3 mb-3 wow fadeInDown" data-wow-delay="0.1s">Nossos Habitantes Pré-Históricos</h1>
            <p class="lead wow fadeInUp" data-wow-delay="0.3s">Conheça os incríveis dinossauros que chamam o Jurassic Park de lar!</p>
        </div>
    </div>

    <div class="container-xxl dinos-section">
        <div class="container">
            <div class="dinos-card wow fadeInUp" data-wow-delay="0.5s">
                <div class="card-header">
                    Dinossauros Cadastrados
                </div>
                
                <?php
                if (isset($_GET['statusDino'])) {
                    $statusMensagem = $_GET['statusDino'];
                    if($statusMensagem == 'excluidoSucesso'){
                        echo "<div class='alert alert-success text-center mt-3 mb-3'>Dinossauro excluído com sucesso!</div>";
                    } elseif ($statusMensagem == 'excluirErro'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro ao excluir o dinossauro. Tente novamente.</div>";
                    } elseif ($statusMensagem == 'atualizadoSucesso'){
                        echo "<div class='alert alert-success text-center mt-3 mb-3'>Dinossauro atualizado com sucesso!</div>";
                    } elseif ($statusMensagem == 'erroValidacaoEdicao'){
                        echo "<div class='alert alert-warning text-center mt-3 mb-3'>Erro na validação dos dados do dinossauro. Por favor, preencha todos os campos corretamente.</div>";
                    } elseif ($statusMensagem == 'naoAtualizado'){
                        echo "<div class='alert alert-info text-center mt-3 mb-3'>Nenhuma alteração foi feita no dinossauro, ou o dinossauro não foi encontrado.</div>";
                    } elseif ($statusMensagem == 'erroExecucaoBD'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro ao executar a atualização no banco de dados.</div>";
                    } elseif ($statusMensagem == 'erroQueryPreparacao'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro na preparação da consulta de atualização.</div>";
                    } elseif ($statusMensagem == 'erroConexaoBD'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro de conexão com o banco de dados.</div>";
                    }
                }
                ?>

                <form action="listaDino.php" method="GET" class="search-form mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="pesquisaNome" class="form-label text-dark fw-bold">Pesquisar por Nome</label>
                            <input type="text" class="form-control" id="pesquisaNome" name="pesquisaNome" placeholder="Ex: Rex" value="<?php echo htmlspecialchars($termoPesquisaNome); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="pesquisaEspecie" class="form-label text-dark fw-bold">Pesquisar por Espécie</label>
                            <input type="text" class="form-control" id="pesquisaEspecie" name="pesquisaEspecie" placeholder="Ex: Tyrannosaurus" value="<?php echo htmlspecialchars($termoPesquisaEspecie); ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="pesquisaDieta" class="form-label text-dark fw-bold">Filtrar por Dieta</label>
                            <select class="form-select" id="pesquisaDieta" name="pesquisaDieta">
                                <option value="">Todas</option>
                                <option value="Carnívoro" <?php echo ($termoPesquisaDieta == 'Carnívoro') ? 'selected' : ''; ?>>Carnívoro</option>
                                <option value="Herbívoro" <?php echo ($termoPesquisaDieta == 'Herbívoro') ? 'selected' : ''; ?>>Herbívoro</option>
                                <option value="Onívoro" <?php echo ($termoPesquisaDieta == 'Onívoro') ? 'selected' : ''; ?>>Onívoro</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-jurassic">Buscar</button>
                        </div>
                        <div class="col-12 d-grid">
                            <?php if (!empty($termoPesquisaNome) || !empty($termoPesquisaEspecie) || !empty($termoPesquisaDieta)) : ?>
                                <a href="listaDino.php" class="btn btn-outline-secondary">Limpar Filtros</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

                <?php if (empty($dinossauros)) : ?>
                    <div class="alert alert-info text-center">Nenhum dinossauro encontrado com os filtros aplicados.</div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <th>Espécie</th>
                                    <th>Dieta</th>
                                    <th>Gênero</th>
                                    <?php if ($tipoUsuario == 'administrador') : ?>
                                    <th>Ações</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dinossauros as $dino) : ?>
                                    <tr>
                                        <td>#<?php echo htmlspecialchars($dino['idDinossauro']); ?></td>
                                        <td>
                                            <?php if (!empty($dino['fotoDinossauro']) && file_exists($dino['fotoDinossauro'])) : ?>
                                                <img src="<?php echo htmlspecialchars($dino['fotoDinossauro']); ?>" alt="Foto de <?php echo htmlspecialchars($dino['nomeDinossauro']); ?>" class="dino-foto">
                                            <?php else : ?>
                                                <img src="img/dino_placeholder.png" alt="Sem foto" class="dino-foto">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($dino['nomeDinossauro']); ?></td>
                                        <td><?php echo htmlspecialchars($dino['especieDinossauro']); ?></td>
                                        <td><?php echo htmlspecialchars($dino['dietaDinossauro']); ?></td>
                                        <td><?php echo htmlspecialchars($dino['generoDinossauro']); ?></td>
                                        <?php if ($tipoUsuario == 'administrador') : ?>
                                        <td>
                                            <a href="formEditarDino.php?id=<?php echo htmlspecialchars($dino['idDinossauro']); ?>" class="btn btn-edit btn-action me-2">Editar</a>
                                            <a href="excluirDino.php?id=<?php echo htmlspecialchars($dino['idDinossauro']); ?>" class="btn btn-delete btn-action" onclick="return confirm('ATENÇÃO: Tem certeza que deseja excluir este dinossauro? Esta ação é irreversível!');">Excluir</a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
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
            <h5 class="text-light mb-4">Links rápidos</h5>
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