<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Faq;
use App\Models\Images;
use App\Models\Testimony;
use App\Models\Content;
use App\Models\TermsPrivacy;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function savefaq(Request $request){
        $String = $this->RandomStringGenerator(6);
        $faq=new Faq();
        $faq->ref_key = $String;
        $faq->question= $request['question'];
        $faq->answer= $request['answer'];
        $faq->save();
        return redirect()->back()->with('success', 'Faq Added Sucessfully!');
      }
  
    public function savetestimony(Request $request){
        $String = $this->RandomStringGenerator(6);
        $tes=new Testimony();
        $tes->name= $request['testifier'];
        $tes->ref_key = $String;
        $tes->position= $request['position'];
        $tes->what_is_said= $request['said'];
        $tes->picture= $request['picture'];
        $tes->save();
        return redirect()->back()->with('success', 'Testimony Added Sucessfully!');
    }
  
  
    public function saveimg(Request $request){

        $String = $this->RandomStringGenerator(6);
  
        $this->validate($request, [
          'image' => 'required|mimes:jpg,jpeg,png|image',
        ]);
        
        if($request->hasfile('image'))
        {
            $filef = $request->file('image');
            $path = $filef->store('photos','public');
        }
  
        $img=new Images();
        $img->title= $request['img_title'];
        $img->ref_key = $String;
        $img->description= $request['img_desc'];
        $img->img_path= $path;
        $img->save();
        return redirect()->back()->with('success', 'Image Added Sucessfully!');
    }
  
  
    public function savecontents(Request $request){
        $String = $this->RandomStringGenerator(6);
        $cont=new Content();
        $cont->title= $request['title'];
        $cont->ref_key = $String;
        $cont->description= $request['content'];
        $cont->save();
        return redirect()->back()->with('success', 'Contents Added Sucessfully!');
    }
  
    public function updatefaq(Request $request){
        Faq::where('id', $request['id'])
        ->update([
            'question' => $request['question'],
            'answer' => $request['answer'],
        ]);
        return redirect()->back()->with('success', 'Faq Update Sucessful!');
    }
  
    public function updatetestimony(Request $request){
        Testimony::where('id', $request['id'])
        ->update([
            'name'=>$request['testifier'],
            'position'=> $request['position'],
            'what_is_said'=> $request['said'],
            'picture'=> $request['picture'],
        ]);
        return redirect()->back()->with('success', 'Testimony Update Sucessful!');
    }
  
    public function updatecontents(Request $request){
        Content::where('id', $request['id'])
        ->update([
            'title'=> $request['title'],
            'description'=> $request['content'],
        ]);
        return redirect()->back()->with('success', 'Content Update Sucessful!');
    }
  
    public function updateimg(Request $request){
        $settings = Settings::where('id', '=', '1')->first();
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|image',
        ]);
    
        $imgs = Images::where('id', '=', $request->id)->first();
        $String = $this->RandomStringGenerator(6);

        if(empty($request->file('image'))){
            $filePathf=$imgs->img_path;
        }else{
            if($request->hasfile('image')){
                $filef = $request->file('image');
                if (Storage::disk('public')->exists($imgs->img_path)) {
                    Storage::disk('public')->delete($imgs->img_path);
                }
                $path = $filef->store('photos','public');
            }
        }

        Images::where('id', $request['id'])
        ->update([
            'title'=> $request['img_title'],
            'description'=> $request['img_desc'],
            'img_path'=> $path,
        ]);
        return redirect()->back()->with('success', 'Image Updated Sucessfully!');
    }
  
    public function delfaq($id){
        Faq::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Faq Sucessfully Deleted');
    }
  
    public function deltest($id){
        Testimony::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Testimonial Sucessfully Deleted');
    }
    // for front end content management
    function RandomStringGenerator($n) 
    { 
        $generated_string = ""; 
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
        $len = strlen($domain); 
        for ($i = 0; $i < $n; $i++) 
        { 
            $index = rand(0, $len - 1); 
            $generated_string = $generated_string . $domain[$index]; 
        } 
        // Return the random generated string 
        return $generated_string; 
    } 

    public function termspolicy(){
        
        return view('admin.Settings.FrontendSettings.privacy', [
            'title' => "Privacy Policy",
            'terms' => TermsPrivacy::find(1),
        ]);
    }

    public function savetermspolicy(Request $request){
        $terms = TermsPrivacy::find(1);

        $terms->description = $request->termsprivacy;
        $terms->useterms = $request->terms;
        $terms->save();
        return redirect()->back()
        ->with('success', 'Terms and Privacy Policy Updated Successfully!');
    }










}
