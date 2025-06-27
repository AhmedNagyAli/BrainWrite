<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-xl text-right">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">إنشاء حساب جديد</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-1 text-sm text-gray-600">الاسم</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-600">اسم المستخدم</label>
                    <input type="text" name="username" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-600">البريد الإلكتروني</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-600">كلمة المرور</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-600">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition">
                    تسجيل
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                لديك حساب؟
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</x-guest-layout>
