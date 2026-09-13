<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
{
    $doctors = Doctor::all();
    return view('doctors.index', compact('doctors'));
}
//هي بتعرض الكاترة الموجودين //


    public function create()
    {
       return view('doctors.create');
    }
// هي بتعرض الفورم اللي بتضيف الدكتور عن طريقه



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Doctor::create($validated);

        return redirect()->route('doctors.index')->with('success', 'تمت إضافة الدكتور بنجاح');
    }
//هي بتحفظ بينات الدكتور بقاعدة البيانات//

    public function show(string $id)
    {
        //
    }


    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }
// هي بتفرجيك البيانات المعبأة بالفورم//

    public function update(Request $request, Doctor $doctor)
    {
            $validated = $request->validate([
        'name' => 'required|string|max:255',
        'speciality' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    $doctor->update($validated);

    return redirect()->route('doctors.index')->with('success', 'تم تحديث بيانات الدكتور بنجاح');
    }
//هي بتعمل تحديث لبيانات الدكتور بثاعدة البيانات//

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'تم حذف الدكتور بنجاح');
    }
}
//هي بتحذف بينات من قاعدة البيانات //