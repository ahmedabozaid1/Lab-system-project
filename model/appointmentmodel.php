    <?php

///include_once "../db.php";
///include_once "/opt/lampp/htdocs/test/model/patientmodel.php";
include_once "C:/xampp/htdocs/test/model/testmodel.php";
include_once "C:/xampp/htdocs/test/controller/observer/subject.php";
include_once "c:/xampp/htdocs/test/controller/interfacereschedule.php";

include_once "C:/xampp/htdocs/test/controller/cost.php";


class appointment extends cost implements Subject {
    public $ref;
    public $id;
    public $patient;
    public $date;
    public $time;
    public $isconfirmed;
    public $totalcost;
    public $payedamount;
    public $tests=[];
    public $isDeleted;
    private $observers;
    public $report_ready_date;
    public $final_cost;
    public $report_ready_time;
    public $comment="";
    public $mailbody;

    public function __construct($ID)
    {
        if($this->observers==null)$this->observers = array();
      
      if($ID)
      {
        $conn = db::getInstance();
        $sql = "SELECT * FROM appointment where appointment_id='$ID'";
        $Set = $conn->query($sql);
        while($row = mysqli_fetch_array($Set)){
            $this->id=$row[0];

            $patient_id=$row['patient_id'];
            $this->patient=new patient($patient_id);
            $this->date = $row['date'];
            $this->time = $row['time'];
            $this->isconfirmed=$row['is_confermed'];
            $this->totalcost=$row['total_cost'];
            $this->payedamount=$row['payed_amount'];
            $this->report_ready_date=$row['report_ready_date'];
            $this->report_ready_time=$row['report_ready_time'];
            $this->final_cost=$row['final_cost'];
            $this->comment=$row['comment'];




            if($row['is_deleted']=='0') $this->isDeleted = FALSE; 
            else $this->isDeleted = TRUE;
        }

        $sql2 = "SELECT * FROM test_appointment where appointment_id='$ID' AND is_deleted='0'";
        $Set2 = $conn->query($sql2);
        $i=0;
        while($row2 = mysqli_fetch_array($Set2))
        {

            $testid=$row2['test_id'];
            $newtest= new test ($testid);
            $this->tests[$i]=$newtest;
            $i++; 
       }
      }
    }

    public function getmailbody($type)
    {
        $conn = db::getInstance();
        $sql="SELECT * FROM email Where app_type ='$type'";
        $result=$conn-> query($sql);
        if($row = mysqli_fetch_array($result)){
            ///echo"hahah";
            $body = explode(" ", $row["body"]);
            for($i=0;$i<count($body);$i++)
            {
                if($body[$i]=="{name}")
                {
                    $body[$i]=$this->patient->name;
                }
                if($body[$i]=="{date}")
                {
                    $body[$i]=$this->date;
                }
                if($body[$i]=="{time}")
                {
                    $body[$i]=$this->time;
                }
            }
            $mail=implode(" ",$body);

            $this->mailbody=$mail;
            //echo $this->mailbody;
        }
    }
    public function  cost()
    {
        
        return $this->totalcost;
    }
    function description ()
    {
      return "";
    }
    public function setreschedule( Ireschecdule $ref,$id,$date,$time)
    {
        $this->ref=$ref;
        $this->reschedule_appoitment($id,$date,$time);
    }

    public function register(Observer $newObserver){
        $this->observers[] = $newObserver;
        //echo "called <br>";
        //var_dump($this->observers);
    }

    public function unregister(Observer $deleteObserver){
        $observerIndex = array_search($deleteObserver,$this->observers);
        unset($this->observers[$observerIndex]);
    }

    public function notifyObserver(){
        
        for($i=0;$i<count($this->observers);$i++){
            $this->observers[$i]->update($this);
        }
    }

    public function selecttestindex($testid)
    {
        for ($i=0;$i<count($this->tests);$i++)
        {
            if($this->tests[$i]->id==$testid)
            {
                return $i;
            }
        }
    }

