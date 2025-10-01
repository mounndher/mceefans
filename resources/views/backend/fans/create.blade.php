@extends('backend.layouts.master')

@section('context')

<!-- Toast Container for Errors -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="errorToastBody">
                <!-- Error messages will appear here -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Toast Container for Success -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100; margin-top: 60px;">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="successToastBody">
                <!-- Success messages will appear here -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer un nouveau fan</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form id="fanForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Nom</label>
                                <input type="text" class="form-control" name="nom" placeholder="Entrez le nom de famille" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Prénom</label>
                                <input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">NIN (18 caractères)</label>
                                <input type="text" class="form-control" name="nin" placeholder="Entrez le NIN" maxlength="18" required>
                                <small class="form-hint">Le numéro d identification nationale doit contenir exactement 18 caractères</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Numéro Téléphone</label>
                                <input type="text" class="form-control" name="numero_tele" placeholder="Ex: 0555123456" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Date de Naissance</label>
                        <input type="date" class="form-control" name="date_de_nai" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Photo du Fan</label>
                                <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png" required>
                                <small class="form-hint">Formats acceptés: JPG, JPEG, PNG (Max: 2MB)</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Image de la Carte Nationale</label>
                                <input type="file" class="form-control" name="imagecart" accept="image/jpeg,image/jpg,image/png" required>
                                <small class="form-hint">Formats acceptés: JPG, JPEG, PNG (Max: 2MB)</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Abonnement</label>
                        <select name="id_abonment" class="form-select" required>
                            <option value="">-- Sélectionner un abonnement --</option>
                            @foreach($abonments as $abonment)
                            <option value="{{ $abonment->id }}">
                                {{ $abonment->nom }} - {{ $abonment->prix }} DA ({{ $abonment->nbrmatch }} matchs)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button id="submitBtn" class="btn btn-primary" type="submit">
                            <span id="btnText">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Créer un fan
                            </span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('fans.index') }}" class="btn btn-link">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for QR Code -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">✅ Fan créé avec succès !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-3">Le QR Code a été généré. Scannez-le pour télécharger la carte PDF.</p>
                <img id="qrImage" src="" class="img-fluid mb-3 border" alt="QR Code" style="max-width: 250px;">
                <div class="d-grid gap-2">
                    <a id="pdfLink" href="#" target="_blank" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 11l5 5l5 -5"></path>
                            <path d="M12 4l0 12"></path>
                        </svg>
                        Télécharger la carte PDF
                    </a>
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        Voir tous les fans
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('fanForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    const errorToast = new bootstrap.Toast(document.getElementById('errorToast'), { delay: 5000 });
    const successToast = new bootstrap.Toast(document.getElementById('successToast'), { delay: 5000 });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable button and show spinner
        submitBtn.disabled = true;
        btnSpinner.classList.remove('d-none');
        btnText.innerHTML = '<span>Création en cours...</span>';

        const formData = new FormData(form);

        fetch("{{ route('fans.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(response => {
            // Check if response is ok
            if (!response.ok) {
                return response.json().then(data => {
                    throw { status: response.status, data: data };
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success message
                document.getElementById('successToastBody').textContent = data.message || 'Fan créé avec succès !';
                successToast.show();

                // Update modal with QR code
                document.getElementById('qrImage').src = data.qr_pdf_img;
                document.getElementById('pdfLink').href = data.pdf_url;

                // Show modal
                const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
                qrModal.show();

                // Reset form
                form.reset();
            } else {
                // Show error message
                document.getElementById('errorToastBody').textContent = data.message || 'Une erreur est survenue';
                errorToast.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);

            // Handle validation errors (422)
            if (error.status === 422 && error.data.errors) {
                let errorMessages = '';
                Object.keys(error.data.errors).forEach(field => {
                    error.data.errors[field].forEach(message => {
                        errorMessages += message + '<br>';
                    });
                });
                document.getElementById('errorToastBody').innerHTML = errorMessages;
                errorToast.show();
            }
            // Handle other errors
            else if (error.data && error.data.message) {
                document.getElementById('errorToastBody').textContent = error.data.message;
                errorToast.show();
            }
            // Generic error
            else {
                document.getElementById('errorToastBody').textContent = 'Une erreur serveur est survenue. Veuillez réessayer.';
                errorToast.show();
            }
        })
        .finally(() => {
            // Re-enable button and hide spinner
            submitBtn.disabled = false;
            btnSpinner.classList.add('d-none');
            btnText.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                </svg>
                Créer un fan
            `;
        });
    });
});
</script>

@endsection
