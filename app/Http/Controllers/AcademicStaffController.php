<?php

namespace App\Http\Controllers;

use App\Models\academicStaff;
use Illuminate\Http\Request;

class AcademicStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return academicStaff::all();
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
        // $request->validate([
        //     ''
        // ])
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\academicStaff  $academicStaff
     * @return \Illuminate\Http\Response
     */
    public function show(academicStaff $academicStaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\academicStaff  $academicStaff
     * @return \Illuminate\Http\Response
     */
    public function edit(academicStaff $academicStaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\academicStaff  $academicStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, academicStaff $academicStaff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\academicStaff  $academicStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(academicStaff $academicStaff)
    {
        //
    }
}
