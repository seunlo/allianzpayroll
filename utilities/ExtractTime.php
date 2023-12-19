<?php

  class ExtractTime{

    public function timeExtractor($dateTime){
      $dt = new DateTime($dateTime);
      $time = $dt->format('h:i:s A');
      return $time;
    }


    public function convertToEnglishDate($date){
      $dateString = $date;
      $dateTime = new DateTime($dateString);
      $formattedDate = $dateTime->format("M jS Y");

      return  $formattedDate;
    }
  }


?>