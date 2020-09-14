<?php
include 'db.php';

class DbOperation extends Database{

    public function insert_record($table,$fields){
        //INSERT INTO `medicine`(`id`, `mediname`, `quantity`) VALUES ('f','5')
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",",array_keys($fields)).") VALUES";
        $sql .= "('".implode("','",array_values($fields))."')";
        $res = mysqli_query($this->con,$sql);
        if($res){
            return true;
        }  
    }

    public function fetch_data($table,$pk,$order="ASC"){
        //SELECT * FROM `medicine` ORDER BY `id` DESC 
        $sql = "SELECT * FROM ".$table." ORDER BY ".$pk."  ".$order;
        $data = array();
        $res = mysqli_query($this->con,$sql);
        if($res->num_rows >0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function single_record($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            return $row;
        }
    }

    public function update_record($table,$where,$fields){
        $sql = "";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions .= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        foreach($fields as $key => $value){
            //`id`=[value-1],`mediname`=
            $sql.= $key ."='". $value."', ";
        }
        $sql = substr($sql,0,-2);
        $sql = "UPDATE ".$table." SET ".$sql. " WHERE ".$conditions;
        if($this->con->query($sql)){
            return true;
        }
    }

    public function delete_record($table,$where){
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions .= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        //DELETE FROM `medicine` WHERE 0
        $sql = "DELETE FROM ".$table. " WHERE ".$conditions;
        if($this->con->query($sql)){
            return true;
        }
    }
}


//---------------------------------------------------------------
$ob = new DbOperation();
if(isset($_POST['store'])){
    $mediname = $_POST['mediname'];
    $quantity = $_POST['quantity'];
    $fields = array(
        "mediname" => "$mediname",
        "quantity" => "$quantity"
    );
    if($ob->insert_record("medicine",$fields)){
        header('location: ../index.php?inserted');
    }
}
//update
if(isset($_POST['update'])){
    $mediname = $_POST['mediname'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $fields = array(
        "mediname" => "$mediname",
        "quantity" => "$quantity"
    );
    $where = array("id"=>$id);
    if($ob->update_record("medicine",$where,$fields)){
        header('location: ../index.php?updated');
    }
}

//delete
if(isset($_GET['delete'])){
    $id =  base64_decode($_GET['id']);
    $where = array("id"=>$id);
    if($ob->delete_record("medicine",$where)){
        header('location: ../index.php?deleted');
    }
}
?>