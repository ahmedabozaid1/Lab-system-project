<?php

        include_once "C:/xampp/htdocs/test/model/appointmentmodel.php";

        $app = new appointment(1);
        $json = $app->countAppointmentsInAll();
        echo $json;