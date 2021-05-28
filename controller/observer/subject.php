<?php

include_once "C:/xampp/htdocs/test/controller/observer/observer.php";

interface Subject{


    public function register(Observer $obs);
    public function unregister(Observer $obs);
    public function notifyObserver();
}