<?php

namespace App\Http\Controllers;

use DB;
use App\Jobs;
use App\Employee;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function sub(){

     

        $Employees=Employee::where('SALARY','<=', function($query){
               return  $query->select('Salary')
                        ->from('employees')
                        ->where('SALARY','=','2100.00')
                        ->get();
             
                        

        })->get();

        
        
       
    }

    public function question_5(){
        $avg_salary = Employee::where('SALARY','>',function($query){

            return $query->selectRaw('avg(SALARY)')->from('employees');
        })->get();

        dd($avg_salary);
    }

    public function question_6()
    {

       $min_salary = Jobs::with(['employees'])->get();

       foreach($min_salary as $min){

        

        foreach($min->employees as $m){

           

            if($m->SALARY = $min->MIN_SALARY){

                dump($m->FIRST_NAME);
            }
        }

       }
    }
    public function question_8()
    {
        $ID = Employee::whereIn('EMPLOYEE_ID',[134,159,183])->get();

        dd($ID);

    }
    public function question_9(){

        $range = Employee::whereBetween('SALARY',[1000,3000])->get();
        dd($range);

    }
    public function question_10(){

        $x = Employee::min('SALARY');
    
        $small = Employee::whereBetween('SALARY',[$x,2500])->get();

        dd($small);

        // $small_salary = Employee::whereBetween('SALARY',function($query){
        //         return $query->where('SALARY','<',2500)->where('SALARY','>',function($q2){
        //             return  $q2->min('SALARY');

        //         })->pluck()->get();

        // })->get();

        // dd($small_salary);   
    }
    public function datatable(){
        
        $employees = DB::table('employees')->take(10)->get();
        $total_data = DB::table('employees')->get()->count();
        $each_page_show = 10;
    
        return view('datatable',compact('employees','total_data','each_page_show'));
    }
    public function get_next_data(Request $request){

        if($request->ajax()){

            
            $row_count = ($request->rows) * 10;
            if($request->rows == 1){

                $index =1;
            }
            else{

                $index = ($row_count-10)+1;
            }
            $total_data = DB::table('employees')->get()->count();
           
           
            $employees = DB::table('employees')->skip($row_count-10)->limit(10)->get();

            // return response()->json([
            //     'data' => $next_data; 
            // ]);
    
            
            
            return response(
                [
                    'view' => view(
                        'renders.render_employee',
                        compact('employees','index')
                    )->render(),
                ],
                200
            );
    
    

        }    

    }
}
