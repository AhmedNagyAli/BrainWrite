<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md overflow-hidden">
            {{-- Header with logo --}}
            <div class="bg-indigo-600 p-6 text-center">
                <div class="text-2xl font-bold text-white">BrainWrite</div>
                {{-- <div class="mt-1 text-green-100">انضم إلى مجتمع الكتابة لدينا</div> --}}
            </div>

            <div class="p-6 sm:p-8">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center">إنشاء حساب جديد</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Name Field --}}
                    <div class="space-y-1">
                        <label class="block text-lg font-medium text-gray-900">الاسم الكامل</label>
                        <input
                            type="text"
                            name="name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="أدخل اسمك الكامل"
                        >
                    </div>

                    {{-- Username Field --}}
                    <div class="space-y-1">
                        <label class="block text-lg font-medium text-gray-900">اسم المستخدم</label>
                        <input
                            type="text"
                            name="username"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="اختر اسم مستخدم"
                        >
                    </div>

                    {{-- Email Field --}}
                    <div class="space-y-1">
                        <label class="block text-lg font-medium text-gray-900">البريد الإلكتروني</label>
                        <input
                            type="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="example@email.com"
                        >
                    </div>

                    {{-- Password Field --}}
                    <div class="space-y-1">
                        <label class="block text-lg font-medium text-gray-900">كلمة المرور</label>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        >
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="space-y-1">
                        <label class="block text-lg font-medium text-gray-900">تأكيد كلمة المرور</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        >
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full mt-6 bg-indigo-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    >
                        تسجيل حساب جديد
                    </button>
                </form>

                {{-- Login Link --}}
                <div class="mt-6 text-center text-lg text-gray-600">
                    <p class="mb-2">لديك حساب بالفعل؟</p>
                    <a
                        href="{{ route('login') }}"
                        class="inline-block w-full py-2 px-4 border border-gray-300 rounded-lg font-medium text-gray-900 hover:bg-gray-50 transition duration-200"
                    >
                        تسجيل الدخول
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
