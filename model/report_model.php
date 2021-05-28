<?php
require_once"c:/xampp/htdocs/test/model/appointmentmodel.php";
require_once "c:/xampp/htdocs/test/id.php";

//// there is a page with show all reports // has 2 buttons
///  you can create new report (daily monthly)
///  to create new report daily --> enter day
//   to create new roport monthly --> enter month



// in table report_test the testid cant be deplicated

class report
{
    public $total_income;
    public $date;
   
    public  $type;
    private $tests=[];
    private $tests_id=[];
    public $test=[];
    public $test_count=[];
   

    function __construct($id) // get data from database
    {
        
        if($id!=""&&$id!=null)
        {
            $conn = db::getInstance();
            $query = "SELECT * from report where report_id   = '$id'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
               
                $this->id = $row["report_id"];
                $this->type = $row["type"];
                $this->date = $row["date"];
                $this->total_income = $row["total_income"];
                          
            } 
            $query2 = "SELECT * FROM report_test where  report_id   = '$id'";
            $result2 = $conn->query($query2);
            $i=0;
            while($row2 = mysqli_fetch_array($result2))
            {
                $this->test[$i]=new test($row2["test_id"]);
                $this->test_count[$i]=$row2["test_count"];
                $i++;
            }
        }
    }
    function selectall()
    {
        $i=0;
        $conn = db::getInstance();
        $query = "SELECT * from report "; // order by id
        $result = $conn->query($query);
        $return=[];
        while($row = mysqli_fetch_array($result))
        {
            $return[$i]=new report($row["report_id"]);
            

            $i++;
        }

         return $return;
    }
    function get_day_report($date)
    {
        //date = (2020-12-*)
        $lid=null;
        $arr=[];
        $last_id=null; 
        $conn = db::getInstance();
        $query = "SELECT * from appointment where date='$date' and payed_amount=final_cost and is_deleted='0'";
        if($result = $conn->query($query))
        {
            $sql = "INSERT into report(type,date) value('1','$date')"; 
            $conn->query($sql);
            $last_id = $conn->insert_id;
            $totalincome=0;
            $j=0;
            while($row = mysqli_fetch_array($result))
            {
                $app=new appointment($row["appointment_id"]);
                $totalincome += $app->final_cost;
                ///echo "$totalincome <br>";
                $i=0;
                
                while($i<count($app->tests))
                {
                    $test_id=$app->tests[$i]->id;
                    if(array_key_exists($app->tests[$i]->name,$this->tests)){
                        $this->tests[$app->tests[$i]->name]++ ;
                    }else{
                        $this->tests_id[$app->tests[$i]->name]=$app->tests[$i]->id;
                        $this->tests[$app->tests[$i]->name] = 1 ;
                    }
                    $j++;                   
                    $i++;
                }
                //var_dump($this->tests);
            }
            $looper = array_keys($this->tests);
            foreach($looper as $value){
                $test_id = $this->tests_id[$value];
                $test_count = $this->tests[$value];
                $sql3="INSERT into report_test(report_id,test_id,test_count) value('$last_id','$test_id','$test_count')";
                $conn->query($sql3);
                $lid=$conn->insert_id;

            }
            $sql2="UPDATE report SET total_income ='$totalincome' WHERE report_id='$last_id' ";
            $conn->query($sql2);
            return $this->__construct($last_id);
        }    
    }

    function get_monthly_report($year,$month)
    {
        //$this->type=2;
        $lid=null;
        $arr=[];
        $last_id=null; 
       
        $dateconcat= $year . '-' . $month . '-' .'01';
      


        $conn = db::getInstance();
        //SELECT * FROM `appointment` WHERE month(date)=12 and year(date)=2020
        $query = "SELECT * from appointment where  month(date)='$month' and year(date)='$year' and payed_amount=final_cost and is_deleted='0'" ;
        if($result = $conn->query($query))
        {
            $sql = "INSERT into report(type,date) value('2','$dateconcat')";
            $conn->query($sql);
            $last_id = $conn->insert_id;
            $totalincome=0;
            $j=0;
            while($row = mysqli_fetch_array($result))
            {
                $app=new appointment($row["appointment_id"]);
               
                $totalincome += $app->final_cost;
              
                $i=0;
                
                while($i<count($app->tests))
                {
                    $test_id=$app->tests[$i]->id;
                    if(array_key_exists($app->tests[$i]->name,$this->tests)){
                        $this->tests[$app->tests[$i]->name]++ ;
                    }else{
                        $this->tests_id[$app->tests[$i]->name]=$app->tests[$i]->id;
                        $this->tests[$app->tests[$i]->name] = 1 ;
                    }
                    $j++;                   
                    $i++;
                }
                //var_dump($this->tests);
            }
            $looper = array_keys($this->tests);
            foreach($looper as $value){
                $test_id = $this->tests_id[$value];
                $test_count = $this->tests[$value];
                $sql3="INSERT into report_test(report_id,test_id,test_count) value('$last_id','$test_id','$test_count')";
                $conn->query($sql3);
                $lid=$conn->insert_id;
            }
            $sql2="UPDATE report SET total_income ='$totalincome' WHERE report_id='$last_id'";
            $conn->query($sql2);
            return $this->__construct($last_id);
        }
    }
}