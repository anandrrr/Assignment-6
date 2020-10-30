<?php
class usertable {
    public $firstn;
    public $lastn;
    public $email;
    public $gender;
    public $mobile;

    private $conn;

    public function __construct($conn)
    {
        $this->conn=$conn;
        
    }
    public function addrow($obj){
        $sql="INSERT INTO users (firstn,lastn,email,gender,mobile) VALUES('$obj->firstn','$obj->lastn','$obj->email','$obj->gender','$obj->mobile');";
            $result=mysqli_query($this->conn,$sql);
            if($result==TRUE)
            {
                $msg=["Form successfully submitted"];
            }
            else
            {
                $msg=["Error occurred!!!"];
            }
            
            return json_encode($msg);
    }
    public function getdetails(){
        $sql="SELECT * FROM users;";
        $result=mysqli_query($this->conn, $sql);
        $arr=array();
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $arr[]=$row;
            }
        }
        return json_encode($arr);      
    }

    public function deldata($obj) {
        $sql = "DELETE FROM users WHERE id='$obj';";
        $result = mysqli_query($this->conn, $sql);

        if($result==TRUE)
        {
            $msg=["Delete Successfully!!!"];
        }
        else
        {
            $msg=["Error occurred!!!"];
        }
            
        return json_encode($msg);
    }

    public function updata($obj) {
        $sql = "UPDATE users
            SET firstn = '$obj->firstn', lastn = '$obj->lastn',email = '$obj->email',gender = '$obj->gender',mobile = '$obj->mobile'
            WHERE id = '$obj->id'; ";

        $result = mysqli_query($this->conn, $sql);

        if($result==TRUE)
        {
            $msg=["Update Successfully!!!"];
        }
        else
        {
            $msg=["Error occurred!!!"];
        }
            
        return json_encode($msg);
    }

    public function retsingle($obj) {
        $sql = "SELECT * FROM users WHERE id = '$obj';";
        $result=mysqli_query($this->conn, $sql);
        return json_encode(mysqli_fetch_assoc($result));
    }

    public function SearchQy($obj) {
        $sql = "SELECT * FROM users WHERE firstn = '$obj' OR lastn = '$obj' OR email = '$obj' OR mobile = '$obj';";
        $result=mysqli_query($this->conn, $sql);
        $arr=array();
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $arr[]=$row;
            }
        }
        return json_encode($arr);
    }
}
?>