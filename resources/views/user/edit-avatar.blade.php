@extends('layouts.user')

@section('user-content')
    <h1 class="text-2xl font-bold mb-6">🖼️ تحديث الصورة الشخصية</h1>

    <form method="POST" action="{{ route('user.avatar.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Avatar Preview --}}
        <div class="flex items-center gap-6">
            <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-300 shadow">
                <img id="avatarPreview"
                     src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                     alt="Avatar Preview"
                     class="w-full h-full object-cover">
            </div>

            {{-- File Input --}}
            <label class="cursor-pointer bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-4 py-2 text-sm hover:bg-gray-200 transition">
                اختر صورة جديدة
                <input type="file" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(event)">
            </label>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-sm shadow transition">
                تحديث الصورة
            </button>
        </div>
    </form>

    {{-- Script for live preview --}}
    <script>
        function previewAvatar(event) {
            const input = event.target;
            const preview = document.getElementById('avatarPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
