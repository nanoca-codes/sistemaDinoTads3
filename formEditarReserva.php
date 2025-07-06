<?php
session_start(); // Inicia a sessão PHP. DEVE SER A PRIMEIRA LINHA.

// Inclui o arquivo de conexão com o banco de dados.
include "conexaoBD.php"; 

// Função para testar e sanitizar a entrada de dados.
function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

// Inicia variáveis para controle da sessão e dados do usuário logado
$logado = false;
$nomeUsuario = '';
$primeiroNome = '';
$emailUsuario = '';
$tipoUsuario = '';
$idUsuario = null;

// Verifica se o usuário está logado. Se não estiver, redireciona para a página de login.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario'])) {
    header('location: formLogin.php?erroLogin=naoLogado');
    exit();
} else {
    // Se logado, preenche as variáveis do usuário
    $logado = true;
    $idUsuario = $_SESSION['idUsuario']; // ID do usuário logado
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $emailUsuario = $_SESSION['emailUsuario'];
    $tipoUsuario = isset($_SESSION['tipoUsuario']) ? $_SESSION['tipoUsuario'] : '';

    $nomeCompleto = explode(' ', $nomeUsuario);
    $primeiroNome = $nomeCompleto[0];
}

// Variáveis para armazenar os dados da reserva a ser editada
$idReserva = 0;
$areaVisita = '';
$dataVisita = '';
$quantidadeVisitantes = 0;
$comGuia = 0; // Será 0 ou 1

$mensagemDisplay = ""; // Para acumular e exibir mensagens de erro/sucesso na própria página

// ----------------------------------------------------
// Lógica para buscar os dados da reserva (similar ao seu exemplo de produto)
// ----------------------------------------------------
if(isset($_GET['id'])){
    $idReserva = intval($_GET['id']); // Converte para inteiro para segurança

    // Verifica se a reserva deve ser carregada ou se a página está exibindo uma mensagem pós-exclusão
    if(isset($_GET['status']) && $_GET['status'] == 'excluidoSucesso') {
        // Não tenta carregar os dados, apenas exibe a mensagem de sucesso
        $mensagemDisplay .= "<div class='alert alert-success text-center mt-3 mb-3'>Reserva excluída com sucesso!</div>";
        // OPCIONAL: Redirecionar para listaReservas.php após um pequeno delay
        // echo '<meta http-equiv="refresh" content="3;url=listaReservas.php">';
        // EXIT para garantir que o formulário não seja exibido
        // exit(); // Descomente para que a página redirecione após a exclusão
    } 
    
    // Agora, busca a reserva SOMENTE se não for uma exibição pós-exclusão e ID for válido
    if ($idReserva <= 0 && !isset($_GET['status'])) { // Se ID for inválido E não for uma mensagem de status.
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>ID da reserva inválido.</div>";
    } elseif ($idReserva > 0) { // Tenta buscar a reserva apenas se o ID for válido
        // Prepara a consulta para buscar a reserva, garantindo que pertença ao usuário logado
        $buscarReserva = "SELECT idReserva, areaVisita, dataVisita, quantidadeVisitantes, comGuia 
                          FROM Reservas 
                          WHERE idReserva = ? AND idUsuario = ?";
        
        if ($stmt = mysqli_prepare($conn, $buscarReserva)) {
            mysqli_stmt_bind_param($stmt, "ii", $idReserva, $idUsuario);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            
            if ($registro = mysqli_fetch_assoc($resultado)) {
                $idReserva          = $registro['idReserva'];
                $areaVisita         = $registro['areaVisita'];
                $dataVisita         = $registro['dataVisita'];
                $quantidadeVisitantes = $registro['quantidadeVisitantes'];
                $comGuia            = $registro['comGuia']; // 0 ou 1
            } else {
                // Se a reserva não for encontrada, exibe mensagem e não exibe o formulário.
                $mensagemDisplay .= "<div class='alert alert-danger text-center'>Reserva não encontrada ou você não tem permissão para editá-la.</div>";
                // Limpa o ID da reserva para que o formulário não seja exibido.
                $idReserva = 0; 
            }
            mysqli_stmt_close($stmt);
        } else {
            $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro ao preparar a consulta de busca da reserva.</div>";
            $idReserva = 0; // Impede a exibição do formulário.
        }
    }
} else {
    // Se não há ID na URL, exibe uma mensagem.
    $mensagemDisplay .= "<div class='alert alert-danger text-center'>Nenhuma reserva especificada para edição.</div>";
}
mysqli_close($conn); // Fecha a conexão após buscar os dados

