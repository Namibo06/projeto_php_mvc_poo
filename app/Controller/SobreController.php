<?php 
    class SobreController{
        public function index(){
            //twig
             $loader = new \Twig\Loader\FilesystemLoader('app/View');
             $twig = new \Twig\Environment($loader);
             $template=$twig->load('sobre.html');
             
            //params
             $parametros=array();

            //renderizando params
             $conteudo=$template->render($parametros);
             echo $conteudo;
 
            }
        }
?>