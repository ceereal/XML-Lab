<?php

class Timetable extends CI_Model {

    protected $xml = null;
    protected $days = array();
    protected $times = array();
    protected $courses = array();

    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'courseData' . XMLSUFFIX);

        //loop though all days bookings
        //create a new empty booking
        //apply current loops info to temp booking
        //add the temp booking to the $day array
        foreach ($this->xml->day as $day) {
            $tempBooking = new Booking();
            $tempBooking->day = $day['day'];

            foreach ($day->time as $time) {
                $tempBooking->startTime = $time['startTime'];
                $tempBooking->course = $time->booking->course;
                $tempBooking->room = $time->booking->room;
                $tempBooking->instructor = $time->booking->instructor;
                $tempBooking->type = $time->booking->type;
                $tempBooking->endTime = $time->booking->endTime;
                $this->days[]=$tempBooking;
            }
        }
        
        foreach ($this->xml->time as $time) {
            $tempBooking = new Booking();
            $tempBooking->startTime = $time['startTime'];

            foreach ($time->day as $day) {
                $tempBooking->day = $day['day'];
                $tempBooking->course = $day->booking->course;
                $tempBooking->room = $day->booking->room;
                $tempBooking->instructor = $day->booking->instructor;
                $tempBooking->type = $day->booking->type;
                $tempBooking->endTime = $day->booking->endTime;
                $this->times[]=$tempBooking;
            }
        }
        
        foreach ($this->xml->course as $course) {
            $tempBooking = new Booking();
            $tempBooking->course = $course['course'];

            foreach ($course->day as $day) {
                $tempBooking->day = $day['day'];
                $tempBooking->startTime = $day->booking->startTime;
                $tempBooking->room = $day->booking->room;
                $tempBooking->instructor = $day->booking->instructor;
                $tempBooking->type = $day->booking->type;
                $tempBooking->endTime = $day->booking->endTime;
                $this->courses[]=$tempBooking;
            }
        }
    }

}

class Booking {

    public $day;
    public $startTime;
    public $endTime;
    public $course;
    public $room;
    public $instructor;
    public $type;

    public function __contruct() {
        
    }

}
