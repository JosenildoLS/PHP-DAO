<?php

class Usuario {

    private $idUsuario;
    private $desLogin;
    private $desSenha;
    private $dtCadastro;

    public function __construct($deslogin = "", $dessenha = "") {

        $this->setDesLogin($deslogin);
        $this->setDesSenha($dessenha);
    }

    // Retorna apenas um registro
    public function loadByID($id) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

        // Confirmo se existe retorno
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    // Retorna o Registro caso o usuario seja autenticado
    public function login($login, $password) {
        $this->setDesLogin($login);
        $this->setDesSenha($password);

        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD ", array(
            ":LOGIN" => $this->getDesLogin(),
            ":PASSWORD" => $this->getDesSenha()
        ));

        // Confirmo se existe retorno
        if (count($results) > 0) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Usuário e/ou Senha Inválidos");
        }
    }

    public function insert() {

        $sql = new Sql();
        $row = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN ", array(":LOGIN" => $this->getDesLogin()));

        // Verifico se já existe um registro
        if (count($row) > 0) {
            throw new Exception("Este Login já existe");
        } else {
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ":LOGIN" => $this->getDesLogin(),
                ":PASSWORD" => $this->getDesSenha()
            ));

            if (count($results) > 0) {
                $this->setData($results[0]);
            } else {
                throw new Exception("Login não inserido");
            }
        }
    }

    public function update($login, $password) {
        $this->setDesLogin($login);
        $this->setDesSenha($password);

        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ":LOGIN" => $this->getDesLogin(),
            ":PASSWORD" => $this->getDesSenha(),
            ":ID" => $this->getIdUsuario()
        ));
    }

    public function delete() {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $this->getIdUsuario()
        ));

        $this->setIdUsuario(0);
        $this->setDesLogin("");
        $this->setDesSenha("");
        $this->setDtCadastro(new DateTime());
    }

    public function setData($data) {

        $this->setIdUsuario($data['idusuario']);
        $this->setDesLogin($data['deslogin']);
        $this->setDesSenha($data['dessenha']);
        $this->setDtCadastro(new DateTime($data['dtcadastro']));
    }

    // Retorna todos os registros
    public static function getList() {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    // Retorna apenas os registros encontrados que contenham o valor da pesquisa
    public static function getSearch($login) {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(":SEARCH" => "%" . $login . "%"));
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
