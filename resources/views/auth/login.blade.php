<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md overflow-hidden">
            {{-- Header with logo --}}
            <div class="bg-indigo-600 p-6 text-center">
                <div class="text-2xl font-bold text-white">BrainWrite</div>
                {{-- <div class="mt-1 text-blue-100">سجل دخولك لمواصلة الكتابة</div> --}}
            </div>

            <div class="p-6 sm:p-8">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center">تسجيل الدخول</h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email Field --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                        <input
                            type="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="example@email.com"
                        >
                    </div>

                    {{-- Password Field --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        >
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 rtl:space-x-reverse text-sm text-gray-600">
                            <input
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <span>تذكرني</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                            نسيت كلمة المرور؟
                        </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg font-medium transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        دخول
                    </button>
                </form>

                {{-- Register Link --}}
                <div class="mt-6 text-center text-sm text-gray-600">
                    <p class="mb-2">ليس لديك حساب؟</p>
                    <a
                        href="{{ route('register') }}"
                        class="inline-block w-full py-2 px-4 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition duration-200"
                    >
                        إنشاء حساب جديد
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
