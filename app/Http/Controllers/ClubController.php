<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;

class ClubController extends Controller
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
    public function store(StoreClubRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClubRequest $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