// ----------------------------------------------------
// Mensagens de status (sucesso/erro da atualização ou exclusão)
// ----------------------------------------------------
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    // Mensagens de edição
    if ($status == 'editadoSucesso') {
        $mensagemDisplay .= "<div class='alert alert-success text-center'>Reserva atualizada com sucesso!</div>";
    } elseif ($status == 'editarErro') {
        $motivo = $_GET['motivo'] ?? 'desconhecido';
        $mensagemDisplay .= "<div class='alert alert-danger text-center'>Erro ao atualizar a reserva. Motivo: " . htmlspecialchars($motivo) . "</div>";
    } elseif ($status == 'erroValidacao') {
        $camposErro = $_GET['campos'] ?? '';
        $mensagemDetalhe = "";
        if (!empty($camposErro)) {
            $campos = explode(',', $camposErro);
            $mensagensCampo = [
                'idInvalido' => 'ID da reserva inválido',
                'areaVazia' => 'Área do Parque é obrigatória',
                'areaInvalida' => 'Área do Parque selecionada é inválida',
                'dataVazia' => 'Data da Visita é obrigatória',
                'dataInvalida' => 'Data da Visita é inválida ou no passado',
                'quantidadeVazia' => 'Quantidade de Visitantes é obrigatória',
                'quantidadeInvalida' => 'Quantidade de Visitantes inválida',
            ];
            $errosListados = [];
            foreach ($campos as $campo) {
                if (isset($mensagensCampo[$campo])) {
                    $errosListados[] = $mensagensCampo[$campo];
                }
            }
            if (!empty($errosListados)) {
                $mensagemDetalhe = " Detalhes: " . implode(', ', $errosListados) . ".";
            }
        }
        $mensagemDisplay .= "<div class='alert alert-warning text-center'>Por favor, preencha todos os campos corretamente!" . $mensagemDetalhe . "</div>";
    }
    // A mensagem de 'excluidoSucesso' já é tratada acima para evitar carregar o formulário.
    // Outros status de exclusão (excluirErro) são tratados aqui, mas o fluxo ideal seria voltar para listaReservas.php
    // if ($status == 'excluidoSucesso') { // Isso é tratado no primeiro if, antes de tentar carregar a reserva
    //    $mensagemDisplay .= "<div class='alert alert-success text-center'>Reserva excluída com sucesso!</div>";
    // }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Jurassic Park - Editar Reserva</title>
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
      /* Estilos globais e cores (do seu header.php/style.css) */
      .text-primary { color: #cf1500 !important; }
      .bg-primary { background-color: #cf1500 !important; }
      .btn.btn-sm-square.bg-white.text-primary { border: 1px solid #cf1500; }
      .btn.btn-sm-square.bg-white.text-primary:hover { background-color: #cf1500; color: white !important; }
      .fa-phone-alt, .fa-map-marker-alt, .far.fa-clock, .fab.fa-facebook-f, .fab.fa-twitter, .fab.fa-linkedin-in, .fab.fa-instagram { color: #cf1500 !important; }
      .btn-jurassic { background-color: #cf1500; border-color: #cf1500; color: #ffffff; }
      .btn-jurassic:hover { background-color: #a31100; border-color: #a31100; color: #ffffff; }

      /* Estilos específicos para o formulário de edição (inspirados nos seus forms de login/cadastro/reserva) */
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
              <a href="dino.php" class="dropdown-item">Nossos Dinossauros</a>
              <a href="horario.php" class="dropdown-item">Horas de visita</a>
              <a href="feedback.php" class="dropdown-item">Feedbacks</a>
            </div>
          </div>
          <a href="contato.php" class="nav-item nav-link">Entre em contato</a>

          <?php if ($logado) : ?>
            <?php if ($tipoUsuario == 'administrador') :?>
                <a href="formProduto.php" class="nav-item nav-link">Cadastrar Produto</a>
                <?php endif;?>
            <?php if ($tipoUsuario == 'cliente') :?>
                <a href="listaReservas.php" class="nav-item nav-link">Minhas Reservas</a>
                <?php endif;?>

            <a href="formReservas.php" class="nav-item nav-link">Reservar</a> <a href="logout.php" class="nav-item nav-link">Sair</a>
            <span class="nav-item nav-link" style="color:lightblue">Olá, <strong><?php echo htmlspecialchars($primeiroNome); ?></strong>! <i class="bi bi-emoji-smile"></i></span>
          <?php else : ?>
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
    <div class="container mt-3 mb-3">
        <?php echo $mensagemDisplay; ?>
    </div>

    <div class="container-fluid edit-container d-flex justify-content-center align-items-center">
      <div class="edit-box p-5 text-center wow fadeInUp" data-wow-delay="0.3s">
        <img
          class="edit-logo img-fluid mb-4"
          src="img/Jurassic_Park_logo.png"
          alt="Jurassic Park Logo"
        />
        <h2 class="edit-message mb-4">Editar Sua Reserva</h2>
        
        <?php if (empty($mensagemErro)) : ?>
        <form action="editarReserva.php" method="POST">
          <input type="hidden" id="idReserva" name="idReserva" value="<?php echo htmlspecialchars($idReserva); ?>">
          
          <div class="form-group mb-3 text-start">
            <label for="areaVisita" class="form-label">Área do Parque</label>
            <select class="form-select" id="areaVisita" name="area_visita" required>
              <option value="carnivoros" <?php echo ($areaVisita == 'carnivoros') ? 'selected' : ''; ?>>Área dos Carnívoros</option>
              <option value="herbivoros" <?php echo ($areaVisita == 'herbivoros') ? 'selected' : ''; ?>>Área dos Herbívoros</option>
              <option value="jipe" <?php echo ($areaVisita == 'jipe') ? 'selected' : ''; ?>>Passeio de Jipe</option>
              <option value="laboratorio" <?php echo ($areaVisita == 'laboratorio') ? 'selected' : ''; ?>>Laboratório</option>
              <option value="museu" <?php echo ($areaVisita == 'museu') ? 'selected' : ''; ?>>Museu</option>
            </select>
          </div>
          
          <div class="form-group mb-3 text-start">
            <label for="dataVisita" class="form-label">Data da Visita</label>
            <input type="date" class="form-control" id="dataVisita" name="data_visita" value="<?php echo htmlspecialchars($dataVisita); ?>" required>
          </div>
          
          <div class="form-group mb-3 text-start">
            <label for="quantidadeVisitantes" class="form-label">Quantidade de Visitantes</label>
            <input type="number" class="form-control" id="quantidadeVisitantes" name="quantidade_visitantes" min="1" value="<?php echo htmlspecialchars($quantidadeVisitantes); ?>" required>
          </div>
          
          <div class="form-group mb-4 text-start">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="sim" id="comGuia" name="com_guia" <?php echo ($comGuia == 1) ? 'checked' : ''; ?>>
              <label class="form-check-label" for="comGuia">
                Deseja um guia?
              </label>
            </div>
          </div>
          
          <button type="submit" class="btn btn-save-changes w-100 mb-2">Salvar Alterações</button>
          <a href="listaReservas.php" class="btn btn-back-list w-100">Voltar para Minhas Reservas</a>
        </form>
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