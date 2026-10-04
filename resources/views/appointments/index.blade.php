<h1>المواعيد</h1>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@can('create appointments')
    <a href="{{ route('appointments.create') }}">إضافة موعد</a>
@endcan
<table border="1">
    <thead>
        <tr>
            <th>المريض</th>
            <th>الطبيب</th>
            <th>التاريخ والوقت</th>
            <th>الحالة</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->patient->full_name }}</td>
                <td>{{ $appointment->doctor->name }}</td>
                <td>{{ $appointment->starts_at }}</td>
                <td>
                    @switch($appointment->status)
                        @case('pending') بانتظار التأكيد @break
                        @case('confirmed') مؤكّد @break
                        @case('cancelled') ملغي @break
                        @case('completed') مكتمل @break
                        @default {{ $appointment->status }}
                    @endswitch
                    @can('change appointment status')
    <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
        @csrf
        @method('PATCH')

        <select name="status">
            <option value="pending" @selected($appointment->status === 'pending')>بانتظار التأكيد</option>
            <option value="confirmed" @selected($appointment->status === 'confirmed')>مؤكّد</option>
            <option value="cancelled" @selected($appointment->status === 'cancelled')>ملغي</option>
            <option value="completed" @selected($appointment->status === 'completed')>مكتمل</option>
        </select>

        <button type="submit">تغيير الحالة</button>
    </form>
@endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">لا توجد مواعيد بعد</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $appointments->links() }}