<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lecturers;
use App\Models\Cluster;
use Illuminate\Http\Request;

class LecturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    


     public function index()
     {

         return view('lect.index');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Lecturers  $lecturers
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturers $lecturers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecturers  $lecturers
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturers $lecturers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecturers  $lecturers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturers $lecturers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecturers  $lecturers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturers $lecturers)
    {
        //
    }
}
