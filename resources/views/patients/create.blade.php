<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold mb-4">إضافة مريض جديد</h2>

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">الأسم الكامل </label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">الرقم الوطني</label>
                        <input type="text" name="national_id_number" value="{{ old('national_id_number') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">رقم الهاتف</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">العمر</label>
                        <input type="text" name="age" value="{{ old('age') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium"> البريد الإلكتروني</label>
                        <input type="text" name="email" value="{{ old('email') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium"> الجنس</label>
                            <select name="gender"
                                    class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">اختر الجنس</option>
                                <option value="male" @selected(old('gender') === 'male')>ذكر</option>
                                <option value="female" @selected(old('gender') === 'female')>أنثى</option>
                            </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">العنوان</label>
                        <input type="text" name="address" value="{{ old('address') }}"
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