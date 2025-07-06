<?php

include "conexaoBD.php"; //

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = testar_entrada($_POST["nome_completo"] ?? ''); 
    $email = testar_entrada($_POST["email"] ?? ''); 
    $senha = $_POST["senha"] ?? ''; 
    $confirma_senha = $_POST["confirma_senha"] ?? ''; 
    $erroPreenchimento = false;

    if (empty($nome_completo) || empty($email) || empty($senha) || empty($confirma_senha)) { 
        header("location: formCadastro.php?cadastro=erroValidacao"); 
        exit(); 
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        header("location: formCadastro.php?cadastro=emailInvalido"); 
        exit(); 
    }
    if ($senha !== $confirma_senha) { 
        header("location: formCadastro.php?cadastro=senhasDiferentes"); 
        exit(); 
    }

    $checkEmailQuery = "SELECT idUsuario FROM Usuarios WHERE emailUsuario = ?"; 
    if ($stmt = mysqli_prepare($conn, $checkEmailQuery)) { 
        mysqli_stmt_bind_param($stmt, "s", $email); 
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt); 
        if (mysqli_stmt_num_rows($stmt) > 0) { 
            header("location: formCadastro.php?cadastro=emailExistente"); 
            exit(); 
        }
        mysqli_stmt_close($stmt); 
    } else {
        header("location: formCadastro.php?cadastro=erroQueryEmail"); 
        exit(); 
    }
    $senha_hash = md5($senha); 
    $tipoUsuarioPadrao = 'cliente'; 
    $inserirUsuario = "INSERT INTO Usuarios (nomeUsuario, emailUsuario, senhaUsuario, tipoUsuario) VALUES (?, ?, ?, ?)"; 

    if ($stmt = mysqli_prepare($conn, $inserirUsuario)) { 
        mysqli_stmt_bind_param($stmt, "ssss", $nome_completo, $email, $senha_hash, $tipoUsuarioPadrao); 
        if (mysqli_stmt_execute($stmt)) { 
            header("location: formLogin.php?cadastro=sucesso"); 
            exit(); 
        } else {
        
            header("location: formCadastro.php?cadastro=erroInsercao"); 
            exit(); 
        }
        mysqli_stmt_close($stmt); 
    } else {
    
        header("location: formCadastro.php?cadastro=erroQueryInsercao"); 
        exit(); 
    }

    mysqli_close($conn); 

} else {

    header("location: formCadastro.php"); 
    exit(); 
}
?>