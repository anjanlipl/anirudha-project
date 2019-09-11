<?php

namespace App\Http\Controllers;

use App\Output;
use Illuminate\Http\Request;

class OutputController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outputs = Output::all();
        return view('output.index', compact('outputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('output.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'scheme_id' => 'required|exists:schemes,id',
            'name'=>'required|max:191',
        ]);
        $output = new Output;
        $output->scheme_id = $request->scheme_id;
        $output->name = $request->name;
        $output->save();
        return redirect()->route('output.index')->with('success','Output added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function show(Output $output)
    {
        return view('output.show', compact('output'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function edit(Output $output)
    {
        return view('output.edit', compact('output'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        $this->validate($request, [
            'scheme_id' => 'required|exists:schemes,id',
            'name'=>'required|max:191',
        ]);
        $output->scheme_id = $request->scheme_id;
        $output->name = $request->name;
        $output->save();
        return redirect()->route('output.index')
            ->with('success',
             'Output'. $output->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function destroy(Output $output)
    {
        $output->delete();
        return redirect()->route('output.index')
            ->with('success',
             'Output deleted successfully!');
    }
    public function deleteOutput(Request $request,$id)
    {
        $objective = Output::find($id);
        if(isset($objective)){
            $objective->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
}
