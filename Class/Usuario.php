<?php

class Usuario {

    private $idUsuario;
    private $desLogin;
    private $desSenha;
    private $dtCadastro;

    public function loadByID($id) {
        $slq = new Slq();

        $results = $slq->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

        // Confirmo se existe retorno
        if (count($results > 0)) {

            // Como o PDO retorna um array de array, então pegamos o indece 0
            $row = $results[0];

            $this->setIdUsuario($row['idusuario']);
            $this->setDesLogin($row['deslogin']);
            $this->setDesSenha($row['dessenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
    }

    public function __toString() {
        return json_encode(array(
            "idusuario" => $this->getIdUsuario(),
            "deslogin" => $this->getDesLogin(),
            "dessenha" => $this->getDesSenha(),
            "dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getDesLogin() {
        return $this->desLogin;
    }

    public function getDesSenha() {
        return $this->desSenha;
    }

    public function getDtCadastro() {
        return $this->dtCadastro;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setDesLogin($desLogin) {
        $this->desLogin = $desLogin;
    }

    public function setDesSenha($desSenha) {
        $this->desSenha = $desSenha;
    }

    public function setDtCadastro($dtCadastro) {
        $this->dtCadastro = $dtCadastro;
    }

}
