<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\User;
use App\HistoryLogs;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::where('role','0')->get()->all();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'mobileno' => $data['mobileno'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function UpdateUser(array $data, $id){
        return User::where('id',$id)->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'mobileno' => $data['mobileno'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){
        $result = $this->create($request->all());
        return $result;
    }

    public function logout(Request $request){
        if(Auth::user()->role == 0){
            HistoryLogs::where('user_id', Auth::user()->id)
            ->orderby('id', 'desc')
            ->take(1)
            ->update([
                'last_logout_at' => Carbon::createFromFormat('Y-m-d H:i:s', now())->setTimezone('Asia/Singapore')
                ]);
        }
        Auth::logout();
        return redirect('/');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $result = $this->UpdateUser($request->all(),$request->id);
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = User::where('id',$id)->delete();
        return 'Deleted';
    }
}
