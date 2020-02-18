<?php

require_once __DIR__ . "/GetterSetter.Class.php";

class Motorista extends GetterSetter
{
    public $conn;

    public function __construct($codigo = '')
    {
        $this->conn = new ConexaoMySQL();

        if ($codigo != "") {

            $sql = "SELECT MOT_CODIGO               as Codigo,
						   MOT_NOME                 as Nome,
						   MOT_TELEFONE             as Telefone,
						   MOT_CNH                  as Cnh,
						   MOT_TIPO_CNH             as TipoCnh,
						   MOT_CPF                  as Cpf,
						   MOT_DTNACIMENTO          as DtNaci
					FROM motoristas WHERE RECNO = :RECNO";
            $qry = $this->conn->prepare($sql);
            $qry->bindParam(':RECNO', $codigo);
            $qry->execute();

            if ($qry->rowCount() > 0) {
                $result = $qry->fetchAll(PDO::FETCH_ASSOC);
                $this->setData($result);
            }
        }
    }

    public function list()
    {

        $sSQL = "SELECT RECNO, MOT_NOME, MOT_CPF FROM motoristas ORDER BY RECNO ASC";
        $sQRY = $this->conn->prepare($sSQL);
        $sQRY->execute();

        return $sQRY->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resgataRecno($ferCodigo)
    {

        $sSQL = "SELECT RECNO FROM motoristas WHERE MOT_CODIGO = :MOT_CODIGO";
        $sQRY = $this->conn->prepare($sSQL);
        $sQRY->bindParam(':MOT_CODIGO', $ferCodigo);
        $sQRY->execute();

        $ln  = $sQRY->fetch(PDO::FETCH_ASSOC);

        return $ln["RECNO"];
    }
}
