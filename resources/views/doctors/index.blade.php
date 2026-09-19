<h1>الأطباء</h1>
<form method="GET" action="{{ route('doctors.index') }}">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="ابحث باسم الدكتور"
        maxlength="100"
    >

    <button type="submit">بحث</button>

    <a href="{{ route('doctors.index') }}">عرض الكل</a>
</form>

@error('search')
    <p>{{ $message }}</p>
@enderror
<a href="{{ route('doctors.create') }}">إضافة طبيب جديد</a>

<table border="1" cellpadding="8">
    <tr>
        <th>الاسم</th>
        <th>الاختصاص</th>
        <th>الهاتف</th>
        <th>الحالة</th>
        <th>إجراءات</th>
    </tr>

    @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->name }}</td>
            <td>{{ $doctor->speciality }}</td>
            <td>{{ $doctor->phone }}</td>
            <td>{{ $doctor->is_active ? 'غير نشط' : 'نشط' }}</td>
            <td>
                <a href="{{ route('doctors.edit', $doctor) }}">تعديل</a>
                |
                <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('متأكد إنك بدك تحذف هاد الدكتور؟')">حذف</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $doctors->links() }}