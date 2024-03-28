<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AdsSms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'receivers' => 'required|integer',
            'text' => 'required|string'
        ]);
        if ($request->receivers == 1)
            $users = User::has('orders')->get();
        else
            $users = User::all();

        if ($users->count() == 0) {
            alert()->info('', 'هیچ کاربری یافت نشد')->showConfirmButton('تایید');
            return redirect()->back();
        }
        try {
            $phones = $users->pluck('cellphone')->toArray();
            Notification::send(auth()->user(), new AdsSms($request->text, $phones));
            alert()->success('پیام با موفقیت ارسال شد')->showConfirmButton('تایید');
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error('عدم ارسال پیام', $e->getMessage())->showConfirmButton('تایید');
        }
    }
}
