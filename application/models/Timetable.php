<?php

class Timetable extends CI_Model {

    public $xml = null;
    public $days = array();
    public $times = array();
    public $courses = array();

    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'courseData' . XMLSUFFIX);

        //loop though all days bookings
        foreach ($this->xml->day as $day) {
            //create a new empty booking
            $tempBooking = new Booking();
            $tempBooking->day = $day['day'];

            //loops information into temp booking
            foreach ($day->time as $time) {
                $tempBooking->startTime = (string) $time['startTime'];
                $tempBooking->course = $time->booking->course;
                $tempBooking->room = $time->booking->room;
                $tempBooking->instructor = $time->booking->instructor;
                $tempBooking->type = $time->booking->type;
                $tempBooking->endTime = $time->booking->endTime;
                $this->days[] = new Booking($tempBooking); //add the temp booking to the $days array
            }
        }
        
       /* //loops through all the booking times
        foreach ($this->xml->time as $time) {
            //create a new booking
            $tempBooking = new Booking();
            $tempBooking->startTime = $time['startTime'];

            //loops information into temp booking 
            foreach ($time->day as $day) {
                $tempBooking->day = $day['day'];
                $tempBooking->course = $day->booking->course;
                $tempBooking->room = $day->booking->room;
                $tempBooking->instructor = $day->booking->instructor;
                $tempBooking->type = $day->booking->type;
                $tempBooking->endTime = $day->booking->endTime;
                $this->times[]=$tempBooking; //add the temp booking into the $times array 
            }
        }
        
        //loops through all the booking courses 
        foreach ($this->xml->course as $course) {
            //create a new booking
            $tempBooking = new Booking();
            $tempBooking->course = $course['course'];

            //loops information into temp booking
            foreach ($course->day as $day) {
                $tempBooking->day = $day['day'];
                $tempBooking->startTime = $day->booking->startTime;
                $tempBooking->room = $day->booking->room;
                $tempBooking->instructor = $day->booking->instructor;
                $tempBooking->type = $day->booking->type;
                $tempBooking->endTime = $day->booking->endTime;
                $this->courses[]=$tempBooking; //add the temp booking into the $courses array
            }
        }*/
    }
    
    // gets a list of days
    public function getDay(){
        return $this->days;
    }
    
    //gets a list of the times
    public function getTime(){
        return $this->times;
    }
    
    //gets a list of courses 
    public function getCourse(){
        return $this->courses;
    }

}

class Booking extends CI_Model{

    public $day ="";
    public $startTime="";
    public $endTime="";
    public $course="";
    public $room="";
    public $instructor="";
    public $type="";

    public function __construct() {  
    }
}
