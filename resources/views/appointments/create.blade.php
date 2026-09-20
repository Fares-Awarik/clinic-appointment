<h1>إضافة موعد جديد</h1>


<form method="POST" action="{{ route('appointments.store') }}">
    @csrf

    <div>
        <label for="patient_id">المريض</label>

        <select name="patient_id" id="patient_id" required>
            <option value="">اختر المريض</option>

            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}"
                    @selected(old('patient_id') == $patient->id)>
                    {{ $patient->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="doctor_id">الطبيب</label>

        <select name="doctor_id" id="doctor_id" required>
            <option value="">اختر الطبيب</option>

            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}"
                    @selected(old('doctor_id') == $doctor->id)>
                    {{ $doctor->name }}
                </option>
            @endforeach
        </select>
    </div>
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div>
    <label for="starts_at">تاريخ ووقت الموعد</label>

    <input
        type="datetime-local"
        name="starts_at"
        id="starts_at"
        value="{{ old('starts_at') }}"
        required
    >
</div>
<button type="submit">حفظ الموعد</button>
</form>