<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 
include "conexaoBD.php"; 

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario'])) {
    header('location: formLogin.php?erroLogin=naoLogado');
    exit();
}

$idUsuarioLogado = $_SESSION['idUsuario']; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReserva = intval($_POST['idReserva'] ?? 0);
    $area_visita = testar_entrada($_POST['area_visita'] ?? '');
    $data_visita = testar_entrada($_POST['data_visita'] ?? '');
    $quantidade_visitantes = intval($_POST['quantidade_visitantes'] ?? 0);
    $com_guia = isset($_POST['com_guia']) ? 1 : 0; 

    $erros = []; 

    if ($idReserva <= 0) {
        $erros[] = "idInvalido";
    }

    $areasPermitidas = ['carnivoros', 'herbivoros', 'jipe', 'laboratorio', 'museu'];
    if (empty($area_visita) || !in_array($area_visita, $areasPermitidas)) {
        $erros[] = "areaInvalida";
    }

    if (empty($data_visita)) {
        $erros[] = "dataVazia";
    } else {
        $dataAtual = date('Y-m-d');
        if (!strtotime($data_visita) || $data_visita < $dataAtual) { 
            $erros[] = "dataInvalida";
        }
    }

    if ($quantidade_visitantes <= 0) {
        $erros[] = "quantidadeInvalida";
    }
    if (!empty($erros)) {
        header("location: listaReservas.php?status=erroValidacaoEdicao&campos=" . implode(',', $erros));
        exit();
    }    
    if (!$conn) {
        header("location: listaReservas.php?status=erroConexaoBD");
        exit();
    }
    $queryAtualizar = "UPDATE Reservas SET areaVisita = ?, dataVisita = ?, quantidadeVisitantes = ?, comGuia = ? WHERE idReserva = ? AND idUsuario = ?";
    if ($stmt = mysqli_prepare($conn, $queryAtualizar)) {
        mysqli_stmt_bind_param($stmt, "ssiiii", $area_visita, $data_visita, $quantidade_visitantes, $com_guia, $idReserva, $idUsuarioLogado);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: listaReservas.php?status=atualizadoSucesso");
                exit();
            } else {
                header("location: listaReservas.php?status=naoAtualizado");
                exit();
            }
        } else {
            error_log("Erro no MySQL (editarReserva.php): " . mysqli_stmt_error($stmt));
            header("location: listaReservas.php?status=erroExecucaoBD");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Erro no MySQL (editarReserva.php) - Preparação da query: " . mysqli_error($conn));
        header("location: listaReservas.php?status=erroQueryPreparacao");
        exit();
    }

    mysqli_close($conn); 

} else {
    header("location: listaReservas.php");
    exit();
}
?>