<?php 
    class Postagem{
        //classe encarregada de buscar dados no banco de dados

        /*
        a model pega estes dados,e joga para controller HomeController,a HomeController vai chamar a View,que vai apresentar os dados na tela
        */

        public static function selecionaTodos(){
            $pdo = Conexao::getConn();
            $query="SELECT * FROM crud.postagem ORDER BY id DESC";
            $sql = $pdo->prepare($query);
            $sql->execute();

            $resultado = array();
            while($row = $sql->fetchObject('Postagem')){
                //retornando objetos
                $resultado[]=$row;
            }
            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }
            return $resultado;
        }

        public static function selecionaPorId($idPost){
            $pdo = Conexao::getConn();
            $query="SELECT * FROM crud.postagem WHERE id = ?";
            $sql = $pdo->prepare($query);
            $sql->execute(array($idPost));
            //pegando dados,e transformando em objeto,da classe Postagem
            $resultado = $sql->fetchObject('Postagem');

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }else{
                $resultado->comentarios=Comentarios::selecionarComentarios($resultado->id);
                //retornar um array vazio ou com resultados,para poder pegar na view
            }
            return $resultado;
        }

        //função estática do insert() utilizado no AdminController,ele pega daqui
        public static function insert($dadosPost){
            //verificando se os dados vinheram vazios
            if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
                throw new Exception('Preencha todos os campos');
                //return false;
            }
            
            $pdo = Conexao::getConn();
            $query="INSERT INTO crud.postagem (titulo,conteudo) VALUES (?,?)";
            $sql=$pdo->prepare($query);
            $res=$sql->execute(array($dadosPost['titulo'],$dadosPost['conteudo']));
            //não é ideal criar if dentro do controller,por isso,está sendo feito dedntro da função no model
            if($res == 0){
                //se for false,pois 0 é false e 1 é true
                throw new Exception('Falha ao inserir publicação');
            }
            return true;
        }

        public static function update($params){
            $pdo=Conexao::getConn();
            $query="UPDATE crud.postagem SET titulo = ?,conteudo = ? WHERE id = ?";
            $sql=$pdo->prepare($query);
            $sql->execute(array($params['titulo'],$resultado=$params['conteudo'],$params['id']));
            if($resultado == 0){
                throw new Exception('Falha ao inserir publicação');
            }
            return true;   
        }

        public static function delete($id){
            //var_dump($dadosDelete['id']);
            $pdo=Conexao::getConn();
            $query="DELETE FROM crud.postagem WHERE id = ?";
            $sql=$pdo->prepare($query);
            $resultado=$sql->execute(array($id));
            if ($resultado == 0) {
                throw new Exception('Falha ao tentar excluir publicação');
            }
            return true;
        }
    }
?>