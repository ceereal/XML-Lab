<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
            parent::__construct();
            $this->load->model('Timetable');
        }
        
	public function index()
	{
            $this->load->helper('directory');
            $this->data['pagebody'] = 'homepage';
            $timetable = new Timetable();
            
            //$dayCodes = $timetable->getDayCodes();
           // $timeCodes = $timetable->getTimeslots();
            
            $this->data['title'] = "ACIT4850 XML Lab";

            
            
            $this->showTimetable();
            
	}
        
        public function showTimetable() {
            $this->data['pagebody'] = 'homepage';
            $timetable = new Timetable();
            $bookings;
                    foreach($timetable->getDay() as $list) {
                    $bookings = array(
                        'day' => $list->day,
                        'startTime' => $list->startTime,
                        'endTime' => $list->endTime,
                        'course' => $list->course,
                        'room' =>  $list->room,
                        'instructor' => $list->instructor,
                        'type' => $list->type);
                    }

            $this->data['bookings'] = $bookings;
            $this->render();
        }
}
