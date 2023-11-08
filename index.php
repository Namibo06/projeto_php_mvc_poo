<?php 
    require_once 'app/Core/Core.php';

    require_once 'app/lib/Database/Conexao.php';
    require_once 'app/Controller/ErroController.php';
    require_once 'app/Controller/HomeController.php';
    require_once 'app/Controller/PostController.php';
    require_once 'app/Controller/SobreController.php';
    require_once 'app/Model/Comentarios.php';
    require_once 'app/Model/Postagem.php';

    require_once 'vendor/autoload.php';

    $template = file_get_contents('app/Template/estrutura.html');

    //tudo que  estiver no ob_start,ele vai armazenar e jogar na variavel saida
    ob_start();
    $core = new Core;
    $core->start($_GET);

    $saida=ob_get_contents();
    ob_end_clean();

    //colocando o conteudo da pasta no lugar
    $tplPronto=str_replace('{{area_dinamica}}',$saida,$template);
    echo $tplPronto;
?>