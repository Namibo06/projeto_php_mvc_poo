<?php 
    class PostController{
        public function index($params){
            
            try {
             $postagem=Postagem::selecionaPorId($params);
            //twig
             $loader = new \Twig\Loader\FilesystemLoader('app/View');
             $twig = new \Twig\Environment($loader);
             $template=$twig->load('single.html');
             
            //params
             $parametros=array();
             $parametros['id']= $postagem->id;
             $parametros['titulo'] = $postagem->titulo;
             $parametros['conteudo'] = $postagem->conteudo;
             $parametros['comentarios']= $postagem->comentarios;

            //renderizando params
             $conteudo=$template->render($parametros);
             echo $conteudo;
 
            } catch (Exception $e) {
             echo $e->getMessage();
            }
        }

        public function addComent(){

            try{
                Comentarios::inserir($_POST);
               $id= $_POST['id'];

                header("Location: http://localhost/crud-mvc-poo-php/?pagina=post&metodo=index&id=$id");
            }catch (Exception $e) {
                echo '<script>alert("Sua falha na inserção de comentário é: '.$e->getMessage().'");</script>';

                echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=post&metodo=index&id='.$_POST['id'].'"</script>';
            }
        }
    }
?>