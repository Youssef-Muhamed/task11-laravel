<?php

namespace App\Http\Controllers;
use App\Models\student;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\File;

class studentController extends Controller
{
    public function index(){
        $data =   student::get();

        return view('Users.index',['data' => $data]);
//        if(auth()->check()){
//
//
//
//        }else{
//            return redirect(url('/Login'));
//        }

    }


    public function create(){

        return view('Users.create');
    }


    public function store(Request $request){

        # Validate Data .....
        $data =   $this->validate($request,[
            "name"     => "required|min:3",
            "email"    => "required|email",
            "password" => "required|min:6|max:15",
            'file'     => 'mimes:pdf'
        ]);
        $file_extention = $request->file->getClientOriginalExtension();
        $file_name = time().'.'.$file_extention;
        $path = "files";
        $request->file->move($path,$file_name);

        $data['password'] =  bcrypt($data['password']);

        $op =   student::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => $request->password,
            'file'     => $file_name
        ]);

        if($op){
            $message = "Raw Inserted .";
        }else{
            $message = 'Error Try Again !';
        }


        session()->flash('Message',$message);
        return redirect(url('/Users'));

    }

    public function edit($id){
        // code .....


        $data = student::find($id);


        return view('Users.edit',['data' => $data]);
    }

    public function update(Request $request){
        // code ......

        # Validate Data .....
          $this->validate($request,[
            "name"     => "required|min:3",
            "email"    => "required|email",
            'file'     => 'mimes:pdf',
            "id"       => "required|numeric"
        ]);


        $data = student::find($request->id);
        $file_name = $data->file;
        $path = 'files/'.$file_name;
        if($request->hasFile('file')){
            unlink($path);
            $file_extention = $request->file->getClientOriginalExtension();
            $file_name = time().'.'.$file_extention;
            $path = "files";
            $request->file->move($path,$file_name);
        }else {
            $data->file = $request->old_file;
        }

        $op =   student::where('id',$request->id)->update([
            "name"     => $request->name,
            "email"    => $request->email,
            'file'     => $file_name
        ]);

        if($op){
            $message = "Raw Updated";
        }else{
            $message = "Error Try Again";
        }

        session()->flash('Message',$message);

        return redirect(url('/Users'));

    }

    // delete item .....

    public function destroy($id){
        // code ....
        $data = student::find($id);
        $file_name = $data->file;
        $path = 'files/'.$file_name;
        unlink($path);
        $op  =  student::where('id',$id)->delete();

        if($op){
            $message = "Raw Removed";
        }else{
            $message = "Error Try Again";
        }
        session()->flash('Message',$message);
        return redirect(url('/Users'));
    }


    # Auth .....


//    public function Login(){
//        return view('Users.login');
//    }
//
//
//
//    public function DoLogin(Request $request){
//        // logic .....
//
//        $data = $this->validate($request,[
//            "email"    => "required|email",
//            "password" => "required|min:6"
//        ]);
//
//
//        if(auth()->attempt($data)){
//            return redirect(url('/Users'));
//        }else{
//            return redirect('/Login');
//        }
//
//    }
//
//
//
//    public function logout(){
//        auth()->logout();
//        return redirect(url('/Login'));
//    }

}
