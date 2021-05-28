<?php 

///include_once "../db.php";
include_once "humanmodel.php";

class patient extends humanmodel{
        //public $address ;  // address is this recurtion  ///
        //public $gender ; // user 
        //public $dob; // dof in user
        //public $phone_number; // user >
        //name
        //id
        public $fertility;
    public function __construct($ID)
    {
        if($ID!="")
        {
            $conn = db::getInstance();
            $sql = "select * from patient where patient_id='$ID'";
            $Set = $conn->query($sql);
            while($row = mysqli_fetch_array($Set)){
                $this->id = $row['patient_id'];
                $this->name = $row['name'];
                $this->dob = $row['dob'];
                $this->set_gender($row['gender']);
                $this->phone_number = $row['phone_number'];
                $this->set_fertility($row['fertility']);
                $this->email=$row['email'];
            }
        }
       //////// $db->closeConnction();
    }
    public static function show_all()
    {
        $conn = db::getInstance();
        $sql = "select * from patient WHERE is_deleted='0'";
        $TestSet = $conn->query($sql);
        $array=[];

        $i=0;
        while($row = mysqli_fetch_array($TestSet)){
            $array[$i]= new patient($row[0]);
            $i++; 
        }
        return $array;
    }
    public function create_patient($name,$dob,$gender,$phone_number,$fertility,$email)
    {
        $conn = db::getInstance();
        $sql = "insert into patient(name,dob,gender,phone_number,fertility,email) value('$name','$dob','$gender','$phone_number','$fertility','$email')";
        $conn->query($sql);
        ////$db->closeConnction();
    }
    public function delete_patient($ID)
    {
        $conn = db::getInstance();
        //UPDATE queue SET is_deleted = '1'
        $sql = "UPDATE patient SET is_deleted = '1' WHERE patient_id='$ID'";
        $presql = "select * from appointment where patient_id='$ID'";
        $TestSet = $conn->query($presql);
        $i=0;
        while($row = mysqli_fetch_array($TestSet)){
            $appointment_id = $row['appointment_id'];
            $presql2 = "UPDATE test_appointment SET is_deleted = '1' WHERE appointment_id='$appointment_id'";
            $conn->query($presql2);
            $i++;
        }
        $presql3 = "UPDATE appointment  SET is_deleted = '1' where patient_id='$ID'";
        $conn->query($presql3);
        $conn->query($sql);
        //echo $sqlC."<br>";
        //$conn->query($sqlP);
        //if (!$conn-> query($sql)) {
        //   echo("Error description: " . $conn -> error);
        //}
      ////  $db->closeConnction();
    }
    public function update_patient($name,$dob,$gender,$phone_number,$fertility,$ID)
    {
        $conn = db::getInstance();
        $sql = "UPDATE patient SET name='$name',dob='$dob',gender = '$gender',phone_number = '$phone_number',fertility='$fertility' WHERE patient_id='$ID' AND is_deleted='0'";
        /*
        $presql = "select * from appointment where patient_id='$ID'";
        $TestSet = $conn->query($presql);
        $i=0;
        while($row = mysqli_fetch_array($TestSet)){
            $appointment_id = $row['appointment_id'];
            $presql2 = "DELETE FROM test_appointment WHERE appointment_id='$appointment_id'";
            $conn->query($presql2);
            $i++;
        }
        $presql3 = "delete from appointment where patient_id='$ID' ";
        $conn->query($presql3);
        */
        $conn->query($sql);
        //echo $sql."<br><br><br><br>";
        if (!$conn-> query($sql)) {
           echo("Error description: " . $conn -> error);
        }
       /// $db->closeConnction();
    }
    private function set_gender($boolen)
    {
        if($boolen == "0"){
            $this->gender = "male";
        }elseif ($boolen == "1") {
            $this->gender= "female";
        }
    }
    private function set_fertility($boolen)
    {
        if($boolen == "0"){
            $this->fertility ="FALSE";
        }elseif ($boolen == "1") {
            $this->fertility="TRUE";
        }
    }
    public function get_name()
    {
        return $this->name;
    }
}