<?php
      
      require_once ('humanmodel.php');
      require_once ('user_link.php');
      require_once ('links.php');
      class user extends humanmodel
      {
            public $username;
            public $password; 
            public $type;
            public function __construct($id)
            {
                  parent::__construct($id);
                  ///$db=new db();
                  $conn = db::getInstance();
                  if ($id !="")
		      {	
                        $query="select * from login where id='$id'";
                        $result = $conn->query($query);
                        $row = mysqli_fetch_array($result);
                        if($row!=null)
                        {
                              $this->id=$id;
                              $this->username=$row["username"];
                              $this->password=$row["password"];

                        }
                        $query = "SELECT * from user where id = '$id'";
                        $result = $conn->query($query);
                        if($row = mysqli_fetch_array($result))
                        {     
                              $str=$row['usertype_id'];
                              $query= "SELECT * FROM usertype Where id='$str'";
                              $result = $conn->query($query);
                              $row1 = mysqli_fetch_array($result);
                              $this->type = $row1["type"];
                        }                      
                 }
            }
            public function gettype()
            {
                  ////$db=new db();
                  $conn = db::getInstance();
                  $query= "SELECT * FROM usertype AND is_deleted='0'";
                  $result = $conn->query($query);
                  $i=0;
                  $alltypes=[];
                  while($row = mysqli_fetch_array($result))
                  {
                        $alltypes[$i]=$row["type"];
                        $i++;
                  }
                  return $alltypes;
 
            }
            function gettypeid($typename)
            {
                  ///$db=new db();
                  $conn = db::getInstance();
                  $query= "SELECT * FROM usertype where type = '$typename' AND is_deleted='0'";
                  $result = $conn->query($query);
                  if($row = mysqli_fetch_array($result))
                  {
                        $typeid=$row["id"];
                        return $typeid;
                  }
            }
            public function deleteuser($id)
            {
                 $this->deletehuman($id);
                 $conn = db::getInstance();
                 $query= "DELETE FROM login Where id='$id'";
                 $result = $conn->query($query);
            }
            public function Register_user($id,$username,$password)
            {
                 
                  $conn = db::getInstance();
                  $hash=hash('sha256',$password);
                  $query = "INSERT into login(id,username,password) value('$id','$username','$hash')";
                  $result = $conn->query($query);    
            }
            public function login($username, $password)
            {
                  session_start();
                  $conn = db::getInstance();
                  $hash=hash('sha256',$password);
                  $query= "SELECT id FROM login WHERE username='$username' and password ='$hash' AND is_deleted='0'";
                  $result = $conn->query($query);
                  $row = mysqli_fetch_array($result);
                  if($row !=null)
                  {
                        ///return"yes";
                        $query= "SELECT usertype_id FROM user WHERE id='$row[0]'";
                        $result = $conn->query($query);
                        if($row1= mysqli_fetch_array($result))
                        {
                              $_SESSION['username']=$username;
                            ////return "$row1[0]";
                             $query= "SELECT * FROM user_link WHERE usertype_id='$row1[0]'";
                             $result = $conn->query($query);
                             $arr=null;
                             $i=0;
                              while($row = mysqli_fetch_array($result))
                              {
                                    $arr[$i]=new user_link($row["id"]);
                                    $i++;
                              }
                              ///return $arr;
                              $i=0;
                              $return=null;
                              while(count($arr)>$i)
                              {
                                    $ve=$arr[$i]->link_id;
                                    $query= "SELECT * FROM links WHERE id='$ve'";
                                    $result = $conn->query($query);
                                    if($row= mysqli_fetch_array($result))
                                    {
                                          $return[$i]=new links($row["id"]);
                                    }
                                    $i+=1;
                              }
                              $i=0;
                              $plink=null;
                              $purl=null;
                              while(count($return)>$i)
                              {
                                    $plink[$i]=$return[$i]->linkname;
                                    $purl[$i]=$return[$i]->url;
                                    $i++;
                              }
                              $_SESSION['links']=$plink;
                              $_SESSION['url']=$purl;
                              return true;
                        }
                  }
                  else
                  {
                        return false;
                  }
            }
            public function reset_password($username,$newpass) /////////////////////fyha t8yerrrrr
            {
                 
                  $conn = db::getInstance();
                  $query= "SELECT * FROM login WHERE username='$username' AND is_deleted='0'";
                  $result = $conn->query($query);
                  if($row = mysqli_fetch_array($result))
                  {
                        $hash=hash('sha256',$newpass);
                        $query= "UPDATE login SET password = '$hash'WHERE username='$username'";
                        $result = $conn->query($query);
                        return true;

                  }else{
                       return false;
                  }
                  
            }
            public function logout()
            {
                  ////session_start();
                  session_unset();
                  session_destroy();
                  ///return "loggedout";
            }


          

        function selectall()
        {
            $i=0;
      
            $conn = db::getInstance();
            $query = "SELECT * from user where is_deleted='0' "; // order by id
            $result = $conn->query($query);
            $return=[];
            while($row = mysqli_fetch_array($result))
            {
                $return[$i]=new user($row["id"]);
                

                $i++;
            }

           return $return;
        }
        function selectwithid($selctid)
        {
            $i=0;
     
            $conn = db::getInstance();
            $query = "SELECT *FROM user Where id='$selctid' AND is_deleted='0'"; // order by id
            $result = $conn->query($query);
            $return=[];
            if($row = mysqli_fetch_array($result))
            {
                $return=new user($row["id"]);


            }
            return $return;
        }
        function selectwithname($selctname)
        {
            $i=0;
           
            $conn = db::getInstance();
            $query = "SELECT * FROM user ORDER BY id Where name ='$selctname' AND is_deleted='0'"; // order by id
            $result = $conn->query($query);
            $return=[];
            while($row = mysqli_fetch_array($result))
            {
                $return[$i]=new humanmodel($row["id"]);
                $i++;
            }
        }
        function updatename($updateid,$newname)
        {
            $conn = db::getInstance();
            $query= "SELECT * FROM user WHERE id='$updateid' AND is_deleted='0'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                  $query= "UPDATE user SET name = '$newname'WHERE id='$updateid'";
                  $result = $conn->query($query);
                  return "name updated";

            }else{
                  return"error";
            }

            
        }
        function updatephone($updateid,$newphone)
        {
            $conn = db::getInstance();
            $query= "SELECT * FROM user WHERE id='$updateid' AND is_deleted='0'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                $query= "UPDATE user SET phone_number = '$newphone' WHERE id='$updateid'";
                $result = $conn->query($query);
                return "phone updated";
            }
            else{
                  return"error";
            }
        }
        function insertnewhuman($address,$phone_number,$gender,$dob,$name,$usertype_id,$username,$password)
        {
            $conn = db::getInstance();



            $query= "INSERT INTO user (address_id,phone_number,gender,dob,name,usertype_id) Values(0,'$phone_number','$gender','$dob','$name','$usertype_id')";
            $result = $conn->query($query);

            $query1= " SELECT * FROM user WHERE name='$name' AND is_deleted='0'";
            $result1 = $conn->query($query1);
            $row1 = mysqli_fetch_array($result1);

            if($row1 !=null)
            {
                $this->change_address($row1["id"],$address);
                $this->Register_user($row1["id"],$username,$password);
              
            }
            

        }
        function deletehuman($id)
        {
              $conn = db::getInstance();
            $query= "SELECT *FROM user Where id='$id' AND is_deleted='0'";
            $result = $conn->query($query);
            $row = mysqli_fetch_array($result);
            if($row[0]!=null)
            {
                //UPDATE queue SET is_deleted = '1'
                $query= "UPDATE user SET is_deleted = '1' Where id='$id'";
                $result = $conn->query($query);
                return "user deleted";
            }
        }
        function recaddress($revarray,$parent_id,$id)
        {
            if($id>count($revarray)-1)
            {
                return;
            }
           $conn = db::getInstance();
            $query= "SELECT *FROM address Where address='$revarray[$id]' AND is_deleted='0'";
            $result = $conn->query($query);
           if($row = mysqli_fetch_array($result))
            {
                /// the raw of the address if exist
            }
            else
            {
                /// if doesnt exist/
                // create

                $query2= "  INSERT INTO address ( address, parent_id) VALUES ('$revarray[$id]', '$parent_id')  ";
                $conn->query($query2);
    
            }
            $query= "SELECT *FROM address Where address='$revarray[$id]'";
            $result = $conn->query($query);
            $row = mysqli_fetch_array($result);
            
            $this->recaddress($revarray,$row["address_id"],$id+1);
             return  ;
        } 
      function change_address($id,$newaddress)
      {
            $array=mb_split(' ',$newaddress);
            $revarray=array_reverse($array);
            $this->recaddress($revarray,0,0);
            /// addd leaf id to table user


            $conn = db::getInstance();
            $query = "SELECT * from address where address = '$array[0]'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                $rid=$row["address_id"];
                $query = " UPDATE `user` SET `address_id` = '$rid' WHERE `user`.`id` = $id ";
                $result = $conn->query($query);
    
            }
            



      }
}

      


    
      
    

       


  
     



  