<?php
    class BDConf{
        protected $user;
        protected $pswd;
        protected $host;
        protected $dbnm;
        
        function DBconfig(){
            $this -> user = 'root';
            $this -> pswd = 'P@lomo53';
            $this -> host = 'localhost';
            $this -> dbnm = 'itqnet';
        }
    }