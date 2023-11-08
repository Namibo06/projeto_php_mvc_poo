<?php 
    class HomeController{
        public function index(){
           try {
            $colecPostagens=Postagem::selecionaTodos();

            //twig vai passar os dados para a view
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template=$twig->load('home.html');

            $parametros=array();
            //se na view eu colocar {{nome}} iria aparecer lá Joca
            //$parametros['nome'] = 'Joca';
            $parametros['postagens'] = $colecPostagens;
            //var_dump($colecPostagens);
            $conteudo=$template->render($parametros);
            //aqui carrega a view na tela
            echo $conteudo;

           } catch (Exception $e) {
            echo $e->getMessage();
           }
        }
    }
?>