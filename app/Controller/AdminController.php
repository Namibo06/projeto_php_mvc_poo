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

        public function change($paramId){
            //paramId é o $id que foi recuperado,pelo array mandado pelo core
            //aqui é o método change

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template=$twig->load('updatePost.html');
            
            //echo $paramId;
            $resultEdit = Postagem::selecionaPorId($paramId);
           // var_dump($resultEdit);

            $parametros=array();
            $parametros['id']= $resultEdit->id;
            $parametros['titulo']=$resultEdit->titulo;
            $parametros['conteudo']=$resultEdit->conteudo;

            $conteudo=$template->render($parametros);
            echo $conteudo;
        }

        public function update(){
            //chamar a model postagem
         // var_dump($_POST);
            
            try {
                Postagem::update($_POST);
                echo '<script>alert("Publicação alterada com sucesso");</script>';
               
                echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=index"</script>';
                
            } catch (Exception $e) {
                echo '<script>alert("Sua falha no insert é: '.$e->getMessage().'");</script>';
               
               echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
            }

        }

        public function delete($paramId){
            //var_dump($_GET);
            
            try{
                Postagem::delete($paramId);
                echo '<script>alert("Publicação excluida com sucesso");</script>';
               
                echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=index"</script>';
            }catch (Exception $e) {
                echo '<script>alert("Sua falha no delete é: '.$e->getMessage().'");</script>';
               
               echo '<script>location.href="http://localhost/crud-mvc-poo-php/?pagina=admin&metodo=index"</script>';
            }
        }

    }
?>