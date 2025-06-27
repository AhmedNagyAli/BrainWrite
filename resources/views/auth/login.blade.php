<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-xl text-right">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">تسجيل الدخول</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-1 text-sm text-gray-600">البريد الإلكتروني</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-600">كلمة المرور</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2 rtl:space-x-reverse">
                        <input type="checkbox" name="remember" class="rounded border-gray-300">
                        <span>تذكرني</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                    دخول
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                ليس لديك حساب؟
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">إنشاء حساب جديد</a>
            </div>
        </div>
    </div>
</x-guest-layout>
