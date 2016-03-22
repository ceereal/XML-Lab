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
            
            $bookingDays = $this->Timetable->getDay();
            $booking= "";
            foreach ($bookingDays as $perBooking){
                $booking .= (String)$perBooking;
            }
            
            $bookingTimes = $this->Timetable->getTime();
            foreach ($bookingTimes as $perBooking){
                $booking .=  (String)$perBooking;
            }
           
            $bookingCourses = $this->Timetable->getCourse();
            foreach ($bookingCourses as $perBooking){
                $booking .=  (String)$perBooking;
            }
            
            $this->data['bookings'] = $booking;
            $this->render();
            
            /*
            $options = array(
                array('option' => 'day'),
                array('option' => 'time'),
                array('option' => 'course'));
            
            $this->data['options'] = $options;
            $this->render();
             * 
             */
	}
        
        /*
        public function showTimetable($option) {
            $this->data['pagebody'] = 'timetablefmt';
            $timetable = new Timetable();
            switch($option) {
                
                case 'day':
                    foreach($timetable->getDays() as $list) {
                    $bookings = array(
                        'day' => $list->day,
                        'startTime' => $list->startTime,
                        'endTime' => $list->endTime,
                        'course' => $list->course,
                        'room' =>  $list->room,
                        'instructor' => $list->instructor,
                        'type' => $list->type);
                    }
                    break;
                    
                case 'time':
                    foreach($timetable->getTimes() as $list) {
                    $bookings = array(
                        'day' => $list->day,
                        'startTime' => $list->startTime,
                        'endTime' => $list->endTime,
                        'course' => $list->course,
                        'room' =>  $list->room,
                        'instructor' => $list->instructor,
                        'type' => $list->type);
                    }
                    break;
                    
                case 'course':
                    foreach($timetable->getCourses() as $list) {
                    $bookings = array(
                        'day' => $list->day,
                        'startTime' => $list->startTime,
                        'endTime' => $list->endTime,
                        'course' => $list->course,
                        'room' =>  $list->room,
                        'instructor' => $list->instructor,
                        'type' => $list->type);
                    }
                    break;
                default:
            }
         * 
         
         
            $this->data['bookings'] = $bookings;
            $this->render();
        }
         *
         */
}
