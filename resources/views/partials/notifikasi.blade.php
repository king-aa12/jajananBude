@php
    $sukses = session('status');
    $gagal = session('gagal');
    $galat = $errors->all();
@endphp
@if ($sukses || $gagal || count($galat))
<script>
(function () {
    var sukses = @json($sukses);
    var gagal = @json($gagal);
    var galat = @json($galat);

    function esc(s) {
        return String(s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    if (typeof Swal === 'undefined') {
        alert([sukses, gagal].concat(galat).filter(Boolean).join('\n'));
        return;
    }

    if (galat.length) {
        Swal.fire({
            icon: 'error',
            title: 'Data belum valid',
            html: '<ul style="text-align:left;margin:0;padding-left:20px">' +
                  galat.map(function (e) { return '<li>' + esc(e) + '</li>'; }).join('') + '</ul>',
            confirmButtonText: 'Perbaiki',
            confirmButtonColor: '#A9561A'
        });
        return;
    }
    if (gagal) {
        Swal.fire({ icon: 'error', title: 'Gagal', text: gagal, confirmButtonText: 'Mengerti', confirmButtonColor: '#A9561A' });
        return;
    }
    if (sukses) {
        Swal.fire({ toast: true, position: 'top', icon: 'success', title: sukses, showConfirmButton: false, timer: 2500, timerProgressBar: true });
    }
})();
</script>
@endif