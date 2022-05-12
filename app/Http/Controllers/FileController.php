<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function create(Request $request){
        $file = new File();
                if($request->hasFile('document')){
                    $tmp = $request->file('document');
                    $extension = $tmp->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $tmp->move('uploads/documents', $filename);
                    $file->url = 'uploads/documents/'.$filename;
                }

                $file->file_name = $request->file_name;
             $file->subject_id = $request->subject_id;
                
                $file->user_id = Auth::user()->id;
                if($request->class_id){
                    $file->class_id = $request->class_id;
                }
                $file->save();
        return response()->json(["status" => "success", "error" => false, "message" => "Upload successfully!"]);
    }

    public function getFile(Request $request){
        
        // var_dump(File::where("subject_id", $request->subject_id)->get());
        $files = [];
        if($request->subject_id){

            $files = File::where("subject_id", $request->subject_id)->get();

            for( $i=0 ; $i < count($files); $i++){
                $user = User::where('id',$files[$i]->user_id)->get();
                $subject = Subject::where('id', $files[$i]->subject_id)->get();
                $files[$i]->{'full_name'} = $user[0]->full_name;
                $files[$i]->{'user_image'} = $user[0]->image;
                $files[$i]->{'subject_name'} = $subject[0]->name;
            }

            return response()->json(["status" => "success", "error" => false, "data" => $files, 
            "count" => count(File::where("subject_id", $request->subject_id)->get())]);
        }
            // $files = DB::table('files')->orderBy('created_at','desc')->get();
            $files = File::where('subject_id', '!=', "none")->orderBy('created_at','desc')->get();
            // $files = File::all();
            for( $i=0 ; $i < count($files); $i++){
                $user = User::where('id',$files[$i]->user_id)->get();
                $subject = Subject::where('id', $files[$i]->subject_id)->get();
                $files[$i]->{'full_name'} = $user[0]->full_name;
                $files[$i]->{'user_image'} = $user[0]->image;
                $files[$i]->{'subject_name'} = $subject[0]->name;
            }

        return response()->json(["status" => "success", "error" => false, "data" => $files, "count" => count($files)]);
    }

    public function getFileByClass(Request $request){
            $files = File::where('class_id', $request->class_id)->orderBy('created_at','desc')->get();
            // $files = File::all();
            for( $i=0 ; $i < count($files); $i++){
                $user = User::where('id',$files[$i]->user_id)->get();
                $subject = Subject::where('id', $files[$i]->subject_id)->get();
                $files[$i]->{'full_name'} = $user[0]->full_name;
                $files[$i]->{'user_image'} = $user[0]->image;
                $files[$i]->{'subject_name'} = $subject[0]->name;
            }

        return response()->json(["status" => "success", "error" => false, "data" => $files, "count" => count($files)]);
    }

    public function removeFile(Request $request){
        $file = File::find($request->id)->delete();
        if($file){
            return response()->json(["status" => "success", "error" => false], 200);
        }
        return response()->json(["status" => "failed", "error" => false], 200);
    }
}
