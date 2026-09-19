<h1>المريضين</h1>
<form method="GET" action="{{ route('patients.index') }}">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="ابحث باسم المريض"
        maxlength="100"
    >

    <button type="submit">بحث</button>

    <a href="{{ route('patients.index') }}">عرض الكل</a>
</form>

@error('search')
    <p>{{ $message }}</p>
@enderror
<a href="{{ route('patients.create') }}">إضافة مريض جديد</a>

<table border="1" cellpadding="8">
    <tr>
        <th>الاسم</th>
        <th>رقم الهوية</th>
        <th>العمر</th>
        <th>البريد الإلكتروني</th>
        <th>الجنس</th>
        <th>الهاتف</th>
        <th>العنوان</th>
        <th>إجراءات</th>
    </tr>
    
    @foreach ($patients as $patient)
        <tr>
            <td>{{ $patient->full_name }}</td>
            <td>{{ $patient->national_id_number }}</td>
            <td>{{ $patient->age }}</td>
            <td>{{ $patient->email }}</td>
            <td>{{ $patient->gender }}</td>
            <td>{{ $patient->phone }}</td>
            <td>{{ $patient->address }}</td>
            <td>
                <a href="{{ route('patients.edit', $patient) }}">تعديل</a>
                |@can('delete patients')
                <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display:inline">
                    @csrf
                    
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('متأكد إنك بدك تحذف هاد المريض؟')">حذف</button>
                </form>
                @endcan
            </td>
        </tr>
    @endforeach
</table>
{{ $patients->links() }}