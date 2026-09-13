<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold mb-4">إضافة دكتور جديد</h2>

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('doctors.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">الاسم</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">التخصص</label>
                        <input type="text" name="speciality" value="{{ old('speciality') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">رقم الهاتف</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        حفظ
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>