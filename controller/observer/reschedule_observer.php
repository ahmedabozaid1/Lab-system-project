<?php
include_once 'C:/xampp/htdocs/test/controller/observer/observer.php';
include_once 'C:/xampp/htdocs/test/model/appointmentmodel.php';
require_once "C:/xampp/htdocs/test/view/view.php";
class RescheduleObserver  implements Observer{

    private $date;
    private $time;
    public function __construct($appointment) {
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $appointment->register($this);
    }

    public function update($appointment){
        if($appointment->date != $this->date or $appointment->time != $this->time){
            $this->date = $appointment->date;
            $this->time = $appointment->time;
            include_once "c:/xampp/htdocs/test/phpmailer/mail.php";
            $appointment->getmailbody(1);
            $mail=new mail($appointment);
            View::Alert($appointment->mailbody);
        }
    }
}