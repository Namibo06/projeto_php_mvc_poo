<?php 
    declare(strict_types= 1);
    require_once "app/Controller/HomeController.php";

    class Core{
        public function start($urlGet){
            if (isset($urlGet['metodo'])) {
                $acao =  $urlGet['metodo'];
            }else{
                $acao = 'index';
            }
            
            if(isset($urlGet['pagina'])){
            //toda requisição na url para página,vai começar com '?pagina='
            //ucfirst() é para deixar aa primeira letra mairo para ser identificada na HomeController e tem uma concatenação no final
            $controller = ucfirst($urlGet['pagina']).'Controller';
            }else{
                //se digitar uma página que não existe entrar no else
                $controller = 'HomeController';
            }      

            //identificar pagina que esta acessando,por qual controller esta acessando
            //Se existir a classe que é nome do controller,aponta a pagina,senãao aponta ao controller de erro
            if(!class_exists($controller)){
                $controller = 'ErroController';
            }
            
            //primeiro parametro o nome new e depois o nome da variavel,depois a acao,e por ultimo a $urlGet que por padrão já é um array,para pegar a url com o id caso queira utilizar depois
            
            if (isset($urlGet['id']) && $urlGet['id'] != null) {
                $id = $urlGet['id'];
            }else{
                $id = null;
            }

            call_user_func_array(array(new $controller,$acao),array($id));
            
        }
    }
?>