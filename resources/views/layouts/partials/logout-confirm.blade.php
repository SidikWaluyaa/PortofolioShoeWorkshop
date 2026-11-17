{{-- Yes/No popup before logging out. Logout forms call it with onsubmit="return confirmLogout(event, this)".
     Include after SweetAlert; optional $logoutTitle and $logoutText (unique names: page variables like $title leak into includes). --}}
<script>
    window.confirmLogout = function (event, form) {
        const title = @js($logoutTitle ?? 'Keluar dari akunmu?');
        // Fallback when the SweetAlert CDN is unreachable: the browser's own dialog
        if (!window.Swal) return window.confirm(title);
        event.preventDefault();
        Swal.fire({
            title: title,
            text: @js($logoutText ?? 'Kamu perlu login lagi untuk melihat donasi, adopsi, dan reparasimu.'),
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => { if (result.isConfirmed) form.submit(); });
        return false;
    };
</script>