   public function reschedule_appoitment($id,$date,$time)
   {
        $arr=$this->ref->reschedule($date,$time);
        $date=$arr[0];
        $time=$arr[1];   
        ///////nady 3la validate
        if($this->check_time_available($date,$time))  ////////if true schedule
        {   
            $conn = db::getInstance();
            $sql="SELECT * FROM appointment Where appointment_id ='$id' AND is_deleted='0'";
            if($conn-> query($sql))
            {
                $sql2="UPDATE appointment SET date='$date', time='$time' WHERE appointment_id='$id'";
                if($conn-> query($sql2))
                {   
                    $this->date = $date;
                    $this->time = $time;
                    //var_dump($this);
                    $this->notifyObserver();
                    return TRUE;
                }else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }
   }

    public function check_schedule($date,$time)
    {
        $conn = db::getInstance();
        $sql = "select DAYNAME('$date');";
        $Set = $conn->query($sql);
        $row = mysqli_fetch_array($Set);
        $DAYNAME = $row[0];
        //echo $DAYNAME."<br>";
        $sql = "select * from schedule where day_name='$DAYNAME';";
        $Set = $conn->query($sql);
        if(mysqli_num_rows($Set)==0) return FALSE;
        $row = mysqli_fetch_array($Set);
        if ($row['day_name'] != NULL)
        {
            $time_now = strtotime($date." ".$time);
            $start = strtotime($date." ".$row['start_time']);
            $end = strtotime($date." ".$row['end_time']);
            //echo $time_now." ".$start." ".$end." <br>";
            if($time_now >= $start && $time_now <= $end) {
                //echo "True";
                return TRUE;
            } else {
                //echo "False";
                return FALSE;
            }
        }
        else if($row['day_name'] == NULL){
            //echo "False";
            return FALSE;
        }
    }
    public function countAppointmentsInAll()
    { 
          $appList = $this->show_all_appointment();
        $month = date('m');
        $year = date("Y");
        $numberOfDays = cal_days_in_month(CAL_GREGORIAN,$month,$year);

        $list=array();   
        for($i=0; $i<count($appList); $i++){
            //$date = $year.'-'.$month.'-'.$day;
            //echo $date;
            $numberOfAppointment = $this->countAppointmentsInDay($appList[$i]->date);
            if($numberOfAppointment > 0){
                array_push($list,array(
                    'title'=> $appList[$i]->patient->name.' Booked'
                    , 'start'=> $appList[$i]->date
                ));
            }
        }
        //var_dump($list);
        return json_encode($list);
    }
    public function countAppointmentsInMonth(){
        $month = date('m');
        $year = date("Y");
        $numberOfDays = cal_days_in_month(CAL_GREGORIAN,$month,$year);

        $list=array();   
        for($day=1; $day<=$numberOfDays+1; $day++){
            $date = $year.'-'.$month.'-'.$day;
            //echo $date;
            $numberOfAppointment = $this->countAppointmentsInDay($date);
            if($numberOfAppointment > 0){
                array_push($list,array(
                    'title'=> $numberOfAppointment.' Booked'
                    , 'start'=> $date
                ));
            }
        }
        //var_dump($list);
        return json_encode($list);
    }
    public function countAppointmentsInDay($date)
    {
        $conn = db::getInstance();
        $sql = "SELECT * FROM appointment WHERE date='$date' AND is_deleted='0'";
        $Set = $conn->query($sql);
        return mysqli_num_rows($Set);
    }
   /////public function check_time_available($date,$time)//////////////////adham
   public function pastDays($date)
   {
        $Date1 = strtotime(date('Y-m-d', strtotime($date) ) ).' ';
        $Date2 = strtotime(date('Y-m-d'));

        if($Date1 < $Date2) 
        {

            return TRUE;
        }
        else
        {
            return FALSE;
        }
   }
   public function checkOpenDays($date)
    {
        $conn = db::getInstance();
        $sql = "select DAYNAME('$date');";
        $Set = $conn->query($sql);
        $row = mysqli_fetch_array($Set);
        $DAYNAME = $row[0];
        //echo $DAYNAME."<br>";
        $sql = "select * from schedule where day_name='$DAYNAME';";
        $Set = $conn->query($sql);
        $row = mysqli_fetch_array($Set);
        if($row == NULL){
            //echo "False";
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
   public function check_time_available($date,$time)//////////////////adham
   {

    $Date1 = strtotime(date('Y-m-d', strtotime($date) ) ).' ';
    $Date2 = strtotime(date('Y-m-d'));

    if($Date1 < $Date2) 
    {
         $available = false;
         return $available;
    }


       else
       {
           if($this->check_schedule($date,$time))
           {
            $conn = db::getInstance();
               $sql = "select * from appointment where date='$date' and time='$time'";
               $Set = $conn->query($sql);
               $available=TRUE;
               while($row = mysqli_fetch_array($Set)){
                   if($row['is_confermed'] == '0')
                   {
                       $available = TRUE;
                       return $available;
                   }
                   if($row['is_confermed'] == '1'){
                       $available = FALSE;
                       return $available;
                   }
               }
               return $available;
           }else{
               return false;
           }

       }
   }
    
    public function add_payment($appointment_id,$payedamount)
    {
        $conn = db::getInstance();
        $sql="SELECT * From appointment where appointment_id ='$appointment_id' AND is_deleted='0'";
        $result= $conn->query($sql);
        if($row = mysqli_fetch_array($result))
        {
            $sql="SELECT payed_amount From appointment where appointment_id ='$appointment_id' AND is_deleted='0'";
            $result= $conn->query($sql);
            if($row = mysqli_fetch_array($result))
            {          
                $sql3="DELETE FROM queue WHERE apoitment_id='$appointment_id'";  //////////////delete from queue
                $conn->query($sql3);
                
                
                $oldamount=$row["payed_amount"];
                $newamount=$oldamount+$payedamount;
                $sql = "UPDATE appointment SET payed_amount='$newamount', is_confermed='1' WHERE appointment_id='$appointment_id' AND is_deleted='0'" ;
                $result= $conn->query($sql);
                if($result)
                {
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
    public function show_app_intime($date,$time)
    {
       //////////rg3lo kol al nas al fi al w2t da
       $conn = db::getInstance();

        $sql="SELECT * FROM appointment Where date='$date' AND time='$time' AND is_confermed='0' AND is_deleted='0'";
        $result=$conn->query($sql);
        $i=0;
        $apps=null;
        while ($row = mysqli_fetch_array($result))
        {
            $apps[$i]=$row["appointment_id"];
            $i++;
        }

        if($result)
        {
            //echo"haha";
            $i=0;
            $j=0;
            $array=[];

        if($apps)
        {
            while($i<count($apps))
            {
                $sql="SELECT * From queue where apoitment_id='$apps[$i]'";
                $result2=$conn-> query($sql);
                if($row = mysqli_fetch_array($result2))
                {
                    ///echo"haha";
                    $array[$j]=new appointment($row["apoitment_id"]);
                   ///// echo"$array[$j]";
                    $j++;
                }
                $i++;
            }
        }
            return $array;
            
        }
    }
    public function show_app_intime_confirmedAllowed($date)
    {
       //////////rg3lo kol al nas al fi al w2t da
       $conn = db::getInstance();
       ///select * 2b3t object 
       $sql="SELECT * FROM appointment Where date='$date' AND is_deleted='0' ";
       $result=$conn->query($sql);
       $i=0;
       $array=[];

       while($row = mysqli_fetch_array($result))
       {
         /////////// echo"show";
         $array[$i]= new appointment($row[0]); 
         $i++; 
       }
       return $array;  


    }


    public function create_appointment($patientname,$date,$time,$payedamount,$test,$report_ready_date,$report_ready_time)
    {
        
        $conn = db::getInstance();
        $last_id=null;
        $sql="SELECT * From patient where name ='$patientname'";
        $TestSet = $conn->query($sql);
        if($row = mysqli_fetch_array($TestSet))
        {  
            $patient= new patient($row["patient_id"]);
            $patient_id=$patient->id;
            $i=0;
            $totalcost=0;
            while($i<count($test))
            {
                $sql3=" SELECT price FROM test WHERE test_id =$test[$i] ";
                $result=$conn->query($sql3);
                $row2=mysqli_fetch_array($result);
                $price=$row2[0];
                $totalcost+=$price;
                $i++;  

            }
            if($this->check_time_available($date,$time))
            {
                
                if($payedamount>0)
                {
                   //// echo "t3bt 1";
                    $sql = "insert into appointment(patient_id,date,time,payed_amount,is_confermed,total_cost,report_ready_time,report_ready_date,final_cost,comment) value('$patient_id','$date','$time','$payedamount','1','$totalcost','$report_ready_time','$report_ready_date','0','c')"; 
                    $conn-> query($sql);
                    $last_id = $conn->insert_id;
                }else{
                  ///  echo "t3bt 2";
                    $sql = "insert into appointment(patient_id,date,time,payed_amount,is_confermed,total_cost,report_ready_time,report_ready_date,final_cost,comment) value('$patient_id','$date','$time','$payedamount','0','$totalcost','$report_ready_time','$report_ready_date','0','c')";    
                    $conn-> query($sql);
                  
                    $last_id = $conn->insert_id;
                    //
                    $sql2= "insert into queue(apoitment_id) value('$last_id')"; ////////////put this appointment in queue          
                    $conn-> query($sql2);  
                }

                $i=0;
                while($i<count($test))
                  {
                  $sql4=" SELECT price FROM test WHERE test_id ='$test[$i]' ";
                  
                  $result4=$conn->query($sql4);
                  $row4=mysqli_fetch_array($result4);
                  $price=$row4[0];
  
                  $sql5="insert into test_appointment(test_id	,appointment_id,price) value('$test[$i]',$last_id,'$price')";
                  
                  $conn->query($sql5);
                  $i++;
                 
                }
                $this->__construct($last_id);
                
                $this->notifyObserver();
                return $last_id;
               
            }
            else
            {
                $Date1 = strtotime(date('Y-m-d', strtotime($date) ) ).' ';
                $Date2 = strtotime(date('Y-m-d'));
         
                if($Date1 < $Date2) 
                {
                     $available = -1;
                     return $available;
                }

                if($this->check_schedule($date,$time))
                {
                    ////echo "t3bt 3";
                    $sql6 = "insert into appointment(patient_id,date,time,payed_amount,is_confermed,total_cost,report_ready_time,report_ready_date,final_cost,comment) value('$patient_id','$date','$time','$payedamount','0','$totalcost','$report_ready_time','$report_ready_date','0','c')";  
                    $conn-> query($sql6);
                    $last_id = $conn->insert_id;
                    $sql7= "insert into queue(apoitment_id) value('$last_id')"; ////////////put this appointment in queue          
                    $conn-> query($sql7);  

                    $i=0;
                    while($i<count($test))
                    {
                      $sql4=" SELECT price FROM test WHERE test_id ='$test[$i]' ";
                      
                      $result4=$conn->query($sql4);
                      $row4=mysqli_fetch_array($result4);
                      $price=$row4[0];
      
                      $sql5="insert into test_appointment(test_id	,appointment_id,price) value('$test[$i]',$last_id,'$price')";
                      
                      $conn->query($sql5);
                      $i++;
                        
                    }
                    $this->__construct($last_id);
                    $this->notifyObserver();
                    return $last_id;
            }
            $this->__construct($last_id);
            $this->notifyObserver();
            return $last_id;
        }
            

        }
        else{
            return false;
        }

        /////////$db->closeConnction();
    }
    public function setcost($finalcost,$comment,$appointment_id)
    {
        $conn = db::getInstance();
        $sql=" UPDATE appointment SET final_cost='$finalcost', comment='$comment' WHERE appointment_id='$appointment_id' ";
        $result= $conn->query($sql);
    }
    public function show_all_appointment()
    {
        $conn = db::getInstance();
        ///select * 2b3t object 
        $sql="SELECT * FROM appointment where is_deleted=0";
        $result=$conn->query($sql);
        $i=0;
        $array=[];
        while($row = mysqli_fetch_array($result))
        {
        ////////   echo"show";
          $array[$i]= new appointment($row[0]); 
            $i++; 
        }
        return $array;  
    }
    public function show_appointment($id)
    {
        ////////////hat id mo3yn 
        $conn = db::getInstance();
        ///select * 2b3t object 
        $sql="SELECT * FROM appointment where appointment_id='$id' and is_deleted=0";
        $result=$conn->query($sql);
        $row = mysqli_fetch_array($result);
        
        $appointment= new appointment($row[0]);
        
        return $appointment;
    }
    public function deleteappointment($id)
    {
        $this->isDeleted = TRUE;
        $conn = db::getInstance();
        $sql3="UPDATE queue SET is_deleted = '1' WHERE appointment_id='$id'";////////// delete from queue
        $conn->query($sql3);
        $sql2 = "UPDATE test_appointment SET is_deleted = '1' WHERE appointment_id='$id'";
        $conn->query($sql2);
        $sql = "UPDATE appointment SET is_deleted = '1' WHERE appointment_id='$id'";
        $conn->query($sql); 
        
        $this->notifyObserver();
        /////$db->closeConnction();
    }

}
?>