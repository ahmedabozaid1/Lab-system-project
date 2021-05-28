<?php

abstract class cost 
{

    abstract public function  cost();
    abstract public function  description();

}  

abstract class  costdecorator extends cost {

    protected $extracost ;
    public function __construct(cost $c) {
        $this->extracost = $c;
    }   

    abstract public function  cost();
    abstract public function description();
}

class tax extends costdecorator
{
    function __construct(cost $c) {
        $this->extracost = $c;
    }   
    public function  cost()
    {
        $hi=$this->extracost->cost();
        $hi+= $hi*(14/100); // persent
        return $hi;

    }
    function description ()
    {
      return $this->extracost->description() . ", tax = 14 % vat ";
    }

}
class discount extends costdecorator
{
    public $amount;
    function __construct(cost $c) {
        $this->extracost = $c;
    }
    function set_amount($x)
    {
        $this->amount=$x; // persent
    }
    public function  cost()
    {
        if($this->amount)
        {
            $hi=$this->extracost->cost();
            $hi-= $hi*($this->amount/100);
            return $hi;
    
    
        }
    }
    function description ()
    {
      return $this->extracost->description() . ", discount = ".$this->amount ." % ";
    }
}

class urgent extends costdecorator
{
    
    function __construct(cost $c) {
        $this->extracost = $c;
    }
   
    public function  cost()
    {
        $hi=$this->extracost->cost();
        $hi+= $hi*(10/100);
        return $hi;

    }
    function description ()
    {
      return $this->extracost->description() . ", urgent = 10 % ";
    }
}

//// add new class
?>