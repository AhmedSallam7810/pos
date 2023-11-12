<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients=Client::when($request->search,function ($query)use ($request){
            return $query->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);

        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formfield=$request->validate([
            'name'=>['required',Rule::unique('clients')],
            'phone'=>'required',
            'address'=>'required',
        ]);

        Client::create($formfield);

        return redirect()->route('dashboard.clients.index')->with('success',__('site.created_successfully'));


    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $formfield=$request->validate([
            'name'=>['required',Rule::unique('clients')->ignore($client->id)],
            'phone'=>'required',
            'address'=>'required',
        ]);

        $client->update($formfield);

        return redirect()->route('dashboard.clients.index')->with('success',__('site.updated_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
     
        return redirect()->route('dashboard.clients.index')->with('success', __('site.deleted_successfully'));
 
    }
}
