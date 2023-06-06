<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CrmController extends Controller
{
    public function addtask(Request $request)
    {

        $task = new Task();
        $task->title = $request['tasktitle'];
        $task->note = $request['note'];
        $task->designation = $request['delegation'];
        $task->start_date = $request['start_date'];
        $task->end_date = $request['end_date'];
        $task->priority = $request['priority'];
        $task->status = "Pending";
        $task->save();

        //send email notification
        $mailduser = Admin::where('id', $request->delegation)->first();
        $message = "This is to inform you that a new task has been assigned to you, Task Title: $request->tasktitle, Start Date: $request->start_date, End Date: $request->end_date, please login to your account to see more.";
        $subject = "New Task: $request->tasktitle";
        Mail::to($mailduser->email)->send(new NewNotification($message, $subject, $mailduser->firstName));

        return redirect()->back()
            ->with('success', 'Task Successfully Created and Assigned!');
    }


    public function updatetask(Request $request)
    {

        Task::where('id', $request['id'])
            ->update([
                'title' => $request['tasktitle'],
                'note' => $request['note'],
                'designation' => $request['delegation'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'priority' => $request['priority'],
            ]);
        return redirect()->back()
            ->with('success', 'Action Successful!');
    }

    //Delete deposit
    public function deltask($id)
    {
        Task::where('id', $id)->delete();
        return redirect()->back()
            ->with('success', 'Task has been deleted!');
    }

    public function markdone($id)
    {
        Task::where('id', $id)
            ->update([
                'status' => "Completed",
            ]);
        return redirect()->back()
            ->with('success', 'Task has been Completed!');
    }

    //Delete deposit
    public function updateuser(Request $request)
    {
        User::where('id', $request->id)
            ->update([
                'userupdate' => $request->userupdate,
            ]);
        return redirect()->back()
            ->with('success', 'Status Updated!');
    }
    //Delete deposit
    public function convert($id)
    {
        User::where('id', $id)
            ->update([
                'cstatus' => "Customer",
            ]);
        return redirect()->back()
            ->with('success', 'User Converted successfully');
    }

    public function assign(Request $request)
    {
        User::where('id', $request['user_name'])
            ->update([
                'assign_to' => $request['admin'],
            ]);

        $mailduser = Admin::where('id', $request->admin)->first();
        //send email notification
        $name = "$mailduser->firstName $mailduser->lastName";
        $message = "This is to inform you that a user have been assigned to you, please login to your account for more info";
        $subject = "New User Assigned";

        Mail::to($mailduser->email)->send(new NewNotification($message, $subject, $name));
        return redirect()->back()->with('success', 'Successfully Assigned User to Admin');
    }
}