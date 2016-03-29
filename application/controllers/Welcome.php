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

            //$this->showTimetable(); //Lab8 incomplete function
            
            //Code for Lab 9 XML Validation
            
            //load the documents, all our XML is in one doc
            $xml = new DOMDocument();
            $xml->load(DATAPATH . "courseData" . XMLSUFFIX);
            $schema = DATAPATH . 'schema.xsd';
            
            $validation = "<div>";
            libxml_use_internal_errors(true);
            
            if ($xml->schemaValidate($schema)) {
                $validation .= "XML data validates properly.";
            } else {
                $errors = libxml_get_errors();
                foreach ($errors as $error){
                    $validation .= "XML data failed to validate. Error: \"$error->message\" $error->level at line $error->line on column $error->column <br/>";
                }
                
            }
            libxml_clear_errors();
            
            $validation .= "<div>";
            $this->data['validation'] = $validation;
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
