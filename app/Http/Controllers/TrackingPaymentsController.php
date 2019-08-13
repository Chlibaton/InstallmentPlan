<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\TrackingPayments;
use App\Tracking;

class TrackingPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $result = TrackingPayments::where('tracking_id',$id)->get()->all();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->upload_pic !== null) {
            $exploded = explode(',',$request->upload_pic);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg'))
            {
                $extension = 'jpg';
            }
            else
            {
                $extension = 'png';
            }

            if(TrackingPayments::where('upload_pic', $request->upload_pic)->exists())
                $result = false;
            else {
                //generate random strings
                $length= 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                // set all details
                $filename = $randomString.'.'.$extension;
                $path = public_path().'/img/pay_rcpt/'.$filename;
                file_put_contents($path,$decoded);    
                $result = TrackingPayments::create($request->except('upload_pic') + ['upload_pic' => $filename]);
            }
        }
        else {
            $result = TrackingPayments::create($request->all());
        }
        return $result;
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
        $result = TrackingPayments::where('id', $request->id)->update($request->all());
        return $request->all();
    }
    
    public function updatebalance(Request $request,$id){
        switch($id){
            case'1':
            Tracking::where('id', $request->tracking_id)
            ->orderby('id', 'desc')
            ->take(1)
            ->update([
                'pre_balance' =>$request->balance,
                ]);
            break;

            case '2':
            Tracking::where('id', $request->tracking_id)
            ->orderby('id', 'desc')
            ->take(1)
            ->update([
                'balance' =>$request->balance,
                'payment_percent' =>$request->payment_percent,
                ]);
            TrackingPayments::where('id', $request->id)
            ->orderby('id', 'desc')
            ->take(1)
            ->update([
                'approve_pay' => 1,
                ]);
            break;
        }
        return 'success';
    }
    public function updateImage(Request $request){
        if($request->upload_pic !== null) {
            $exploded = explode(',',$request->upload_pic);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg'))
            {
                $extension = 'jpg';
            }
            else
            {
                $extension = 'png';
            }

            if(TrackingPayments::where('upload_pic', $request->upload_pic)->exists())
                $result = false;
            else {
                //generate random strings
                $length= 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                // set all details
                $filename = $randomString.'.'.$extension;
                $path = public_path().'/img/pay_rcpt/'.$filename;
                file_put_contents($path,$decoded);    
                $result = TrackingPayments::where('id', $request->id)->
                update([
                    'upload_pic' => $filename,
                ]);
                return $filename;
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
