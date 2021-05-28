<?php
class validate
{
    public function valname($givenName)
    {
        if(preg_match("/^([a-zA-Z' ]+)$/",$givenName)&& $givenName){
            return true;
        }
        else{
            return false;
        }
    }
    public function valid($givenid )
    {
        if(is_numeric($givenid)&& $givenid && $givenid>-1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function valphone($givenphone)
    {
        if(is_numeric($givenphone)&& $givenphone && strlen($givenphone) == 11)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function valaddress($givenaddress)
    {
        //// something space somwthing
        if(preg_match("/(([A-z])+ )/",$givenaddress)&& $givenaddress)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function valdate($givendate)
    {
        if(preg_match("/\d\d\d\d\D\d\d\D\d\d/",$givendate)&& $givendate)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function valtime($giventime)
    {
        if(preg_match("/([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/",$giventime)&& $giventime)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function valint($givenint)
    {
      if($givenint>999999)
      {
          return false;
      }
      if($givenint<0)
      {
          return false;
      }

      if($givenint==null || $givenint=="")
      {
          return false;
      }
      return true;
    }

}
?>