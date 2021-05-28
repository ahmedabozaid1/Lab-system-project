<?php

class addmeasure 
{


    function __construct()
    {
        $file="C:/xampp/htdocs/test/view/addmeasure.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
   
    public static function display($test,$id,$appid)
    {

        echo"
        <div class='login-form'>
        <form>
        <h2 class='text-center'>$test->name</h2> 
        <input id=cta-hidden type='hidden'  name='id' value='$id'>
                <input id=cta-hidden type='hidden'  name='appid' value='$appid'>
        ";

        if($test->options)
        {
            $i=0;
        
            $number=count($test->options);
            while($i<$number)
            {
                $str=$test->options[$i]->name;
    
                echo"<h3>Value of $str </h3>";
                   
                    $value="value".$i;
                
                if($test->options[$i]->type == "bool")
                {
                    echo"
                    <div class='form-group'>
                    <select  name='va' id='va' class='form-control' onchange='myselect(event)'>
                    <option disabled selected>Choose</option>
                    <option value='0'>Postitve</option>
                    <option value='1'>Negative</option>
                    </select>

                    <input id='cta' type='hidden' class='bool' name='$value' placeholder='Value* ' value=''/>
                    </div>
                    
                    <script> 
                    function myselect(e) {
                        document.getElementsByClassName('bool')[0].value = e.target.value
                     
                    }
                    
                    </script>
                    "; 
                    
                }
                else{
                echo"
                    <div class='form-group'>
                    <input id='cta' type='text' class='form-control' name='$value' placeholder='Value* ' value=''/>
                    </div> 
                ";
                }
                /////hidden test id app id
              
                $num=count($test->options[$i]->normal);
                $j=0;
             
                               echo"
                                <div class='form-group'>
                                <label for='RR'>Refrence Range</label>
                                <select class='Ref' name='RR' id='RR'>";
    
                            while($j<$num)
                            {

                                if($test->options[$i]->type=="bool")
                                {
                                    $strn=$test->options[$i]->normal[$j]->start;
                                }else{
                                $strn=$test->options[$i]->normal[$j]->start." / ".$test->options[$i]->normal[$j]->end."    ".$test->options[$i]->normal[$j]->measureunit;
                                }
                                echo"
                                <option value='$j'>$strn</option>
                                ";
                           
                            /// $test->options[$i]->index=$_GET['RR'];
                             ///echo $test->options[$i]->index;
                              $j++;
                            }
                                echo"
                                </select>
                                </div>
                        ";
                $i++;
               
            }
        }
    
        echo"<div class='form-group'>
        <button onclick='return myFunction()' name='addtest' class='btnRegister'>  ADD </button>
        </div> ";   
        echo "</div>
        </form>
        </div>
        <script>
        function myFunction() {
            var items = document.querySelectorAll('#RR option:checked'),
            inps = document.querySelectorAll('#cta'),
            inpsHidden = document.querySelectorAll('#cta-hidden'),
            tab = [],tab2=[],tab3=[], index;
            var index= 0;
            //console.log(inps);
            for(var i = 0; i < items.length; i++){
                tab.push(items[i].index);
            }
            for(var i = 0; i < inps.length; i++){
                tab2.push(inps[i].value);
            }
            for(var i = 0; i < inpsHidden.length; i++){
                tab3.push(inpsHidden[i].value);
            }
            console.log(tab);
            console.log(tab2);
            console.log(tab3);
            var url ='http://localhost/test/controller/addmeasurecontroller.php';
            url += '?data1=' +tab.toString();
            url += '&data2=' +tab2.toString();
            url += '&data3=' +tab3.toString();
            console.log(url);
           window.location.href = url;
            return false;
        }
        </script>
        </body>
        </html>  ";
    
    }
}