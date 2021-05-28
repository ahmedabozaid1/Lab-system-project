<?php
include_once "../model/appointmentmodel.php";
///include_once"../decorative/cost.php";
///include_once"../model/report_model.php";

include_once "c:/xampp/htdocs/test/model/viewmodel.php";
include_once "c:/xampp/htdocs/test/model/customreport.php";



//$r=new customreport(5);
//var_dump($r);
//$r->create_new("newname","min","1900-01-01","none",null,"0");
// for ($i=0;$i<count($r->test);$i++)
// {
//     echo $r->test[$i]->id. "   ". $r->test[$i]->name . "/n                                           ";
   
// }







///$v=new viewmodel();
//$html=$v->doit("login.php");
//echo $html;


// $Date1 = strtotime(date('Y-m-d', strtotime("2020-12-31") ) ).' ';

// if($Date1 < time()) 
// {
// echo "time passes";   
// }



///$report=new report(40);

///var_dump($report);


////echo $report->id;
/////var_dump($report->test_count);
///echo count($report->test);

//$report->get_day_report('2020-12-29');
///echo "$report->id <br>";

//////echo $report->test[0]->name ;

///echo $report->test_count[0];

///include_once "../model/testnormalmodel.php";
/////clude_once  "/opt/lampp/htdocs/test/model/testoptionmodel.php";

// $app=new appointment(70);
// var_dump($app);
// $app=new tax($app);
// $app->cost();
// $d=$app->description();
// $app=new discount($app);
// $app->set_amount(10);
// $c=$app->cost();
// $d=$app->description();
// echo $d;
// echo $c;






///$app->create_appointment(3,'2020/12/10','05:00:00',25);
///$app->create_appointment(1,'2020/12/10','05:00:00',0,0);
///$app->create_appointment(2,'2020/09/10','09:00:00',0);

///$app->deleteappointment(1);

//$app->add_payment(3,40);

/////$app->show_app_intime("2020/12/10","05:00:00");
///$date='2020-12-09';
///$h=new appointment(6);
//$app=$h->show_all_appointment();
///$h->show_app_intime_confirmedAllowed($date);
//var_dump($app);

// $j=0;
// while(count($h->tests))
// {

//     $h->tests[$j];
// }

///$hah=$app[6];
//echo $h->tests[0]->name;
///echo $app[3]->tests[0]->name;
//print_r($app[6]);

////var_dump($app[3]);
////echo $app[6]->date;
///$array=$h->show_appointment(6);
///echo $array->;


//$n=new normal(1);
///echo "$n->start";
///echo "$n->end";
///echo "$n->measureunit";
////$o=new option(1);
//echo "$o->name <br>";
//echo "$o->type <br>";
//echo "$o->$normal->start";
////var_dump($o->normal);
//$o->addvalue(38,1,4000);
//echo"$o->value";

///$t=new test(11);

//echo "$t->name <br>";
///echo $t->options[1]->normal[0]->measureunit;
/*

$f=new option(11);
$hamada=$f->setvalueandindex(12,64,11);

var_dump($hamada);

*/


//var_dump($t->options);

// $date="2020-12-23";

// $da=date('Y-m-d', strtotime($date .' +1 day'));
// echo $da;