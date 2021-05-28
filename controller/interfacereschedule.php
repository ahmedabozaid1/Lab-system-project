<?php

interface Ireschecdule
{
    public function reschedule($date,$time);
}

class samenextmonth implements Ireschecdule
 {
    public function reschedule($date,$time)
    {
        ///logic
        $arr[0] = date('Y-m-d', strtotime('+1 month', strtotime($date)));
        $arr[1]=$time;
        return $arr;
    }
 }
 class sametimetommorow implements Ireschecdule
 {
    public function reschedule($date,$time)
    {
        $arr[0]=date('Y-m-d', strtotime($date .' +1 day'));
        $arr[1]=$time;
        return $arr;
    }
 }
 class defaultreschedule implements Ireschecdule
 {
    public function reschedule($date,$time)
    {
        $arr[0]=$date;
        $arr[1]=$time;

        return $arr;
    }
 }
//////class ay haga imple

?>