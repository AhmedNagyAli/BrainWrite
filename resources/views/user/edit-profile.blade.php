@extends('layouts.user')

@section('user-content')
<h1 class="text-2xl font-bold mb-4">تعديل المعلومات الشخصية</h1>

<form method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">
    @csrf

    <div>
        <label class="block font-bold mb-1">الاسم</label>
        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block font-bold mb-1">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block font-bold mb-1">السيرة الذاتية</label>
        <textarea name="bio" rows="4" class="w-full border rounded px-3 py-2">{{ old('bio', auth()->user()->bio) }}</textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">تحديث</button>
</form>
@endsection
