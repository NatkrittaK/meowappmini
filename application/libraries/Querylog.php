<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Querylog {
    protected $CI;

    public function __construct() {        
        $this->CI =& get_instance();
        
    }

    function save_query_in_db() {
        $query = $this->CI->db->last_query();
        $times = $this->CI->db->query_times; 
        $time = round(doubleval($times[2]), 5);
        
        
        
          
                $filepath = APPPATH . 'logs/QueryLog-' . date('Y-m-d') . '.php'; // Filepath. File is created in logs folder with name QueryLog
                $handle = fopen($filepath, "a+"); // Open the file
        
                $times = $this->CI->db->query_times; // We get the array of execution time of each query that got executed by our application(controller)
                
                foreach ($this->CI->db->queries as $key => $query) { // Loop over all the queries  that are stored in db->queries array
                    $sql = $query . " \n Execution Time:" . $times[$key]; // Write it along with the execution time
                    fwrite($handle, $sql . "\n\n");
                }
               
                
        
                fclose($handle); // Close the file
               return TRUE;
          }
         
      
       
 
}