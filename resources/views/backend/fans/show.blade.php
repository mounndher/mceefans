@extends('backend.layouts.master')

@section('context')

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div id="toast-message" class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fan Details</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        <!-- Back icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12h14" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nom</th>
                        <td>{{ $fan->nom }}</td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td>{{ $fan->prenom }}</td>
                    </tr>
                    <tr>
                        <th>NIN</th>
                        <td>{{ $fan->nin }}</td>
                    </tr>
                    <tr>
                        <th>Numéro Téléphone</th>
                        <td>{{ $fan->numero_tele }}</td>
                    </tr>
                    <tr>
                        <th>Date de Naissance</th>
                        <td>{{ $fan->date_de_nai }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img id="fan-image" src="{{ asset($fan->image) }}" alt="Fan Image" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>Card Image</th>
                        <td>
                            <img id="card-image" src="{{ asset($fan->card) }}" alt="Card Image" width="100" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>QR Code</th>
                        <td>
                            <img id="qr-image" src="{{ asset($fan->qr_img) }}" alt="QR Code" width="100" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>QR Code PDF</th>
                        <td>
                            <img id="qr-pdf-image" src="{{ asset($fan->qr_pdf_img) }}" alt="QR PDF" width="100" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>QR ID</th>
                        <td>{{ $fan->id_qrcode }}</td>
                    </tr>
                    <tr>
                        <th>Actions</th>
                        <td>
                            <form action="{{ route('fans.regenerate', $fan->id) }}" method="POST" class="regenerate-form" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="icon icon-tabler icon-tabler-refresh">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                    Regenerate Card
                                </button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.regenerate-form').forEach(form => {
    form.addEventListener('submit', function(e){
        e.preventDefault();
        if(!confirm('Regenerate QR code and card for this fan?')) return;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                // Update images dynamically
                document.getElementById('qr-image').src = data.qr_img + '?' + new Date().getTime();
                document.getElementById('card-image').src = data.card_img + '?' + new Date().getTime();
                document.getElementById('qr-pdf-image').src = data.qr_pdf_img + '?' + new Date().getTime();

                // Show toast
                const toastEl = document.getElementById('liveToast');
                document.getElementById('toast-message').innerText = data.message;
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            } else {
                alert('Error: ' + data.message);
            }
        }).catch(err => {
            console.error(err);
            
        });
    });
});
</script>

@endsection
