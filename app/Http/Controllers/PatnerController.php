<?php

namespace App\Http\Controllers;

use App\Models\Patner;
use App\Http\Requests\StorePatnerRequest;
use App\Http\Requests\UpdatePatnerRequest;

class PatnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patner $patner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatnerRequest $request, Patner $patner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patner $patner)
    {
        //
    }
}
