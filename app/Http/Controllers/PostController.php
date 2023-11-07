<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class PostController extends Controller
{
    //customer create page
    public function create(){
        $posts = Post::when(request('searchKey'),function($query){
                 $key = request('searchKey');
                 $query->orWhere('title','like','%'.$key.'%')
                       ->orWhere('description','like','%'.$key.'%');
        })
                 ->orderBy('created_at','desc')
                 ->paginate(2);

        return view('create',compact('posts'));
    }

    // post create
    public function postCreate(Request $request){
       $this->postValidationCheck($request);

       $data = $this->getPostData($request);//Array

       if($request->file('postImage')){
        $fileName = uniqid().'_'. $request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public',$fileName);
         $data["image"] = $fileName;
    };


         Post::create($data);
        return redirect()->route('post#createPage')->with(['insertSuccess' => 'Post Created']);
    }

    // post delete
    public function postDelete($id){
        //first way
        // Post::where('id',$id)->delete();

        //second way
        $post = Post::find($id)->delete();

        return back();
    }

    //Direct update page
    public function updatePage($id){
         $post= Post::where('id',$id)->first();
         return view('update',compact('post'));
    }

    //edit page
    public function editPage($id){
        $post= Post::where('id',$id)->first()->toArray();
        return view('edit',compact('post'));

    }

     //update post
    public function update(Request $request ){

     $this->postValidationCheck($request);
     $updateData = $this->getPostData($request);
     $id = $request->postId;

     if($request->file('postImage')){

        //delete image file
         $oldImageName = Post::select('image')->where('id',$request->postId)->first()->toArray();
           $oldImageName = $oldImageName['image'];

         if($oldImageName != null){
             Storage::delete('public/'.$oldImageName);
         }

        $fileName = uniqid().'_'. $request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public',$fileName);
         $updateData["image"] = $fileName;
    };

     Post::where('id',$id )->update($updateData);
     return redirect()->route('post#createPage')->with(['updateSuccess' => 'Post Updated']);

    }


    //post validation check
    private function postValidationCheck($request){

        $vadilationRules = [
            'postTitle'=> 'required|min:5|unique:posts,title,'.$request->postId,
            "postDescription"=> "required|min:5",
            "postQuote"=> "required",
            "postImage"=> "required",
            "postImage"=> "mimes:jpg,png,jpeg,gif"
        ];
        $vadilationMessage = [
            "postTitle.required" => "Please Fill Post Title!",
            "postTitle.min" => "Title Must Be At Least 5 Characters!",
            "postTitle.unique" => "Title Already Taken!",
            "postDescription" => "Please Fill Post Description!",
            "postDescription.min" => "Description Must Be At Least 5 Characters!",
            "postQuote" => "Please Fill Post Quote!",
            "postImage.mimes" => "jpg,png,jpeg,gif only",

        ];


       Validator::make($request->all(),$vadilationRules,$vadilationMessage)->validate();
    }

    //get post data
    private function getPostData($request){
       return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'quote' => $request->postQuote,
         ];



    }
}
