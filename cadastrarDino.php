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

    
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] !== 'administrador') { 
        header('location: formLogin.php?erroLogin=naoAutorizado'); 
        exit();
    }

    $urlRedirecionamentoErro = "formDino.php?cadastroDino="; 

    
    $nomeDinossauro = $especieDinossauro = $dietaDinossauro = $generoDinossauro = $fotoDinossauroPath = "";

    
    if (empty($_POST["nomeDinossauro"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=nomeVazio");
        exit();
    } else {
        $nomeDinossauro = testar_entrada($_POST["nomeDinossauro"]); 
    }

    if (empty($_POST["especieDinossauro"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=especieVazia"); 
        exit();
    } else {
        $especieDinossauro = testar_entrada($_POST["especieDinossauro"]); 
    }

    if (empty($_POST["dietaDinossauro"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=dietaVazia"); 
        exit();
    } else {
        $dietaDinossauro = testar_entrada($_POST["dietaDinossauro"]); 
        $dietasPermitidas = ['Carnívoro', 'Herbívoro', 'Onívoro']; 
        if (!in_array($dietaDinossauro, $dietasPermitidas)) { 
            header($urlRedirecionamentoErro . "erroValidacao&campo=dietaInvalida"); 
            exit();
        }
    }

    if (empty($_POST["generoDinossauro"])) {
        header($urlRedirecionamentoErro . "erroValidacao&campo=generoVazio"); 
        exit();
    } else {
        $generoDinossauro = testar_entrada($_POST["generoDinossauro"]); 
        $generosPermitidos = ['Macho', 'Fêmea'];
        if (!in_array($generoDinossauro, $generosPermitidos)) { 
            header($urlRedirecionamentoErro . "erroValidacao&campo=generoInvalido"); 
            exit();
        }
    }

    if (isset($_FILES["fotoDinossauro"]) && $_FILES["fotoDinossauro"]["error"] == 0) { 
        $target_dir = "uploads/dinossauros/"; 

        if (!is_dir($target_dir)) { 
            mkdir($target_dir, 0777, true); 
        }

        $target_file = $target_dir . basename($_FILES["fotoDinossauro"]["name"]); 
        $uploadOk = 1; 
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 

        $check = getimagesize($_FILES["fotoDinossauro"]["tmp_name"]); 
        if($check !== false) { 
            $uploadOk = 1; 
        } else {
            header($urlRedirecionamentoErro . "erroUpload&motivo=naoEhImagem"); 
            exit();
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
            header($urlRedirecionamentoErro . "erroUpload&motivo=tamanhoExcedido"); 
            exit();
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) { 
            header($urlRedirecionamentoErro . "erroUpload&motivo=formatoInvalido");
            exit();
        }

        if (move_uploaded_file($_FILES["fotoDinossauro"]["tmp_name"], $target_file)) { 
            $fotoDinossauroPath = $target_file;
        } else {
            header($urlRedirecionamentoErro . "erroUpload&motivo=falhaAoMover"); 
        }
    } else {
        header($urlRedirecionamentoErro . "erroUpload&motivo=arquivoNaoEnviado"); 
        exit();
    }

    
    if (!$conn) { 
        header($urlRedirecionamentoErro . "erroConexaoBD"); 
        exit();
    }

   
    $inserirDino = "INSERT INTO dinossauros (nomeDinossauro, especieDinossauro, dietaDinossauro, generoDinossauro, fotoDinossauro)
                    VALUES (?, ?, ?, ?, ?)"; 

    if ($stmt = mysqli_prepare($conn, $inserirDino)) { 
        mysqli_stmt_bind_param($stmt, "sssss", $nomeDinossauro, $especieDinossauro, $dietaDinossauro, $generoDinossauro, $fotoDinossauroPath); 

        if (mysqli_stmt_execute($stmt)) { 
            
            header("location: formDino.php?cadastroDino=sucesso"); 
            exit();
        } else {
            error_log("Erro no MySQL: " . mysqli_stmt_error($stmt)); 
            header($urlRedirecionamentoErro . "erroInsercaoBD"); 
            mysqli_stmt_close($stmt); 
            mysqli_close($conn); 
            exit();
        }
        mysqli_stmt_close($stmt); 
    } else {
        // Erro na preparação da inserção
        error_log("Erro na preparação da query: " . mysqli_error($conn)); 
        header($urlRedirecionamentoErro . "erroQueryInsercao"); 
        mysqli_close($conn); 
        exit();
    }
    mysqli_close($conn); 
    
} else {
   
    header("location: formDino.php"); 
    exit();
}
?>