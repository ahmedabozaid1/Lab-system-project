<?php
include_once 'C:/xampp/htdocs/test/controller/observer/observer.php';
include_once 'C:/xampp/htdocs/test/model/appointmentmodel.php';
require_once "C:/xampp/htdocs/test/view/view.php";
class DeleteObserver implements Observer{

    private $isDeleted;
    public function __construct($appointment) {
        $this->isDeleted = $appointment->isDeleted;
        $appointment->register($this);
    }
    public function update($appointment){
        if($this->isDeleted != $appointment->isDeleted and $appointment->isDeleted == TRUE){
            $this->isDeleted = $appointment->isDeleted;
            include_once "c:/xampp/htdocs/test/phpmailer/mail.php";
            $appointment->getmailbody(3);
            $mail=new mail($appointment);
            View::Alert($appointment->mailbody);
        }
    }
}