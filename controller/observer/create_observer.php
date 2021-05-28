<?php
include_once 'C:/xampp/htdocs/test/controller/observer/observer.php';
include_once 'C:/xampp/htdocs/test/model/appointmentmodel.php';
require_once "C:/xampp/htdocs/test/view/view.php";
class CreateObserver implements Observer{

    private $isIDSet;
    public function __construct($appointment) {
        $this->isIDSet = $appointment->id;
        $appointment->register($this);
    }
    public function update($appointment)
    {
        if($this->isIDSet != $appointment->id and $appointment->id != null)
        {
            $this->isIDSet = $appointment->id;
            include_once "c:/xampp/htdocs/test/phpmailer/mail.php";
            $appointment->getmailbody(2);
            $mail=new mail($appointment);

           //// echo $appointment->mailbody;

            View::Alert($appointment->mailbody);
            ////
        }
    }
}