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
<div id="subscribe-modal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-xl relative text-center">
        <!-- X Button -->
        <button onclick="closeSubscribeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Content -->
        <h2 class="text-2xl font-bold mb-2">📬 اشترك في التحديثات</h2>
        <p class="text-gray-600 mb-4">ادخل بريدك الإلكتروني لتصلك آخر الأخبار.</p>

        <input type="email" id="subscribe-email" placeholder="example@email.com"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 mb-4 text-sm">

        <button onclick="submitSubscription()" class="bg-blue-600 text-white w-full py-2 rounded-lg hover:bg-blue-700 transition">
            اشترك الآن
        </button>

        <!-- Text Close Button -->
        <button onclick="closeSubscribeModal()" class="mt-4 text-sm text-gray-500 underline hover:text-gray-700">
            إغلاق
        </button>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        if (!sessionStorage.getItem('subscribed_prompt_shown')) {
            setTimeout(() => {
                document.getElementById('subscribe-modal').classList.remove('hidden');
                sessionStorage.setItem('subscribed_prompt_shown', 'true');
            }, 3000);
        }
    });

    function closeSubscribeModal() {
        document.getElementById('subscribe-modal').classList.add('hidden');
    }

    function submitSubscription() {
        const email = document.getElementById('subscribe-email').value;

        fetch('{{ route('subscribe') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ email }),
        })
        .then(response => {
            if (!response.ok) throw new Error();
            return response.json();
        })
        .then(data => {
            closeSubscribeModal();
            Swal.fire({
                icon: 'success',
                title: 'تم الاشتراك بنجاح!',
                text: data.message || 'شكراً لاشتراكك معنا ❤️',
                showConfirmButton: false,
                timer: 2000, // Auto-close after 2 seconds
                timerProgressBar: true
            });
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'خطأ!',
                text: 'حدث خطأ! تأكد من البريد أو أنه مستخدم مسبقاً.',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        });
    }
</script>
@endsection




