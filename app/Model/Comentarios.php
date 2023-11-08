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

        public static function inserir($dados){
        
        $pdo = Conexao::getConn();
        $query="INSERT INTO crud.comentario (nome,mensagem,id_postagem) VALUES (:nom,:msg,:idp)";
        $sql=$pdo->prepare($query);
        $sql->bindValue(":nom",$dados['nome']);
        $sql->bindValue(":msg",$dados['msg']);
        $sql->bindValue(":idp",$dados['id']);
        $sql->execute();
  
        if($sql->rowCount()){
            return true;    
            
        }
            throw new Exception('Falha ao inserir publicação');
           
        }
    }
?>