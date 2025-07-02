@extends('layouts.user')

@section('user-content')
<h1 class="text-2xl font-bold mb-4">المعلومات الشخصية</h1>

<div class="space-y-4">
    <div>
        <label class="block font-bold mb-1">الاسم</label>
        <div class="w-full rounded px-3 py-2 bg-gray-200">
            {{ auth()->user()->name }}
        </div>
    </div>

    <div>
        <label class="block font-bold mb-1">البريد الإلكتروني</label>
        <div class="w-full rounded px-3 py-2 bg-gray-200">
            {{ auth()->user()->email }}
        </div>
    </div>

    <div>
        <label class="block font-bold mb-1">السيرة الذاتية</label>
        <div class="w-full rounded px-3 py-2 bg-gray-200 whitespace-pre-line">
            {{ auth()->user()->bio ?? 'لا يوجد' }}
        </div>
    </div>

    <button onclick="openUpdateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors">
        تحديث المعلومات
    </button>
</div>
<!-- Update Modal -->
<div id="update-modal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-xl relative">
        <!-- Close Button -->
        <button onclick="closeUpdateModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Content -->
        <h2 class="text-2xl font-bold mb-4 text-right">تعديل المعلومات الشخصية</h2>

        <form id="updateForm" method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">
            @csrf
            <div class="text-right">
                <label class="block font-bold mb-1 text-right">الاسم</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-right">
            </div>

            <div class="text-right">
                <label class="block font-bold mb-1 text-right">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-right">
            </div>

            <div class="text-right">
                <label class="block font-bold mb-1 text-right">السيرة الذاتية</label>
                <textarea name="bio" rows="4"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-right">{{ old('bio', auth()->user()->bio) }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="button" onclick="closeUpdateModal()"
                        class="flex-1 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    إلغاء
                </button>
                <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Modal Functions
    function openUpdateModal() {
        document.getElementById('update-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeUpdateModal() {
        document.getElementById('update-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Handle form submission with SweetAlert
    // Handle form submission with SweetAlert
document.getElementById('updateForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = this.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <span class="inline-flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            جاري الحفظ...
        </span>
    `;

    try {
        const response = await fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            closeUpdateModal();

            if (data.unchanged) {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'لا يوجد تغييرات',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });

            } else {
                Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم تحديث البيانات بنجاح',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    }).then(() => {
                    window.location.reload();
                });
            }
        } else {
            throw new Error(data.message || 'حدث خطأ أثناء محاولة التحديث');
        }
    } catch (error) {
        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'لا يوجد تغييرات',
                        text: error.message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    }
});
    // Handle success message from server-side redirect
    @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'تم!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    @endif
</script>
@endpush

@endsection
