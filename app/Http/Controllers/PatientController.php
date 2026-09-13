<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Validation\Rule;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id_number' => 'required|string|max:255|unique:patients,national_id_number',
            'age' => 'required|integer|min:0|max:130',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
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
    public function update(Request $request, string $id)
    {
        
        $patient = Patient::findOrFail($id);
                $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'national_id_number')->ignore($patient),
            ],
            'age' => 'required|integer|min:0|max:130',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
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
