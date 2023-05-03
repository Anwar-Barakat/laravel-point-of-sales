<?php

namespace App\Http\Controllers\Admin\Stock\Delegate;

use App\Models\Delegate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.stocks.delegates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.delegates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Delegate $delegate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delegate $delegate)
    {
        return view('admin.stocks.delegates.edit', ['delegate' => $delegate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delegate $delegate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delegate $delegate)
    {
        //
    }
}