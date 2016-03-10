<?php

class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $days = array();
    protected $times = array();
    protected $courses = array();
}


class Booking {
    
    public $day;
    public $startTime;
    public $endTime;
    public $course;
    public $room;
    public $instructor;
    public $type;
    
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'courseData' . XMLSUFFIX);
        
        foreach ($this->xml->days->day as $day) {
            $record = new stdClass();
            $record->
        }
        
        
    }
}

