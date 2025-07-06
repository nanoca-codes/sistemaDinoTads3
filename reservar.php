<?php
session_start(); 
include "conexaoBD.php"; 

function testar_entrada($dado) {
    $dado = trim($dado);       
    $dado = stripslashes($dado); 
    $dado = htmlspecialchars($dado); 
    return $dado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario'])) {
        header('location: formLogin.php?erroLogin=naoLogado'); 
        exit();
    }

    $idUsuario = $_SESSION['idUsuario']; 
    $urlRedirecionamentoErro = "formReservas.php?reserva="; 
    $area_visita = $data_visita = $quantidade_visitantes = ""; 
    $com_guia = 0; 

    if (empty($_POST["area_visita"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=areaVazia");
        exit();
    } else {
        $area_visita = testar_entrada($_POST["area_visita"]);
        $areasPermitidas = ['carnivoros', 'herbivoros', 'jipe', 'laboratorio', 'museu'];
        if (!in_array($area_visita, $areasPermitidas)) {
            header($urlRedirecionamentoErro . "erroValidacao&campo=areaInvalida");
            exit();
        }
    }

    if (empty($_POST["data_visita"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=dataVazia");
        exit();
    } else {
        $data_visita = testar_entrada($_POST["data_visita"]);
        if (!strtotime($data_visita) || strtotime($data_visita) < strtotime(date('Y-m-d'))) {
            header($urlRedirecionamentoErro . "erroValidacao&campo=dataInvalida");
            exit();
        }
    }

    if (empty($_POST["quantidade_visitantes"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=quantidadeVazia");
        exit();
    } elseif (!is_numeric($_POST["quantidade_visitantes"]) || intval($_POST["quantidade_visitantes"]) < 1) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=quantidadeInvalida");
        exit();
    } else {
        $quantidade_visitantes = intval(testar_entrada($_POST["quantidade_visitantes"]));
    }

    $com_guia = (isset($_POST['com_guia']) && $_POST['com_guia'] == 'sim') ? 1 : 0; 

    if (!$conn) {
        header($urlRedirecionamentoErro . "erroConexaoBD");
        exit();
    }

    $inserirReserva = "INSERT INTO Reservas (idUsuario, areaVisita, dataVisita, quantidadeVisitantes, comGuia)
                       VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $inserirReserva)) {
        mysqli_stmt_bind_param($stmt, "issii", $idUsuario, $area_visita, $data_visita, $quantidade_visitantes, $com_guia);

        if (mysqli_stmt_execute($stmt)) {
            header("location: formReservas.php?reserva=sucesso");
            exit();
        } else {
            header($urlRedirecionamentoErro . "erroInsercaoBD");
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        header($urlRedirecionamentoErro . "erroQueryInsercao");
        mysqli_close($conn);
        exit();
    }

    mysqli_close($conn); 

} else {
    header("location: formReservas.php");
    exit();
}
?>