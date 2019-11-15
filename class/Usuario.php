<?php

    class Usuario{
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;

        public function __construct($login = "", $password = ""){
            $this->setDeslogin($login);
            $this->setDessenha($password);
        }

        public function loadById($id){
            $sql = new Sql();

            $res = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID" => $id
            ));

            if(count($res) > 0){
                $this->setData($res[0]);
            }
        }

        public function getList(){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios");
        }

        public static function search($login){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
                ":SEARCH" => "%" . $login . "%"
            ));
        }

        public function login($login, $password){
            $sql = new Sql();

            $res = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN and 
                                dessenha = :PASSWORD", array(
                ":LOGIN" => $login,
                ":PASSWORD" => $password
            ));

            if(count($res) > 0){
                $this->setData($res[0]);
            }else{
                throw new Exception("Login e/ou senha errados");
            }
        }

        public function insert(){
            $sql = new Sql();

            $res = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ":LOGIN" => $this->getDeslogin(),
                ":PASSWORD" => $this->getDessenha()
            ));

            if(count($res) > 0){
                $this->setData($res[0]);
            }
        }

        public function update($login, $password){
            $this->setDeslogin($login);
            $this->setDessenha($password);

            $sql = new Sql();

            $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD,
                        WHERE idusuario = :ID", array(
                            ":LOGIN" => $this->getDeslogin(),
                            ":PASSWORD" => $this->getDessenha(),
                            ":ID" => $this->getIdusuario()
            ));
        }

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID" => $this->getIdusuario()
            ));

            $this->setIdusuario(0);
            $this->setDeslogin("");
            $this->setDessenha("");
            $this->setDtcadastro(new DateTime());
        }

        public function setData($data){
            $this->setIdusuario($data["idusuario"]);
            $this->setDeslogin($data["deslogin"]);
            $this->setDessenha($data["dessenha"]);
            $this->setDtcadastro(new DateTime($data["dtcadastro"]));
        }

        public function __toString(){
            return json_encode(array(
                "idusuario" => $this->getIdusuario(),
                "deslogin" => $this->getDeslogin(),
                "dessenha" => $this->getDessenha(),
                "dtcadastro" => $this->getDtcadastro()
            ));
        }

        public function getIdusuario()
        {
            return $this->idusuario;
        }

        public function setIdusuario($idusuario)
        {
            $this->idusuario = $idusuario;
        }

        public function getDeslogin()
        {
            return $this->deslogin;
        }

        public function setDeslogin($deslogin)
        {
            $this->deslogin = $deslogin;
        }

        public function getDessenha()
        {
            return $this->dessenha;
        }

        public function setDessenha($dessenha)
        {
            $this->dessenha = $dessenha;
        }

        public function getDtcadastro()
        {
            return $this->dtcadastro;
        }

        public function setDtcadastro($dtcadastro)
        {
            $this->dtcadastro = $dtcadastro;
        }

    }

?>