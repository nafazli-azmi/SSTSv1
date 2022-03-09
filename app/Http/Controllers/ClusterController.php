<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    public function __construct(Cluster $cluster)
    {
        $this->cluster = $cluster;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAll(){
        $clusters = $this->cluster->all();
        return response()->json([
            'clusters' => $clusters
        ],200);
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
     * @param  \App\Models\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function show(cluster $cluster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function edit(cluster $cluster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cluster $cluster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function destroy(cluster $cluster)
    {
        //
    }
}
