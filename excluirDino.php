<?php
session_start();

include "conexaoBD.php";

if (isset($_GET["id"])) {
    $idDinossauro = intval($_GET["id"]);
    
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] !== 'administrador') {
        header('Location: formLogin.php?erroLogin=naoAutorizado');
        exit();
    }

    if (!isset($conn) || !$conn) {
        header("Location: listaDino.php?statusDino=excluirErro&motivo=erroConexaoBD");
        exit();
    }
    $queryBuscarFoto = "SELECT fotoDinossauro FROM dinossauros WHERE idDinossauro = ?";
    $fotoParaExcluir = '';

    if ($stmtFoto = mysqli_prepare($conn, $queryBuscarFoto)) {
        mysqli_stmt_bind_param($stmtFoto, "i", $idDinossauro);
        mysqli_stmt_execute($stmtFoto);
        mysqli_stmt_bind_result($stmtFoto, $fotoParaExcluir);
        mysqli_stmt_fetch($stmtFoto);
        mysqli_stmt_close($stmtFoto);
    }
    $queryExcluirDino = "DELETE FROM dinossauros WHERE idDinossauro = ?";

    if ($stmt = mysqli_prepare($conn, $queryExcluirDino)) {
        mysqli_stmt_bind_param($stmt, "i", $idDinossauro);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                if (!empty($fotoParaExcluir) && file_exists($fotoParaExcluir) && $fotoParaExcluir != "img/dino_placeholder.png") {
                    unlink($fotoParaExcluir);
                }
                header("Location: listaDino.php?statusDino=excluidoSucesso");
                exit();
            } else {
                header("Location: listaDino.php?statusDino=excluirErro&motivo=naoEncontrado");
                exit();
            }
        } else {
            error_log("Erro no MySQL (excluirDino.php): " . mysqli_stmt_error($stmt));
            header("Location: listaDino.php?statusDino=excluirErro&motivo=erroExecucaoBD");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Erro no MySQL (excluirDino.php) - Preparação da query: " . mysqli_error($conn));
        header("Location: listaDino.php?statusDino=excluirErro&motivo=erroQueryPreparacao");
        exit();
    }
    mysqli_close($conn);

} else {
    header("Location: listaDino.php?statusDino=excluirErro&motivo=idNaoFornecido");
    exit();
}
?>