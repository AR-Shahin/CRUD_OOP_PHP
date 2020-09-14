<?php

class Database
{
    public $con;
    public function __construct(){
        $this->con = mysqli_connect("localhost:3307",'root','','adcrud');
        if($this->con){
            return $this->con;
        }
    }
    public function test(){
        echo 'test';
    }
}
