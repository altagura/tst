<?php
/**
 * Created by PhpStorm.
 * User: altagur
 * Date: 12/2/2016
 * Time: 10:41 AM
 */
class Funs
{
    public static function formatDatepickerToMySql($date)
    {
        if ($date != FALSE)
        {
            if(strripos($date, '/')!= FALSE){
                $dateArr = explode("/", $date);
                $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0].' 00:00:00';
            }else{
                $newDate = $date;
            }
            return $newDate;
        }
        return FALSE;
    }

    public static function hasFile($name){
        if (!isset($_FILES[$name])) { return false; }
        if (empty($_FILES[$name]['size'])) { return false; }
        return true;
    }

    public static function chkdate($date)
    {
      if($date=='')
      {
         return date('d.m.Y');
      }else{
         return Funs::formatDatepickerToMySql($date);
      }//дата
    }
}