<h1>تعديل بيانات: {{ $patient->full_name }}</h1>
<form method="POST" action="{{ route('patients.update', $patient) }}">
    @csrf
    @method('PUT')
                    @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
<label>الاسم الكامل</label>
<input type="text" name="full_name"
       value="{{ old('full_name', $patient->full_name) }}">

<label>الرقم الوطني   </label>
<input type="text" name="national_id_number"
       value="{{ old('national_id_number', $patient->national_id_number) }}">

<label>رقم الهاتف</label>
<input type="text" name="phone"
       value="{{ old('phone', $patient->phone) }}">

<label> البريد الألكتروني</label>
<input type="text" name="email"
       value="{{ old('email', $patient->email) }}">

<label> الجنس</label>
<select name="gender">
    <option value="male" @selected(old('gender', $patient->gender) === 'male')>ذكر</option>
    <option value="female" @selected(old('gender', $patient->gender) === 'female')>أنثى</option>
</select>

<label> العنوان</label>
<input type="text" name="address"
       value="{{ old('address', $patient->address) }}">

<label> العمر</label>
<input type="text" name="age"
       value="{{ old('age', $patient->age) }}">


        <button type="submit">حفظ التعديلات</button>
</form>

