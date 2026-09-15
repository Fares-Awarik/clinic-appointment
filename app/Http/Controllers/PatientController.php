<?php

namespace App\Http\Controllers;


use App\Models\Patient;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
        public function index()
    {
        $patients = Patient::all();
        return view('patients.index' , compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $validated = $request->validated();

            Patient::create($validated);

            return redirect()->route('patients.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(string $id)
        {
            $patient = Patient::findOrFail($id);

            return view('patients.edit', ['patient' => $patient]);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, string $id)
    {
        
        $patient = Patient::findOrFail($id);
                $validated = $request->validated();
        $patient->update($validated);

return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $patient = Patient::findOrFail($id);
            $patient->delete();
            return redirect()->route('patients.index');
    }
}
