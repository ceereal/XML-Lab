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

            
            //$dayCodes = $timetable->getDayCodes();
           // $timeCodes = $timetable->getTimeslots();
            
            $this->data['title'] = "ACIT4850 XML Lab";

            $this->showTimetable();
            $this->render();
	}
        
        public function showTimetable() {
            
            $timetable = new Timetable();
            
            foreach ($timetable->getCourse() as $bookings) {
                $display[] = array(
                    'day' => $bookings->day,
                    'course' => $bookings->course,
                    'room' => $bookings->room,
                    'instructor' => $bookings->instructor,
                    'type' => $bookings->type,
                    'startTime' => $bookings->startTime,
                    'endTime' => $bookings->endTime
                );
            }
            $this->data['bookings'] = $display;
            
        }
}
