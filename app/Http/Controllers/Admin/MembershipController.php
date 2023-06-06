<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\PingServer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    use PingServer;
    //
    public function showCourses(Request $request)
    {

        $response = $this->fetctApi('/courses', [
            'value' => $request->searchValue,
        ]);
        $info = json_decode($response);

        return view('admin.memebership.courses', [
            'courses' => $info->data->courses,
            'title' => 'Courses',
            'categories' => $info->data->categories,
        ]);
    }

    public function addCourse(Request $request)
    {

        // $request->image_url;
        if (empty($request->image_url) and !$request->hasfile('image')) {
            return redirect()->back()->with('message', 'Please choose a course image');
        }

        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            ]);
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        } else {
            $path = $request->image_url;
        }

        //check if the course is piad or not
        $paidCourse = $request->amount != '' ? true : false;

        $response = $this->fetctApi('/add-course', [
            'title' => $request->title,
            'amount' => $request->amount,
            'image_url' => $path,
            'paidCourses' => $paidCourse,
            'category' => $request->category,
            'desc' => $request->desc
        ], 'POST');

        //return $response;
        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }

    public function updateCourse(Request $request)
    {
        if ($request->image_url == '' and !$request->hasfile('image')) {
            return redirect()->back()->with('message', 'Please choose a course image');
        }

        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            ]);
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        } else {
            $path = $request->image_url;
        }

        //check if the course is piad or not
        $paidCourse = $request->amount != '' ? true : false;

        $response = $this->fetctApi('/update-course', [
            'course_id' => $request->course_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'image_url' => $path,
            'paidCourses' => $paidCourse,
            'category' => $request->category,
            'desc' => $request->desc
        ], 'POST');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }

    public function deleteCourse($coursId)
    {
        $res = $this->fetctApi('/course', [
            'courseId' => $coursId,
        ]);

        $info = json_decode($res);

        if (Storage::disk('public')->exists($info->data->course->id)) {
            Storage::disk('public')->delete($info->data->course->id);
        }

        $response = $this->fetctApi("/delete-course/$coursId", [], 'DEL');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }


    public function showLessons($id)
    {
        $response = $this->fetctApi("/courses-lessons/$id");
        $info = json_decode($response);
        //return $info;
        return view('admin.memebership.lessons', [
            'lessons' => $info->data->lessons->data,
            'course' => $info->data->course,
            'title' => 'Lessons'
        ]);
    }

    public function addLesson(Request $request)
    {
        if ($request->image_url == '' and !$request->hasfile('image')) {
            return redirect()->back()->with('message', 'Please choose a course image');
        }

        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            ]);
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        } else {
            $path = $request->image_url;
        }
        if ($request->has('category')) {
            $cat = $request->category;
        } else {
            $cat = null;
        }

        $response = $this->fetctApi('/add-lesson', [
            'title' => $request->title,
            'length' => $request->length,
            'videolink' => $request->videolink,
            'preview' => $request->preview,
            'course_id' => $request->course_id,
            'desc' => $request->desc,
            'cat' => $cat,
            'thumbnail' => $path
        ], 'POST');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }

    public function updateLesson(Request $request)
    {
        if ($request->image_url == '' and !$request->hasfile('image')) {
            return redirect()->back()->with('message', 'Please choose a course image');
        }

        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            ]);
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        } else {
            $path = $request->image_url;
        }

        if ($request->has('category')) {
            $cat = $request->category;
            $category = $request->category;
        } else {
            $cat = null;
            $category = null;
        }

        $response = $this->fetctApi('/update-lesson', [
            'lesson_id' => $request->lesson_id,
            'title' => $request->title,
            'length' => $request->length,
            'videolink' => $request->videolink,
            'preview' => $request->preview,
            'course_id' => $request->course_id,
            'desc' => $request->desc,
            'cat' => $cat,
            'course_category_id' =>  $category,
            'thumbnail' => $path
        ], 'POST');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }

    public function deleteLesson($lessonId)
    {
        $res = $this->fetctApi('/lesson', [
            'lessonId' => $lessonId,
        ]);

        $info = json_decode($res);

        if (Storage::disk('public')->exists($info->data->lesson->id)) {
            Storage::disk('public')->delete($info->data->lesson->id);
        }

        $response = $this->fetctApi("/delete-lesson/$lessonId", [], 'DEL');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }



    public function addCategory(Request $request)
    {
        $response = $this->fetctApi('/add-category', [
            'category' => $request->category,
        ], 'POST');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }

    public function deleteCategory($id)
    {
        $response = $this->fetctApi("/delete-cat/$id", [], 'DEL');

        $respond = $this->backWithResponse($response);
        return back()->with($respond['type'], $respond['message']);
    }


    public function category()
    {
        $response = $this->fetctApi('/categories');
        $info = json_decode($response);

        return view('admin.memebership.category', [
            'categories' => $info->data->categories,
            'title' => 'Course Category'
        ]);
    }


    public function lessonWithoutCourse(): View
    {
        $response = $this->fetctApi('/lessons-without-course');
        $info = json_decode($response);

        return view('admin.memebership.lessons-without', [
            'title' => 'Lessons without courses',
            'lessons' => $info->data->lessons,
            'categories' => $info->data->categories,
        ]);
    }
}