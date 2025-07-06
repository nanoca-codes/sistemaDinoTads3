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

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] !== 'administrador') {
    header('location: formLogin.php?erroLogin=naoAutorizado');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idDinossauro = intval($_POST['idDinossauro'] ?? 0);
    $nomeDinossauro = testar_entrada($_POST['nomeDinossauro'] ?? '');
    $especieDinossauro = testar_entrada($_POST['especieDinossauro'] ?? '');
    $dietaDinossauro = testar_entrada($_POST['dietaDinossauro'] ?? '');
    $generoDinossauro = testar_entrada($_POST['generoDinossauro'] ?? '');
    $fotoAtual = testar_entrada($_POST['fotoAtual'] ?? ''); 
    $erros = [];

    if ($idDinossauro <= 0) {
        $erros[] = "idInvalido";
    }
    if (empty($nomeDinossauro)) {
        $erros[] = "nomeVazio";
    }
    if (empty($especieDinossauro)) {
        $erros[] = "especieVazia";
    }

    $dietasPermitidas = ['Carnívoro', 'Herbívoro', 'Onívoro'];
    if (empty($dietaDinossauro) || !in_array($dietaDinossauro, $dietasPermitidas)) {
        $erros[] = "dietaInvalida";
    }

    $generosPermitidos = ['Macho', 'Fêmea'];
    if (empty($generoDinossauro) || !in_array($generoDinossauro, $generosPermitidos)) {
        $erros[] = "generoInvalido";
    }

    $novaFotoPath = $fotoAtual; 

   
    if (isset($_FILES["fotoDinossauro"]) && $_FILES["fotoDinossauro"]["error"] == 0) {
        $target_dir = "uploads/dinossauros/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["fotoDinossauro"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fotoDinossauro"]["tmp_name"]);
        if($check === false) {
            $erros[] = "erroUploadNaoEhImagem";
        }

        if (file_exists($target_file)) {
            $fileName = pathinfo($target_file, PATHINFO_FILENAME);
            $counter = 1;
            while(file_exists($target_dir . $fileName . "_" . $counter . "." . $imageFileType)) {
                $counter++;
            }
            $target_file = $target_dir . $fileName . "_" . $counter . "." . $imageFileType;
        }

        if ($_FILES["fotoDinossauro"]["size"] > 5000000) { 
            $erros[] = "erroUploadTamanhoExcedido";
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $erros[] = "erroUploadFormatoInvalido";
        }

        if (empty($erros)) { 
            if (move_uploaded_file($_FILES["fotoDinossauro"]["tmp_name"], $target_file)) {
                
                if (!empty($fotoAtual) && file_exists($fotoAtual) && $fotoAtual != "img/dino_placeholder.png") {
                    unlink($fotoAtual);
                }
                $novaFotoPath = $target_file; 
            } else {
                $erros[] = "erroUploadFalhaAoMover";
            }
        }
    }

    if (!empty($erros)) {
        header("location: formEditarDino.php?id=" . $idDinossauro . "&statusDino=erroValidacaoEdicao&campos=" . implode(',', $erros));
        exit();
    }
    
    if (!$conn) {
        header("location: formEditarDino.php?id=" . $idDinossauro . "&statusDino=erroConexaoBD");
        exit();
    }

    $queryAtualizar = "UPDATE dinossauros SET nomeDinossauro = ?, especieDinossauro = ?, dietaDinossauro = ?, generoDinossauro = ?, fotoDinossauro = ? WHERE idDinossauro = ?";

    if ($stmt = mysqli_prepare($conn, $queryAtualizar)) {
        
        mysqli_stmt_bind_param($stmt, "sssssi", $nomeDinossauro, $especieDinossauro, $dietaDinossauro, $generoDinossauro, $novaFotoPath, $idDinossauro);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: listaDino.php?statusDino=atualizadoSucesso");
                exit();
            } else {
               
                header("location: listaDino.php?statusDino=naoAtualizado");
                exit();
            }
        } else {
            error_log("Erro no MySQL (editarDino.php): " . mysqli_stmt_error($stmt));
            header("location: listaDino.php?statusDino=erroExecucaoBD");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Erro no MySQL (editarDino.php) - Preparação da query: " . mysqli_error($conn));
        header("location: listaDino.php?statusDino=erroQueryPreparacao");
        exit();
    }

    mysqli_close($conn);

} else {
    header("location: listaDino.php"); 
    exit();
}
?>