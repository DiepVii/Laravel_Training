<?php

namespace App\Http\Controllers;

use App\Services\UserService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $Userservice;

    public function __construct(UserService $Userservice)
    {
        $this->Userservice = $Userservice;
    }

    public function create(Request $request)
    {

        $this->Userservice->create_user($request);
        return redirect(route('index'))->with('message', 'Registered successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return view('login');
    }

    public function confirm_login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 0) {
                return redirect(route('index'));
            } else return redirect(route('employee.index'));
        }
        return back()->with('message', 'You have entered the wrong email or password');
    }

    public function register()
    {
        return view('admin.authentication.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
    public function update(Request $request, $id)
    {
        //
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
