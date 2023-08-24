<?php 

include 'Config.php';

class Model extends Config{
    public function registerWorkers($formData){
        $fullName = $formData['full_name'];
        $email = $formData['email'];
        $password = $formData['password'];
        // $password = md5($formData['password']);
        $mobile = $formData['mobile'];
        $sql = "INSERT INTO ".WORKERS_TABLE." (full_name,email,password,mobile) VALUES('$fullName','$email','$password','$mobile')";
        $result = $this->conn()->query($sql);
        return $result;
    }
    
    public function login($formData){
        $email = $formData['email'];
        $password = $formData['password'];
        // $password = md5($formData['password']);
        $sql = "SELECT worker_id,is_admin FROM ".WORKERS_TABLE." where email = '$email' AND password='$password'"; //echo $sql; die;
        $result = $this->conn()->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = (isset($row['worker_id']) && $row['worker_id'] >0) ? $row['worker_id'] : 0;
        $isAdmin = (isset($row['is_admin']) && $row['is_admin'] >0) ? $row['is_admin'] : 0;
        if(mysqli_num_rows($result) > 0){
            return array('workerID'=>$id,'isAdmin'=>$isAdmin);
        }else{
            return 0;
        }
    }
    
    public function verifyEmailExists($email,$tableName){
        $sql = "SELECT email FROM $tableName where email = '$email'";
        $result = $this->conn()->query($sql);
        if(mysqli_num_rows($result) > 0){
            return array('email'=>'Email already exists');
        }else{
            return true;
        }
    }

    public function getWorkersDataById($workerId){
        $sql = "SELECT * FROM ".WORKERS_TABLE." WHERE worker_id = $workerId";
        $result = $this->conn()->query($sql);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

    public function updateWorkersData($workerId,$formData){
        $fullName = $formData['full_name'];
        $email = $formData['email'];
        $password = $formData['password'];
        // $password = md5($formData['password']);
        $mobile = $formData['mobile'];
        $udate = date('Y-m-d H:i:s'); 
        $sql = "update ".WORKERS_TABLE." set full_name='$fullName', email='$email', password='$password', mobile='$mobile',updated_at='$udate' where worker_id = '$workerId'";
        $result = $this->conn()->query($sql);
        return $result;
    }

    public function getAllUsersData(){
        $sql = "select * from ".WORKERS_TABLE." where is_admin='0' order by created_at desc limit 10 ";
        $res = $this->conn()->query($sql);
        $data=array();
        if (mysqli_num_rows($res)>0){
            while ($row = mysqli_fetch_assoc($res)){
                $data[]= $row;
            }
        }
        return $data;
    }

    public function deleteWorkerData($id){
        $sql = "DELETE FROM ".WORKERS_TABLE." WHERE worker_id = '$id'";
        $resp = $this->conn()->query($sql); 
        return $resp;
    }
}