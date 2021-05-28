<?php
include_once "../model/patientmodel.php";
class patientview
{
    public static function showpage()
    {
       $page = file_get_contents("C:/xampp/htdocs/test/view/patient_create/index.html");
       echo $page;
    }
    public static function headerpage()
    {
        echo file_get_contents("c:/xampp/htdocs/test/view/patient_showall/header.html");
    }
    public static function footerpage()
    {
        echo file_get_contents("c:/xampp/htdocs/test/view/patient_showall/footer.html");
    }
    public static function tableheader()
    {
        echo file_get_contents("c:/xampp/htdocs/test/view/patient_showall/tableheader.html");
    }
    public static function tablefooter()
    {
        echo file_get_contents("c:/xampp/htdocs/test/view/patient_showall/tablefooter.html");
    }
    public function show_all()
    {
        $result=patient::show_all();
        $this->tableheader();
        for($i=0;$i<count($result);$i++)
        {
            $index = $result[$i]->id;
            echo('<tr>
            <th scope="row">'."$index".'</th>
            <td>'.$result[$i]->name.'</td>
            <td>'.$result[$i]->dob.'</td>
            <td>'.$result[$i]->gender.'</td>
            <td>'.$result[$i]->phone_number.'</td>
            <td>'.$result[$i]->fertility.'</td>
            <td> 
            <form action="../../test/controller/patientshowall.php" method="post">
            <input type="hidden" name="id" value="'.$index.'">
            <input type="submit" name="delete'.$index.'" value="delete">
            </form>

            <form action="../../test/controller/patientupdate.php" method="post">
            <input type="hidden" name="id" value="'.$index.'">
            <input type="hidden" name="name" value="'.$result[$i]->name.'">
            <input type="hidden" name="dob" value="'.$result[$i]->dob.'">
            <input type="hidden" name="gender" value="'.$result[$i]->gender.'">
            <input type="hidden" name="phonenumber" value="'.$result[$i]->phone_number.'">
            <input type="hidden" name="fertility" value="'.$result[$i]->fertility.'">
            <input type="submit" name="submit'.$index.'" value="update">
            </form>
            </td>
          </tr>');
        }
        echo "
        <form action='/test/controller/patientcontroller.php' method='post'>;    
        <button type='submit' name='add' class='btn btn-success pull-right'> Add New patient </button>
        </form>";
        $this->tablefooter();
    }
    public static function formheader()
    {
        ///echo file_get_contents("../patient_update/header.html");
    }
    public static function formfooter()
    {
       /// echo file_get_contents("../patient_update/footer.html");
    }
    public function formPatientUpadate($id,$name,$dob,$phone)
    {
            patientview::formheader();
            $str = '<div class="login-form">
            <form action="../../test/controller/patientcontroller.php" method="post">
                <h2 class="text-center">Update Patient</h2>
                <input type="hidden" name="id" value="'.$id.'">       
                <div class="form-group">
                    <input type="text" class="form-control" name="name"placeholder="Fullname" value="'.$name.'" required="required">
                </div>
                <div>
                    <input type="text" class="form-control" name="dob"placeholder="dob" value="'.$dob.'" required="required">
                </div>
                <div class="form-group">
                    <input type="radio" id="male" name="gender" value="m" required="required">
                        <label for="male">M</label><br>
                        <input type="radio" id="female" name="gender" value="f" required="required">
                        <label for="female">F</label><br>
                </div>
                <div>
                    <input type="text" class="form-control" name="phone"placeholder="PhoneNumber" value="'.$phone.'" required="required">
                </div>
                <div>
                    <input type="radio" id="male" name="fertility" value="t" required="required">
                    <label for="male">T</label><br>
                    <input type="radio" id="female" name="fertility" value="f" required="required">
                    <label for="female">F</label><br>
                </div>
                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                </div>    
            </form>
        
        </div>';
        echo $str;
        patientview::formfooter();
    }
    public static function show($Obj)
    {
        echo("<h1>".$Obj->get_name()."</h1><br>");
    }
}
