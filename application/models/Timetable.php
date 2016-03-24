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
        foreach ($this->xml->day as $currentDay) {
     
            
            //loops information into temp booking
            foreach ($currentDay->booking as $booking) {
                
                $tempBooking = new Booking();
                $tempBooking->day = $currentDay['day']->__toString();
                $tempBooking->course = $booking->course;
                $tempBooking->room = $booking->room;
                $tempBooking->instructor = $booking->instructor;
                $tempBooking->type = $booking->type;
                $tempBooking->startTime = $booking->startTime;
                $tempBooking->endTime = $booking->endTime;
                $this->days[] = $tempBooking; //add the temp booking to the $days array
            }
        }
        
        //loops through all the booking times
        foreach ($this->xml->time as $time) {
            //loops information into temp booking 
            foreach ($time->booking as $booking) {
                $tempBooking = new Booking();
                $tempBooking->startTime = $time['startTime']->__toString();
                $tempBooking->day = $booking->day;
                $tempBooking->course = $booking->course;
                $tempBooking->room = $booking->room;
                $tempBooking->instructor = $booking->instructor;
                $tempBooking->type = $booking->type;
                $tempBooking->endTime = $booking->endTime;
                $this->times[] = $tempBooking; //add the temp booking into the $times array 
            }
        }
        
        //loops through all the booking courses 
        foreach ($this->xml->course as $course) {
            //loops information into temp booking 
            foreach ($course->booking as $booking) {
                $tempBooking = new Booking();
                $tempBooking->course = $course['course']->__toString();
                $tempBooking->day = $booking->day;
                $tempBooking->startTime = $booking->startTime;
                $tempBooking->room = $booking->room;
                $tempBooking->instructor = $booking->instructor;
                $tempBooking->type = $booking->type;
                $tempBooking->endTime = $booking->endTime;
                $this->courses[] = $tempBooking; //add the temp booking into the $courses array
            }
        }
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

    public $day;
    public $startTime;
    public $endTime;
    public $course;
    public $room;
    public $instructor;
    public $type;

    public function __construct() {  
    }
}
