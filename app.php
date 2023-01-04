<?php
class App {

    private $conn;
    private $activeUzivatel;
    private $request;

    public function __construct($request) {

        $serverName = "******"; #"localhost\\sqlexpress"; 
        $connectionInfo = array( "Database"=>"nember", "UID"=>"****", "PWD"=>"****", 'CharacterSet' => 'UTF-8');
        
        $this->conn = sqlsrv_connect( $serverName, $connectionInfo);
        
        if (!$this->conn)
            die( print_r( sqlsrv_errors(), true));

        $this->activeUzivatel = (isset($request['uzivatel']))? $request['uzivatel'] : 1;
        $this->request = $request;
	
    }

    public function run() {
        if (isset($this->request['remove'])) {
            $this->removeFromOblibene($this->getActiveUzivatel(), $this->request['remove']);
        }
        if (isset($this->request['add'])) {
            $this->addToOblibene($this->getActiveUzivatel(), $this->request['add']);
        }
    }

    private function removeFromOblibene($uzivatelId, $procedureId) {
        $sql = "delete from PROCEDURY_UZIVATELE where uzivatel_id = ? and procedura_id = ?";
        $params = [$uzivatelId, $procedureId];

        $result = sqlsrv_query( $this->conn, $sql, $params);

        if (!$result) {
            echo 'Error in sql getOblibene.<br />'.print_r(sqlsrv_errors(), true);
            return NULL;
        }
        return true;
    }

    private function addToOblibene($uzivatelId, $procedureId) {
        $sql = "insert into PROCEDURY_UZIVATELE (uzivatel_id, procedura_id) values(?, ?)";
        $params = [$uzivatelId, $procedureId];

        $result = sqlsrv_query( $this->conn, $sql, $params);

        if (!$result) {
            echo 'Error in sql getOblibene.<br />'.print_r(sqlsrv_errors(), true);
            return NULL;
        }
        return true;
    }

    public function getActiveUzivatel() {
        return $this->activeUzivatel;
    }


    private function __getOblibene($idUzivatele) {

        $sql = "select * from PROCEDURY_UZIVATELE where uzivatel_id = ?";
        $params = [$idUzivatele];

        $result = sqlsrv_query( $this->conn, $sql, $params);

        if (!$result) {
            echo 'Error in sql getOblibene.<br />'.print_r(sqlsrv_errors(), true);
            return NULL;
        }

        return $result;
    }

    public function getOblibene($idUzivatele) {

        $result = $this->__getOblibene($idUzivatele);

        $ret = [];
        while( $obj = sqlsrv_fetch_object( $result)) {
         $ret[] = $this->getProcedure($obj->procedura_id);
        }

        return $ret;
    }

    public function getOblibeneIds($idUzivatele) {

        $result = $this->__getOblibene($idUzivatele);

        $ret = [];
        while( $obj = sqlsrv_fetch_object( $result)) {
         $ret[] = $obj->procedura_id;
        }

        return $ret;
    }

    public function getUzivatele() {
        $sql = "select * from UZIVATELE";
        $params = [];

        $result = sqlsrv_query( $this->conn, $sql);

        if (!$result)
            die('Error in sql getUzivatele.<br />'.print_r(sqlsrv_errors(), true));

        $ret = [];
        while( $obj = sqlsrv_fetch_object( $result)) {
         $ret[] = $obj;
        }

        return $ret;
    }

    protected function getProcedure($id) {
        $sql = "select * from PROCEDURY where id=?";
        $params = [$id];

        $result = sqlsrv_query( $this->conn, $sql, $params);

        if (!$result)
            die('Error in sql getProcedure.<br />'.print_r(sqlsrv_errors(), true));

        return sqlsrv_fetch_object($result);
    }

    public function getProcedures() {
        $ids = $this->getOblibeneIds($this->getActiveUzivatel());
        $sql = "select * from PROCEDURY where plati_od <= ? and plati_do >= ? and id not in (".substr(str_repeat(',?', count($ids)),1).")";
        $params = array_merge([date('Y-m-d'), date('Y-m-d')], $ids);
        $result = sqlsrv_query( $this->conn, $sql, $params);

        if (!$result)
            die('Error in sql.<br />'.print_r(sqlsrv_errors(), true));

        $ret = [];
        while( $obj = sqlsrv_fetch_object( $result)) {
            $ret[] = $obj;
        }
        return $ret;
    }
    
}



