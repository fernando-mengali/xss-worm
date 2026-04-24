<?php
// Verifica se foi enviado um arquivo de áudio
if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
    // Caminho onde o arquivo de áudio será salvo
    $uploadDir = 'uploads/';
    $uploadPath = $uploadDir . basename($_FILES['audio']['name']);

    // Move o arquivo de áudio para o diretório de uploads
    if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadPath)) {
        echo 'Arquivo de áudio salvo com sucesso em: ' . $uploadPath;
    } else {
        echo 'Erro ao salvar o arquivo de áudio';
    }
} else {
    echo 'Nenhum arquivo de áudio enviado';
}
?>
