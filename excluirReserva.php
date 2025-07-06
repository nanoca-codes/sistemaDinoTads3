<?php
session_start();

include "conexaoBD.php"; 

if (isset($_GET["id"])) {
    $idReserva = intval($_GET["id"]);

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario'])) {
        header('Location: formLogin.php?erroLogin=naoLogado');
        exit();
    }
    $idUsuarioLogado = $_SESSION['idUsuario'];

    if (!isset($conn) || !$conn) {
        header("Location: listaReservas.php?status=excluirErro&motivo=erroConexaoBD");
        exit();
    }

    $queryExcluirReserva = "DELETE FROM Reservas 
                            WHERE idReserva = '$idReserva' 
                            AND idUsuario = '$idUsuarioLogado'";

    if (mysqli_query($conn, $queryExcluirReserva)) {
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: listaReservas.php?status=excluidoSucesso");
            exit();
        } else {
            header("Location: listaReservas.php?status=excluirErro&motivo=naoEncontradoOuNaoPermitido");
            exit();
        }
    } else {
        header("Location: listaReservas.php?status=excluirErro&motivo=erroExecucaoBD");
        exit();
    }

    mysqli_close($conn);

} else {
    header("Location: listaReservas.php?status=excluirErro&motivo=idNaoFornecido");
    exit();
}
?>