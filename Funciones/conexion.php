<?php
    
    class Conexion{
        private function con(){
            try{
                $user = 'root';
                $pswd = 'P@lomo53';
                $host = 'localhost';
                $dbnm = 'itqnet';

                if(@!$this->mysqli = mysqli_connect($host, $user, $pswd, $dbnm)){
                    throw new Exception($this->mysqli->error);
                }
                mysqli_set_charset($this->mysqli, "utf8");
            }catch(Exception $e){
                throw $e;
            }
        }

        public function execute($query){
            try{
                @$this->con();

                $resultado = $this->mysqli->query($query);
                if(!$resultado){
                    throw new Exception($this->mysqli->error);
                }
                
                return $resultado;
                $this->mysqli->close();
            }catch(Exception $e){
                throw $e;
            }
        }
        
    }