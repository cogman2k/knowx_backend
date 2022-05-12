<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Message;
use App\Models\UserFollow;
use App\Models\Mentor;
use App\Models\Education;
use App\Models\Experience;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public $email;

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            "phone" => "required|min:10|regex:/^[0]{1}/"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => $request->first_name ." ".$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]); 
        event(new Registered($user));
        return response()->json(["status" => "success", "error" => false, "message" => "Success! User registered."], 201);
    }

    //admin
    public function addUser(Request $request) {

        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            "phone" => "required|min:10|regex:/^[0]{1}/",
            "role" => "required",
            "gender" => "required",
            "address" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $avatar = "";

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/user/', $filename);
            $avatar = 'uploads/user/'.$filename;
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => $request->first_name ." ".$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            // 'role' => $request->role,
            // 'address' => $request->address,
            // 'image' => $avatar
        ]);
        $user['role'] = $request->role;
        $user['address'] = $request->address;
        $user['image'] = $avatar;
        $user->save();

        // event(new Registered($user));
        return response()->json(["status" => "success", "error" => false, "message" => "Success! added new user."], 201);
    }

    /**
     * User Login
     *
     * @param Request $request
     * @return void
     */
    public function setSession(){
        Session::put('name', 'huyasdas');
        return view('livewire.messages');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:3"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $email = $request->email;
                $user = Auth::user();
                $token = $user->createToken('token')->accessToken;
                return response()->json(
                    [
                        "status" => "success",
                        "error" => false,
                        "user_id" => Auth::user()->id,
                        "role" => Auth::user()->role,
                        "message" => "Success! you are logged in.",
                        "token" => $token,
                        "email" => User::where('email', $email)->first(),
                        "avatar" => Auth::user()->image
                    ]
                );
            }
            return response()->json(["status" => "failed", "message" => "Login failed! Invalid email or password."], 404);
        }
        catch(Exception $e) {
            return response()->json(["status" => "failed", "message" => $e->getMessage()], 404);
        }
    }

    /**
     * Logged User Data Using Auth Token
     *
     * @return void
     */
    public function user() {
        try {
            $user = Auth::user();
            return response()->json(["status" => "success", "error" => false, "data" => $user], 200);
        }
        catch(NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    } 

    //change password
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            "old_password" => "required",
            "new_password" => [
                "required", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            "confirm_password" => "required|same:new_password"
        ]);
        if($validator->fails()){
            return $this->validationErrors($validator->errors());
        }
        $user=auth()->user();
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Password successfully updated',
            ],200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Old password does not matched',
            ],200);
        }
    }



    //update profile
    public function updateProfile(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            // "image" => "required",
            "first_name" => "required",
            "phone" => "required",
            "last_name" => "required",
            "gender" => "required",
            "email" => "required|email",
            "birthday" => "required",
            "topic" => "required",
            "description" => "required"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };

        
        $user['first_name'] = $request->first_name;
        $user['last_name'] = $request->last_name;
        $user['full_name'] = $request->first_name." ".$request->last_name;
        $user['phone'] = $request->phone;
        $user['gender'] = $request->gender;
        $user['birthday'] = $request->birthday;
        $user['topic'] = $request->topic;
        $user['description'] = $request->description;
        $user['email'] = $request->email;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/user/', $filename);
            $user['image'] = 'uploads/user/'.$filename;
        }
           
        $user->save();
    
        return response()->json(["status" => "success", "error" => false, "message" => "Success! Your profile updated.","data"=>$user], 201);
    }

    /**
    * Logout Auth User
    *
    * @param Request $request
    * @return void
    */
    public function logout() {
        if(Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! You are logged out."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! You are already logged out."], 403);
    }

    public function verified(){
        return view('verified');
    }

    //get all users
    public function getAllUsers(){
        $list = DB::table('users')->where('id','!=',Auth::user()->id)->get();
        if($list){
            return response()->json(["status" => "success", "error" => false, "data" => $list], 200); 
        }      
        return response()->json(["status" => "failed", "message" => "Failed! Nothing response!"], 403);
    }

    //get user by id
    public function getUserById(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };
        
        try {
            $users = User::all();
            return response()->json(["status" => "success", "error" => false, "data" => $users->find($request->id)], 200);
        }
        catch(NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

    //follow other users
    public function followUser(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            "target_user_id" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };

        $data = DB::table('user_follows')
        ->where('user_id','=', Auth::user()->id)
        ->where('target_user_id','=', $request->target_user_id)->get();

        if(count($data)>0){
            DB::table('user_follows')
            ->where('user_id','=', Auth::user()->id)
            ->where('target_user_id','=', $request->target_user_id)->delete();
            return response()->json(["status" => "success", "type"=>"unfollow", "error" => false, "message" => "Success! deleted."], 201);
        }
        
        UserFollow::create([
            'user_id' => $user->id,
            'target_user_id' => $request->target_user_id,
        ]);
            
        return response()->json(["status" => "success", "type"=>"follow", "error" => false, "messages"=>"follow successfully!"], 404);

    }

    //get list fillowing users
    public function getListFollowingUsers(){
        $listFollow = [];
        $list = DB::table('user_follows')->select('target_user_id')->where('user_id', Auth::user()->id)->get();
        for($i=0;$i<count($list);$i++){
            $listFollow[$i] = User::all()->find($list[$i]->target_user_id);
        }
        if(count($list)==0){
            return response()->json(["status"=>"failed","Nothing following users!"]);
        }
        return response()->json(["status" => "success", "error" => false, "data" => $listFollow, "count" => count($listFollow)]);
    }

    //get list followers
    public function getListFollowers(){
        $listFollowers = [];
        $list = DB::table('user_follows')->select('user_id')->where('target_user_id', Auth::user()->id)->get();
        for($i=0;$i<count($list);$i++){
            $listFollowers[$i] = User::all()->find($list[$i]->user_id);
        }
        if(count($list)==0){
            return response()->json(["status"=>"failed","Nothing followers!"]);
        }
        return response()->json(["status" => "success", "error" => false, "data" => $listFollowers, "count" => count($listFollowers)]);
    }

    public function checkFollow(Request $request){
        $user = Auth::user()->userFollows;
        $result = $user->where('target_user_id', '==' , $request->target_user_id);
        if(count($result) > 0){
            return response()->json(["status" => "followed", "error" => false], 200);
        }
        return response()->json(["status" => "follow", "error" => false], 200);
    }

    public function search(Request $request){
        try {
            $user = User::where('full_name','like','%'.$request->data.'%')
            ->orWhere('topic','like','%'.$request->data.'%')
            ->get();
            return response()->json(["status" => "success", "error" => false, "data" => $user, "count" => count($user)], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

    public function count(Request $request){
        $company = User::where('role','=','company')->get();
        $student = User::where('role','=','student')->get();
        $admin = User::where('role','=','admin')->get();
        $mentor = DB::table('mentors')
                    ->select('user_id')
                    ->distinct()
                    ->get();
        return response()->json(["status" => "success", "error" => false, "company" => count($company), 
        "student" => count($student), "admin" => count($admin), "mentor" => count($mentor)], 200);
    }

    //get all users without company
    public function getUsers(){
        $students = User::where('role','!=','company')->get();
        for($i=0;$i<count($students);$i++){
            $isMentor = Mentor::where("user_id", $students[$i]->id)->get();
            if(count($isMentor) > 0){
                $students[$i]->{'isMentor'} = true;
            }
            else{
                $students[$i]->{'isMentor'} = false;
            }
        }
        return response()->json(["status" => "success", "error" => false, "data" => $students], 200);
    }

    //get all companies
    public function getCompanies(Request $request){
        $companies = User::where('role', '=', 'company')->get();
        return response()->json(["status" => "success", "error" => false, "data" => $companies], 201);
    }

    //delete user
    public function deleteUser($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! user deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no user found."], 404);
    }

    public function getEducation($id){
        $education = Education::where("user_id", "=", $id)->get();
        if(count($education) > 0) {
            return response()->json(["status" => "success", "error" => false, "message" => "Success! get all education succesfully.", "data"=>$education], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no education found."], 404);
    }

    public function getExperience($id){
        $experience = Experience::where("user_id", "=",$id)->get();
        if(count($experience) > 0) {
            return response()->json(["status" => "success", "error" => false, "message" => "Success! get all expericence succesfully.", "data"=>$experience], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no expericence found."], 404);
    }

    public function addEducation(Request $request){
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $education = Education::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $education['user_id'] = Auth::user()->id;
        $education->save();
        return response()->json(["status" => "success", "error" => false, "message" => "Success! Added new education."], 201);
    }

    public function addExperience(Request $request){
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $experience = Experience::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $experience['user_id'] = Auth::user()->id;
        $experience->save();
        return response()->json(["status" => "success", "error" => false, "message" => "Success! Added new experience."], 201);
    }

    public function removeEducation($id){
        $education = Education::find($id);
        if($education) {
            $education->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! education deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no education found."], 404); 
    }

    public function removeExperience($id){
        $experience = Experience::find($id);
        if($experience) {
            $experience->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! experience deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no experience found."], 404); 
    }
}