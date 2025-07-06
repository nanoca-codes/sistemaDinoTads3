
<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<?php

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

$termoPesquisa = ""; 
$dataPesquisa = ""; 

// Lógica de pesquisa
$condicoesSQL = "WHERE idUsuario = ?"; 

if (isset($_GET['pesquisaArea']) && !empty($_GET['pesquisaArea'])) { 
    $termoPesquisa = testar_entrada($_GET['pesquisaArea']); 
    $condicoesSQL .= " AND areaVisita LIKE ?"; 
}

if (isset($_GET['pesquisaData']) && !empty($_GET['pesquisaData'])) { 
    $dataPesquisa = testar_entrada($_GET['pesquisaData']); 
    $condicoesSQL .= " AND dataVisita = ?"; 
}

$queryReservas = "SELECT idReserva, areaVisita, dataVisita, quantidadeVisitantes, comGuia 
                  FROM Reservas " . $condicoesSQL . " ORDER BY dataVisita DESC"; 

$reservas = []; 
$tiposBind = "i"; 

if ($stmt = mysqli_prepare($conn, $queryReservas)) { 
    $parametrosBind = [$idUsuario]; 

    if (!empty($termoPesquisa)) { 
        $termoPesquisaLike = '%' . $termoPesquisa . '%'; 
        $tiposBind .= "s"; 
        $parametrosBind[] = $termoPesquisaLike; 
    } 
    if (!empty($dataPesquisa)) { 
        $tiposBind .= "s"; 
        $parametrosBind[] = $dataPesquisa; 
    } 

    mysqli_stmt_bind_param($stmt, $tiposBind, ...$parametrosBind); 
    
    mysqli_stmt_execute($stmt); 
    $resultado = mysqli_stmt_get_result($stmt); 

    while ($row = mysqli_fetch_assoc($resultado)) { 
        $reservas[] = $row; 
    } 
    mysqli_stmt_close($stmt); 
} else { 
    
}
mysqli_close($conn); 
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Minhas Reservas</title>
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

      .reservas-hero {
        background: linear-gradient(rgba(216, 216, 216, 0.7), rgba(173, 173, 173, 0.7)), url('img/brachiosaurus_background.jpg') no-repeat center center;
        background-size: cover;
        padding: 100px 0;
        color: white;
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden; 
      }
      .reservas-hero h1 {
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 3.5rem;
        text-shadow: 2px 2px 4px #cf1500; color: #cf1500;
      }
      .reservas-hero p {
        font-size: 1.2rem;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
      }

      .reservas-section {
        padding: 50px 0;
        background-color: #f0f2f5; 
      }
      .reservas-card {
        background-color: #ffffff;
        border-radius: 12px; 
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); 
        padding: 40px;
        margin-bottom: 30px;
        overflow: hidden; 
      }
      .reservas-card .card-header {
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
      .reservas-card .card-header + * { 
      }
      
      .search-form {
        background-color: #f8f9fa; 
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 40px;
        border: 1px solid #e0e0e0;
      }
      .search-form .form-control {
        border-radius: 6px;
        border-color: #ddd;
      }
      .search-form .form-control:focus {
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

      .alert {
        border-radius: 8px;
        font-size: 1.1rem;
        padding: 15px 20px;
        margin-bottom: 20px;
      }

      @media (max-width: 768px) {
        .reservas-hero h1 {
          font-size: 2.5rem;
        }
        .reservas-hero p {
          font-size: 1rem;
        }
        .reservas-card {
          padding: 20px;
        }
        .reservas-card .card-header {
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
      }
    </style>
  </head>
    <div class="container-fluid reservas-hero">
        <div class="container">
            <h1 class="display-3 mb-3 wow fadeInDown" data-wow-delay="0.1s">Suas Aventuras no Jurassic Park</h1>
            <p class="lead wow fadeInUp" data-wow-delay="0.3s">Gerencie todas as suas reservas em um só lugar. Edite ou exclua suas visitas com facilidade.</p>
        </div>
    </div>

    <div class="container-xxl reservas-section">
        <div class="container">
            <div class="reservas-card wow fadeInUp" data-wow-delay="0.5s">
                <div class="card-header">
                    Suas Reservas Realizadas
                </div>
                
                <?php
                if (isset($_GET['status'])) { 
                    $statusMensagem = $_GET['status'];
                    if($statusMensagem == 'excluidoSucesso'){
                        echo "<div class='alert alert-success text-center mt-3 mb-3'>Sua reserva foi excluída com sucesso!</div>";
                    } elseif ($statusMensagem == 'excluirErro'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro ao excluir a reserva. Tente novamente.</div>";
                    } elseif ($statusMensagem == 'atualizadoSucesso'){ 
                        echo "<div class='alert alert-success text-center mt-3 mb-3'>Sua reserva foi atualizada com sucesso!</div>";
                    } elseif ($statusMensagem == 'erroValidacaoEdicao'){
                        echo "<div class='alert alert-warning text-center mt-3 mb-3'>Erro na validação dos dados da reserva. Por favor, preencha todos os campos corretamente.</div>";
                    } elseif ($statusMensagem == 'naoAtualizado'){
                        echo "<div class='alert alert-info text-center mt-3 mb-3'>Nenhuma alteração foi feita na reserva, ou a reserva não foi encontrada.</div>";
                    } elseif ($statusMensagem == 'erroExecucaoBD'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro ao executar a atualização no banco de dados.</div>";
                    } elseif ($statusMensagem == 'erroQueryPreparacao'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro na preparação da consulta de atualização.</div>";
                    } elseif ($statusMensagem == 'erroConexaoBD'){
                        echo "<div class='alert alert-danger text-center mt-3 mb-3'>Erro de conexão com o banco de dados.</div>";
                    }
                }
                ?>

                <form action="listaReservas.php" method="GET" class="search-form mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5 col-lg-4">
                            <label for="pesquisaArea" class="form-label text-dark fw-bold">Pesquisar por Área</label>
                            <input type="text" class="form-control" id="pesquisaArea" name="pesquisaArea" placeholder="Ex: carnívoros, jipe" value="<?php echo htmlspecialchars($termoPesquisa); ?>">
                        </div>
                        <div class="col-md-5 col-lg-4">
                            <label for="pesquisaData" class="form-label text-dark fw-bold">Pesquisar por Data</label>
                            <input type="date" class="form-control" id="pesquisaData" name="pesquisaData" value="<?php echo htmlspecialchars($dataPesquisa); ?>">
                        </div>
                        <div class="col-md-2 col-lg-2 d-grid">
                            <button type="submit" class="btn btn-jurassic">Buscar</button>
                        </div>
                        <div class="col-md-2 col-lg-2 d-grid">
                            <?php if (!empty($termoPesquisa) || !empty($dataPesquisa)) : ?>
                                <a href="listaReservas.php" class="btn btn-outline-secondary">Limpar Filtros</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

                <?php if (empty($reservas)) : ?>
                    <div class="alert alert-info text-center">Nenhuma reserva encontrada com os filtros aplicados ou para você.</div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Área da Visita</th>
                                    <th>Data</th>
                                    <th>Visitantes</th>
                                    <th>Guia</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservas as $reserva) : ?>
                                    <tr>
                                        <td>#<?php echo htmlspecialchars($reserva['idReserva']); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($reserva['areaVisita'])); ?></td>
                                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($reserva['dataVisita']))); ?></td>
                                        <td><?php echo htmlspecialchars($reserva['quantidadeVisitantes']); ?></td>
                                        <td><?php echo $reserva['comGuia'] ? 'Sim' : 'Não'; ?></td>
                                        <td>
                                            <a href="formEditarReserva.php?id=<?php echo htmlspecialchars($reserva['idReserva']); ?>" class="btn btn-edit btn-action me-2">Editar</a>
                                            <a href="excluirReserva.php?id=<?php echo htmlspecialchars($reserva['idReserva']); ?>" class="btn btn-delete btn-action" onclick="return confirm('ATENÇÃO: Tem certeza que deseja excluir esta reserva? Esta ação é irreversível!');">Excluir</a>
                                        </td>
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