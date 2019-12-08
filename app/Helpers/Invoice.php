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
       //dd($fee_);
        $amount_due=$fee_->amount_due;
        $course_s  = StudentCourse::where('student_id',$sid)->where('status',0)->first();
        $course= Course::find($course_s->course_id);
        //dd($fee_);
        $pdf = PDF::loadView('center.invoice',compact('fee_','student','course'));
        $naration= str_replace("#","_",$fee_->naration);

        $name=$student->first_name.$student->id.'_'.$naration.'_filename.pdf';
        $filename=public_path().'/pdfs/'.$name;
        $pdf->save($filename);
        return $name;

	
    }
}