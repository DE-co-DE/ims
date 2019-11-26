<?php namespace App\Helpers;
use App\User;
use Auth;
use PDF;
use App\Student;
use App\StudentCourse;
use App\Course;
use App\Fee;
class Invoice {

    /**
     * Returns an excerpt from a given string (between 0 and passed limit variable).
     *
     * @param $string
     * @param int $limit
     * @param string $suffix
     * @return string
     */
    public static function generate($id,$sid)
    {
        $fee_ = Fee::find($id);
        $student = Student::find($sid);
        $amount_due=$fee_->amount_due;
        $course  = StudentCourse::where('student_id',$sid)->where('status',0)->first();
        PDF::setOutputMode('F'); // force to file

        return PDF::html('center.invoice',array('users' => $fee_));
            
        // $pdf = PDF::loadView('center.invoice');
        // return $pdf->download('invoice.pdf');
	
    }
}