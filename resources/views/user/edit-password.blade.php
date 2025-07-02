@extends('layouts.user')

@section('user-content')
<h1 class="text-2xl font-bold mb-4">تغيير كلمة المرور</h1>
<form method="POST" action="{{ route('user.password.update') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block font-bold">كلمة المرور الحالية</label>
        <input type="password" name="current_password" class="w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block font-bold">كلمة المرور الجديدة</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block font-bold">تأكيد كلمة المرور</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">تحديث</button>
</form>
@endsection
