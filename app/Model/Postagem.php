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
            }
            return $resultado;
        }
    }
?>