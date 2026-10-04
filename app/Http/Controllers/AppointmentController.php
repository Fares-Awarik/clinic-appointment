<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $appointments = Appointment::with(['patient', 'doctor'])
                ->orderBy('starts_at')
                ->paginate(10);

            return view('appointments.index', compact('appointments'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::orderBy('full_name')->get();
        $doctors = Doctor::orderBy('name')->get();

        return view('appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreAppointmentRequest $request)
        {
            $validated = $request->validated();
            $start = Carbon::parse($validated['starts_at']);

            $conflict = Appointment::query()
                ->where('doctor_id', $validated['doctor_id'])
                ->where('status', '!=', 'cancelled')
                ->where('starts_at', '>', $start->copy()->subMinutes(30))
                ->where('starts_at', '<', $start->copy()->addMinutes(30))
                ->exists();

            if ($conflict) {
                return back()
                    ->withErrors(['starts_at' => 'الطبيب لديه موعد متعارض في هذا الوقت.'])
                    ->withInput();
            }

            Appointment::create($validated);

            return redirect()->route('appointments.create')
                ->with('success', 'تم حفظ الموعد');
        }
        public function updateStatus(Request $request, Appointment $appointment)
        {
            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled,completed',
            ]);
            if ($validated['status'] !== 'cancelled') {
                $start = Carbon::parse($appointment->starts_at);

                $conflict = Appointment::query()
                    ->where('doctor_id', $appointment->doctor_id)
                    ->where('id', '!=', $appointment->id)
                    ->where('status', '!=', 'cancelled')
                    ->where('starts_at', '>', $start->copy()->subMinutes(30))
                    ->where('starts_at', '<', $start->copy()->addMinutes(30))
                    ->exists();

                if ($conflict) {
                    return back()->with('error', 'لا يمكن تفعيل الموعد لأن وقت الطبيب محجوز.');
                }
            }
            $appointment->update($validated);

            return redirect()->route('appointments.index')
                ->with('success', 'تم تحديث حالة الموعد.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
