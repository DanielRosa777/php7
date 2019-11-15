<?php

    class Usuario{
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;

        public function loadById($id){
            $sql = new Sql();

            $res = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID" => $id
            ));

            if(count($res) > 0){
                $row = $res[0];

                $this->setIdusuario($row["idusuario"]);
                $this->setDeslogin($row["deslogin"]);
                $this->setDessenha($row["dessenha"]);
                $this->setDtcadastro(new DateTime($row["dtcadastro"]));
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
                $row = $res[0];

                $this->setIdusuario($row["idusuario"]);
                $this->setDeslogin($row["deslogin"]);
                $this->setDessenha($row["dessenha"]);
                $this->setDtcadastro(new DateTime($row["dtcadastro"]));
            }else{
                throw new Exception("Login e/ou senha errados");
            }
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