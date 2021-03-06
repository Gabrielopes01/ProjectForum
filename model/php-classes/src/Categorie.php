<?php

namespace Classes;
require_once("function.php");

Use \Classes\Sql;

class Categorie {

    public function getCategorieById($id){

        $sql = new Sql;

        $resultado = $sql->select("SELECT * FROM Categoria WHERE id = :id", [
            ":id"=>$id
        ]);

        return $resultado[0];

    }


    public static function getCategorie($num){

        $sql = new Sql();

        $forResult = $num * 10;

        $resultado = $sql->select("SELECT TOP 10 * FROM Categoria WHERE id NOT IN (Select TOP $forResult id From Categoria)");

        return $resultado;

    }

    public static function getALLCategorie(){

        $sql = new Sql();

        $resultado = $sql->select("SELECT * FROM Categoria");

        return $resultado;

    }

    public static function verifyCategorie($category){

        $sql = new Sql();

        $resultado = $sql->select("SELECT * FROM Usuario WHERE nome = :nome", array(
            ":nome"=>$category
        ));

        if(count($resultado) > 0){
            return true;
        }else{
            return false;
        }

    }


    public static function addCategorie($parametros){

        $sql = new Sql();

        //Verificando se o campo Nome foi preenchido
        if($parametros["nome"] === ""){
            $_SESSION['mensagem'] = "Campo Nome Obrigatório";
            header('Location: /adminCat');
            exit;
        }

        //Verificando se a Categoria ja esta cadastrado
        if(Categorie::verifyCategorie($parametros["nome"])){
            $_SESSION['mensagem'] = "Categoria ja Cadastrada";
            header('Location: /adminCat');
            exit;
        }


        $sql->query("INSERT INTO Categoria VALUES (:nome)", array(
            ":nome"=>$parametros["nome"],
        ));


        $_SESSION['mensagem'] = "Categoria Cadastrada com Sucesso";
        header("Location: /adminCat/search/0");
        exit;

    }

    public static function editCategorie($parametros, $id){

        $sql = new Sql();

        //Verificando se o campo Nome foi preenchido
        if($parametros["nome"] === ""){
            $_SESSION['mensagem'] = "Campo Nome Obrigatório";
            header("Location: /adminCat/edit/$id");
            exit;
        }

        //Verificando se a Categoria ja esta cadastrado
        if(Categorie::verifyCategorie($parametros["nome"])){
            $_SESSION['mensagem'] = "Categoria ja Cadastrada";
            header("Location: /adminCat/edit/$id");
            exit;
        }


        $sql->query("UPDATE Categoria SET nome = :nome WHERE id = :id", array(
            ":nome"=>$parametros["nome"],
            ":id"=>$parametros["id"]
        ));

        $_SESSION['mensagem'] = "Categoria Alterado com Sucessoo";
        header("Location: /adminCat/search/0");
        exit;
    }

    public static function deleteCategorie($id){
            $sql = new Sql();

        $sql->query("DELETE FROM Categoria WHERE id = :id", array(
            ":id"=>$id
        ));

        $_SESSION['mensagem'] = "Categoria Deletada com Sucesso";
        header("Location: /adminCat/search/0");
        exit;
    }

    //Esta função ira filtrar as categorias e exibir a pesquisa
    public static function filter($parametros){

        $sql = new Sql();

        $filtros = ["nome"=>$parametros['nome']];
        //Clausula de SQL padrão
        $select = "SELECT * FROM Categoria WHERE 1 = 1";

        //Verificando se os campos estão definidos e dando valores a eles
        $name = isset($parametros['nome']) && !$parametros['nome'] == ""? $parametros['nome']:"";

        //Verificando se os 3 campos estão preenchidos com parametros de busca
        if($parametros['verBuscaNome'] == 1 && $name != ""){

            $select .= " AND nome LIKE CONCAT('%', '" . $name . "', '%')";

        }

        $resultadoF = $sql->select($select);

        return [$resultadoF, $filtros];
    }


}

?>