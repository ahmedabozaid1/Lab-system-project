<?php
require_once"c:/xampp/htdocs/test/model/appointmentmodel.php";

// show all reports id name day created
// create new report sends info to build the sql
// show one report show name and test --> test options --> values 
class customreport
{
    public $id;
    public $name;
    public $time;
    public $sqlconcat;
    public $test=[];

    public $names=[];
    public $count=[];

    /// to get tests of filter patients and filter date appoitment

    // SELECT * from test_appointment where is_deleted =0 and appointment_id = any (SELECT appointment_id FROM appointment where is_deleted = 0 and  date < '2021-03-01' and patient_id = ANY (SELECT patient_id  FROM `patient` WHERE  is_deleted =0 and dob > '2000-10-01' and gender = 1))


    // then create test objects and present them

    // what if we need to add filters in the test??

    function __construct($id)
    {
        if($id!=""&&$id!=null)
        {
            $conn = db::getInstance();
            $query = "SELECT * from customized_report where id   = '$id'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
               
                $this->id = $row["id"];
                $this->name = $row["reportName"];
                $this->time = $row["time_created"];
                $this->sqlconcat = $row["SQL_Statement"];


                $query2= $this->sqlconcat;
                $result2 = $conn->query($query2);   
                $apps=[];
                $i=0;
                while($row2 = mysqli_fetch_array($result2))
                {
                    $apps[$i]=new appointment($row2["appointment_id"]);

                    $i++;
                }
                if($apps!=null)
                {
                    for($i=0;$i<count($apps);$i++)
                    {
                        if($apps[$i]->tests!=null)
                        {
                            for($j=0;$j<count($apps[$i]->tests);$j++)
                            {
                                array_push($this->test, $apps[$i]->tests[$j]);
                            
                            }
                        }
                    }
                }

                if($this->test!=null)
                {
                    for($i=0;$i<count($this->test);$i++)
                    {
                        if($this->names!=null)
                        {
                            if (in_array($this->test[$i]->name, $this->names)) 
                            {
                                $key = array_search($this->test[$i]->name,  $this->names);
                                $this->count[$key]+=1;
                            }
                            else
                            {
                                array_push($this->names, $this->test[$i]->name);
                                array_push($this->count,1);
                            }
                        }
                        else
                        {
                            array_push($this->names, $this->test[$i]->name);
                            array_push($this->count,1);
                        }
                    }

                }
                      
            } 
           

        }
        // takes the id get name aand sql and time from costom table
        // excute sql to get array of tests objects  by making obj appoiyment and then searching for the tests n that apooitments and copy it to array

    }

    function create_new($name,$appdatetype,$appdate,$dobtype,$dob,$gender)
    {
        $concat="SELECT * from test_appointment where is_deleted =0 and appointment_id = any (SELECT appointment_id FROM appointment where is_deleted = 0";
        if($appdatetype!="none" && $appdate!=null)
        {
            $concat.=" and date ";
            if($appdatetype=="min" )
            {
                $concat.=" > ";
            }
            if($appdatetype=="max")
            {
                $concat.=" < ";
            }
            if($appdatetype=="equal" )
            {
                $concat.=" = ";
            }
            $concat.=" '";
            $concat.=$appdate;
            $concat.="' ";
        }
        if(($dobtype!="none" && $dob) || $gender!=null)
        {
            $concat.=" and patient_id = ANY (SELECT patient_id  FROM `patient` WHERE  is_deleted =0  ";

            if($dobtype!="none" && $dob!=null)
            {
                $concat.=" and date ";
                if($dobtype=="min" )
                {
                    $concat.=" > ";
                }
                if($dobtype=="max")
                {
                    $concat.=" < ";
                }
                if($dobtype=="equal" )
                {
                    $concat.=" = ";
                }
                $concat.=" '";
                $concat.=$dob;
                $concat.="' ";
            }
            if($gender!=null)
            {
                $concat.=" and gender =";
                $concat.=" '";
                $concat.=$gender;
                $concat.="' ";
            }
            $concat.=" ) "; // patientid
        }
        $concat.=" ) "; //select appid
       
       
 
     
        $conn = db::getInstance();
        $query= "INSERT INTO `customized_report` ( `reportName`, `SQL_Statement`) VALUES ( '$name', \"$concat\")";

        $result = $conn->query($query);
    }
    function selectall()
    {
        $i=0;
        $conn = db::getInstance();
        $query = "SELECT * from customized_report "; // order by id
        $result = $conn->query($query);
        $return=[];
        while($row = mysqli_fetch_array($result))
        {
            $return[$i]=new customreport($row["id"]);
            

            $i++;
        }

         return $return;
    }
}