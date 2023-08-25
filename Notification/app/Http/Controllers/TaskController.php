<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Message;
use Auth;
use Pusher\pusher;

class TaskController extends Controller
{
    public function save_task(Request $request){
        // Créez une nouvelle instance de Task
        $task = new Task;
        $task->title = $request['title'];
        $task->description = $request['description'];
        $title = $request->title;
        // $task = new Task;
        // $task->title = $request->input('title'); // Utilisez input() pour obtenir la valeur du champ 'title'
        // $task->description = $request->input('description'); // Utilisez input() pour obtenir la valeur du champ 'description'

        // Créez une nouvelle instance de Message
        $message = new Message;
        $message->from = Auth::user()->id;

        $id = $message->from;
        $message ->message = $title;
        $message->save(); 
        // $message->message = $request->input('title'); // Utilisez input() pour obtenir la valeur du champ 'title'
        // $message->save(); 

        $options = [
            'cluster'=>'eu',
            'useTLS' =>true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from'=>$id];
        $pusher->trigger('my-channel','my-event',$data);

        if($task->save()){ // Utilisez $task au lieu de task
            return response()->json([
                'status'=>true,
                'message'=>'Task added successfully' // Correction de la faute de frappe "Taske" à "Task"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'message'=>'Failed to add Task'
            ]);
        }
    }
}
