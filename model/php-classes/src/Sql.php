<?php

namespace Classes;
//CRMNOTE_18\SQLEXPRESS3
class Sql {

    const HOSTNAME = "CRMNOTE_18\SQLEXPRESS3";
    const USERNAME = "";
    const PASSWORD = "";
    const DBNAME = "Forum";

    private $conn;

    public function __construct()
    {

        $this->conn = new \PDO(
            "sqlsrv:Server=".Sql::HOSTNAME.";Database=".Sql::DBNAME.";",
            Sql::USERNAME,
            Sql::PASSWORD
        );


    }

    private function setParams($statement, $parameters = array())
    {

        foreach ($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);

        }

    }

    private function bindParam($statement, $key, $value)
    {

        $statement->bindParam($key, $value);

    }

    public function query($rawQuery, $params = array())
    {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();


    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}


?>