@extends('layouts.app')

@section('title', 'BrainWrite')
@section('meta_description', 'Read the latest posts on various topics.')
@push('styles')
   <style>
    /* Modified pagination styling for left side */
    .custom-pagination {
        position: absolute;
        bottom: 0.5rem;
        left: 10px; /* Changed from right to left */
        display: flex;
        gap: 0.5rem;
        z-index: 10;
        flex-direction: row-reverse; /* Reverse order for RTL */
    }

    .custom-pagination .swiper-pagination-bullet {
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background-color: white;
        color: black;
        font-weight: bold;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease, color 0.3s ease;
        cursor: pointer;
    }

    .custom-pagination .swiper-pagination-bullet-active {
        background-color: #2563eb;
        color: white;
    }

    /* Swiper fixes */
    .swiper {
        width: 100%;
        height: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        width: 100% !important;
        height: auto;
        position: relative;
    }
</style>
@endpush
@section('content')
<div class="max-w-[1800px] mx-auto px-2 sm:px-4 py-2 space-y-8 font-almarai">
    @include('layouts.partials.sidebar-left')

    <hr class="border-gray-500 my-4">

    <div>
        <!-- Main News Section -->
        <h1 class="text-5xl font-extrabold mb-4">الاخبار</h1>
        <div id="posts-wrapper">
            @include('components.sections.main', [
                'posts' => $posts,
                'sectionId' => 'main-posts'
            ])
        </div>

        <hr class="border-gray-500 my-8">

        <!-- Sports Section -->
        <h2 class="text-4xl font-extrabold mb-4">رياضة</h2>
        <div id="sports-wrapper">
            @include('components.sections.sports', [
                'posts' => $sportsPosts,
                'sectionId' => 'sports-posts'
            ])
        </div>

        <!-- Recommended Posts Section -->
        {{-- <hr class="border-gray-500 my-8">
        <h2 class="text-4xl font-extrabold mb-4">موصى به</h2>
        <div id="recommended-wrapper">
            @include('components.sections.main', [
                'posts' => $recommendedPosts,
                'sectionId' => 'recommended-posts'
            ])
        </div> --}}

        <!-- Egypt Posts Section -->
        <hr class="border-gray-500 my-8">
        <h2 class="text-4xl font-extrabold mb-4">تكنولوجيا</h2>
        <div id="tech-wrapper">
            @include('components.sections.tech', [
                'posts' => $techPosts,
                'sectionId' => 'tech-posts'
            ])
        </div>
    </div>
</div>
<!-- Subscription Modal -->
<div id="subscribe-modal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden" aria-hidden="true" aria-labelledby="subscribe-modal-title">
    <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-xl relative text-center" role="dialog" aria-modal="true">
        <!-- X Button -->
        <button onclick="closeSubscribeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600" aria-label="إغلاق النافذة">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Content -->
        <h2 id="subscribe-modal-title" class="text-2xl font-bold mb-2">📬 اشترك في التحديثات</h2>
        <p class="text-gray-600 mb-4">ادخل بريدك الإلكتروني لتصلك آخر الأخبار.</p>

        <form id="subscription-form" class="space-y-4">
            <div>
                <input type="email" id="subscribe-email" name="email" placeholder="example@email.com" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-sm"
                       aria-describedby="email-error">
                <p id="email-error" class="hidden mt-1 text-sm text-red-600"></p>
            </div>

            <button type="submit" class="bg-indigo-600 text-white w-full py-2 rounded-lg hover:bg-indigo-700 transition flex items-center justify-center">
                <span id="submit-text">اشترك الآن</span>
                <svg id="submit-spinner" class="hidden w-5 h-5 ml-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>

            <!-- Text Close Button -->
            <button type="button" onclick="closeSubscribeModal()" class="mt-4 text-sm text-gray-500 underline hover:text-gray-700">
                إغلاق
            </button>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
    // Show modal after delay (only once per session)
    document.addEventListener('DOMContentLoaded', () => {
        if (!sessionStorage.getItem('subscribed_prompt_shown')) {
            // Only show if user has been on page for a while and is engaged
            setTimeout(() => {
                const lastActivity = sessionStorage.getItem('last_activity');
                if (!lastActivity || Date.now() - lastActivity < 30000) { // 30 seconds
                    document.getElementById('subscribe-modal').classList.remove('hidden');
                    document.getElementById('subscribe-modal').setAttribute('aria-hidden', 'false');
                    sessionStorage.setItem('subscribed_prompt_shown', 'true');
                }
            }, 10000); // Show after 10 seconds
        }
    });

    // Track user activity
    document.addEventListener('mousemove', () => {
        sessionStorage.setItem('last_activity', Date.now());
    });

    function closeSubscribeModal() {
        document.getElementById('subscribe-modal').classList.add('hidden');
        document.getElementById('subscribe-modal').setAttribute('aria-hidden', 'true');
    }

    // Handle form submission
    document.getElementById('subscription-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const form = e.target;
        const emailInput = document.getElementById('subscribe-email');
        const errorElement = document.getElementById('email-error');
        const submitBtn = form.querySelector('button[type="submit"]');
        const submitText = document.getElementById('submit-text');
        const spinner = document.getElementById('submit-spinner');

        // Reset error state
        emailInput.classList.remove('border-red-500');
        errorElement.classList.add('hidden');

        // Validate email client-side
        if (!emailInput.validity.valid) {
            emailInput.classList.add('border-red-500');
            errorElement.textContent = 'الرجاء إدخال بريد إلكتروني صحيح';
            errorElement.classList.remove('hidden');
            return;
        }

        // Show loading state
        submitText.textContent = 'جاري الإرسال...';
        spinner.classList.remove('hidden');
        submitBtn.disabled = true;

        try {
            const response = await fetch('{{ route('subscribe') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: emailInput.value }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'حدث خطأ أثناء الاشتراك');
            }

            closeSubscribeModal();
            Swal.fire({
                icon: 'success',
                title: 'تم الاشتراك بنجاح!',
                text: data.message || 'شكراً لاشتراكك معنا ❤️',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        } catch (error) {
            emailInput.classList.add('border-red-500');
            errorElement.textContent = error.message || 'حدث خطأ! تأكد من البريد أو أنه مستخدم مسبقاً.';
            errorElement.classList.remove('hidden');
        } finally {
            submitText.textContent = 'اشترك الآن';
            spinner.classList.add('hidden');
            submitBtn.disabled = false;
        }
    });
</script>
@endsection




