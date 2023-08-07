<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    //
    public function index()
    {
        // model service serach table in DB names services ..
        //::all() -> get All data
        $services = service::all();
        return view('service.index', compact('services'));
    }

    public function show()
    {
        // model service serach table in DB names services ..
        //::all() -> get All data
        $services = service::all();
        return view('service.show', compact('services'));
    }


    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request){

        service::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        Session::flash('msg', 'services created successfuly');
        return redirect(url('service'));
    }

    public function edit($id)
    {
        $service = service::find($id);
        return view('service.edit', compact('service'));
    }

    public function update(Request $request)
    {

        $service = service::find($request->service_id);
        $service->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        Session::flash('msg', 'services updated successfuly');
        return redirect(url('service'));
    }


    public function destroy(Request $request)
    {
        $service=service::find($request->service_id);
        $service->delete();
        Session::flash('msg', 'services deleted successfuly');
        return redirect(url('service/show'));
    }
}
