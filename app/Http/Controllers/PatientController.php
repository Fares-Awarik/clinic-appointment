<?php

namespace App\Http\Controllers;


use App\Models\Patient;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Http\Request;    
class PatientController extends Controller
{
public function index(Request $request)
{
    $validated = $request->validate([
        'search' => 'nullable|string|max:100',
    ]);

    $search = trim($validated['search'] ?? '');

    $query = Patient::query();

    if ($search !== '') {
        $query->where('full_name', 'like', '%' . $search . '%');
    }

    $patients = $query
    ->orderBy('id')
    ->paginate(5)
    ->withQueryString();

    return view('patients.index', compact('patients'));
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
