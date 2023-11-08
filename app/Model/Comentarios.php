<?php 
    class Comentarios{
        public static function selecionarComentarios($idPost){
            $pdo= Conexao::getConn();
            $query = "SELECT * FROM crud.comentario WHERE id_postagem = ?";
            $sql=$pdo->prepare($query);
            $sql->execute(array($idPost));
            $resultado=array();
            while($row=$sql->fetchObject('Comentarios')){
                $resultado[]=$row;
            }
            return $resultado;
        }       
    }
?>