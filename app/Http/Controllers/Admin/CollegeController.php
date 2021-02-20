<?php

namespace App\Http\Controllers\Admin;

use App\Models\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Form Requests
use App\Http\Requests\College\UpdateCollegeRequest;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->query('search');

        if ($search) {
            $colleges = College::where('name', 'LIKE', "%{$search}%")->paginate(5);
        } else {
            $colleges = College::paginate(5);
        }

        return view('admin.colleges.index', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colleges',
            'accreditation' => 'required'
        ]);

        College::create($request->all());

        return redirect()->route('colleges.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $college = College::find($id);

        return view('admin.colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateCollegeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollegeRequest $request)
    {
        $college = College::find($request->id)->update($request->all());

        return redirect()->route('colleges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $college = College::find($id)->delete();

        return redirect()->route('colleges.index');
    }
}
