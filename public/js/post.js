//tacking and counting visiting number
document.addEventListener('DOMContentLoaded', function() {
    const tracker = document.getElementById('visit-tracker');
    if (!tracker) return;

    const slug = tracker.dataset.slug;
    const url = tracker.dataset.url;
    const sessionKey = `session_visit_${slug}`;

    if (!sessionStorage.getItem(sessionKey)) {
        setTimeout(() => {
            if (document.visibilityState === 'visible') {
                fetch(url, {
                    method: "POST",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    credentials: "same-origin"
                }).then(response => {
                    if (response.ok) {
                        sessionStorage.setItem(sessionKey, 'true');
                    }
                }).catch(error => {
                    console.error('Error counting visit:', error);
                });
            }
        }, 5000);
    }
});


//post vasedand unsaved button

document.addEventListener('DOMContentLoaded', function() {
    const saveButton = document.getElementById('save-post-btn');
    const icon = document.getElementById('bookmark-icon');

    if (!saveButton || !icon) return;

    saveButton.addEventListener('click', function() {
        const postId = saveButton.dataset.postId;

        fetch(`/posts/${postId}/save`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'saved') {
                    icon.setAttribute('fill', '#1D4ED8');
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-blue-600');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم حفظ المقال في المفضلة',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                } else {
                    icon.setAttribute('fill', 'none');
                    icon.classList.remove('text-blue-600');
                    icon.classList.add('text-gray-400');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'info',
                        title: 'تمت إزالة المقال من المفضلة',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }
            })
            .catch(error => {
                console.error('Error saving/removing post:', error);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'حدث خطأ ما',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            });
    });
});
