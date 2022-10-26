<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class TodoController extends Controller
{

    public function getAll(){
        $todos = Todo::all()->sortByDesc('created_at');
        return response()->json($todos);
    }

    public function index()
    {
        $todos = Todo::where('date', '<' , strtotime('last day of this month'))->get();
        $today = strtotime('now');
        $tomorrow = strtotime('+1 days');
        $this_month = strtotime('this month');
        $today_todos = [];
        $tomorrow_todos = [];
        $this_month_todos = [];
        foreach($todos as $todo){
            if((int)date('d',$todo->date) == (int)date('d', $today)){
                
                array_push($today_todos, $todo);
            }else if((int)date('d', $todo->date) == (int)date('d', $tomorrow)){
                array_push($tomorrow_todos, $todo);
            }
            else if((int)date('d', $todo->date) > (int)date('d', $tomorrow) && date('m', $todo->date) == date('m', $this_month)) {
                    array_push($this_month_todos, $todo);
                }
            $todo->time = date('H:i', $todo->time);
            $todo->date = date('Y-m-d', $todo->date);
        }

        $data = [
            [
                'id' => 'today',
                'label' => "Today",
                'data' => $today_todos,
            ],
            [
                'id' => 'tomorrow',
                'label' => "Tomorrow",
                'data' => $tomorrow_todos,
            ],
            [
                'id' => 'this-month',
                'label' => "This Month",
                'data' => $this_month_todos,
            ],
        ];

        return response()->json([
            'data' => $data,
            'statusCode' => 200,
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'statusCode' => 400,
                'success' => false,
                'message' => $validator->errors()
            ]);
        }
        $date_data = $request->date;
        $time_data = $request->time;
        if(!isset($date_data)){
            $date_data = date('Y-m-d');
        }
        if(!isset($time_data)){
            $time_data = date('H:i');
        }
        $date = strtotime($date_data);
        $time = strtotime($time_data);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $date,
            'time' => $time,
            'status' => 'UNCOMPLETED'
        ];
        $todo = Todo::create($data);

        return response()->json([
            'statusCode' => 200,
            'success' => true,
            'data' => $todo,
            'message' => 'Todo has been added successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //
        $todo = Todo::find($id);

        if(!$todo){
            return response()->json([
                'todo'
            ]);
        }
        $data = $request->all();
        if(isset($data['date'])){
            $data['date'] = strtotime($data['date']);
        }
        if(isset($data['time'])){
            $data['time'] = strtotime($data['time']);
        }

        $todo->fill($data);
        $todo->save();

        return response()->json([
            'statusCode' => 200,
            'succces' => true,
            'data' => $todo,
            'message' => 'Todo has been updated successfully'
        ]);
    }
    public function show($id){
        $todo = Todo::find($id);

        if(!$todo){
            return response()->json([
                'statusCode' => 400,
                'success' => false,
                'message' => 'No Todo is Found'
            ], 400);
        }
        return response()->json([
            'statusCode' => 200,
            'data' => $todo
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = Todo::find($id);

        if(!$todo){
            return response()->json([
                'statusCode' => 400,
                'success' => false,
                'message' => 'No Todo is Found'
            ], 400);
        }

        $todo->delete();

        return response()->json([
            'statusCode' => 200,
            'succces' => true,
            'message' => 'Todo has been deleted successfully'
        ]);
    }
}
