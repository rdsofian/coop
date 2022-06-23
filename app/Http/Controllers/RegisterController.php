<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function create()
    {
        $faculties = Faculty::orderBy('name')->get();
        return view('auth.register', compact('faculties'));
    }
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'faculty_id' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
            ]);

            if ($validator->fails()){
                return redirect()->route('register')->withErrors($validator)->withInput();
            }

            $student = Student::where('code', $request->code)->first();

            if ($student) {
                if ($student->user_id) {
                return redirect()->route('register')->with('error','Anda sudah memiliki akun!');
                }
                // $role = Role::where('name', 'like', '%student%')->first();
                $user = new User();
                $user->name = $student->code;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                $user->assignRole('student');
                $student->faculty_id = $request->faculty_id;
                $student->user_id = $user->id;
                $student->save();

                DB::commit();
                return redirect()->route('register')->with('success','Pendaftaran Berhasil!');
            } else {
                DB::rollBack();
                return redirect()->route('register')->with('error','NRP Tidak Terdaftar');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('register', $request->id)->withErrors($e)->withInput();
            // something went wrong
        }


    }
}
