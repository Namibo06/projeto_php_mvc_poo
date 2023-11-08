<?php 
    class AdminController{
        public function index(){
            //twig
             $loader = new \Twig\Loader\FilesystemLoader('app/View');
             $twig = new \Twig\Environment($loader);
             $template=$twig->load('admin.html');
             
            $objPostagens=Postagem::selecionaTodos();

            //params
             $parametros=array();
             $parametros['postagens']= $objPostagens;

            //renderizando params
             $conteudo=$template->render($parametros);
             echo $conteudo;
 
            }

        public function create(){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template=$twig->load('create.html');
            
            $parametros=array();

            $conteudo=$template->render($parametros);
            echo $conteudo;
        }

        public function insert(){
            //aqui é direcionado assim que o usuario,clica em cadastrar,é direcionado para cá
            try{
                //capturar se houve algum erro
                Postagem::insert($_POST);

                echo '<script>alert("Publicação inserida com sucesso");</script>';
               
                echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=index"</script>';
                
            }catch(Exception $e){
               echo '<script>alert("Sua falha no insert é: '.$e->getMessage().'");</script>';
               
               echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=create"</script>';
            }
        }

    }
?>