@extends('backend.layouts.master')

@section('context')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer un nouveau fan</h3>
            </div>

            <div class="card-body">
                <form id="fanForm" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" placeholder="Entrez le nom de famille" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIN</label>
                        <input type="text" class="form-control" name="nin" placeholder="Enter NIN" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Numéro Téléphone</label>
                        <input type="text" class="form-control" name="numero_tele" placeholder="Enter phone number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" name="date_de_nai" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image DE CCART NATIONAL</label>
                        <input type="file" class="form-control" name="imagecart" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Abonment</label>
                        <select name="id_abonment" class="form-control" required>
                            <option value="">-- Select Abonment --</option>
                            @foreach($abonments as $abonment)
                            <option value="{{ $abonment->id }}">
                                {{ $abonment->nom }} - {{ $abonment->prix }} DA ({{ $abonment->nbrmatch }} matchs)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button id="submitBtn" class="btn btn-primary" type="submit">
                            <span id="btnText">Créer un fan</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 Modal for QR Code -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 text-center">
      <h5 class="modal-title mb-2">QR Code généré</h5>
      <div class="modal-body">
        <img id="qrImage" src="" class="img-fluid mb-3" alt="QR Code">
        <a id="pdfLink" href="#" target="_blank" class="btn btn-success">Télécharger</a>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('fanForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let submitBtn = document.getElementById('submitBtn');
    let btnText = document.getElementById('btnText');
    let btnSpinner = document.getElementById('btnSpinner');

    // ✅ Activer le spinner et désactiver le bouton
    submitBtn.disabled = true;
    btnSpinner.classList.remove('d-none');
    btnText.textContent = "Chargement...";

    fetch("{{ route('fans.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(async res => {
        let data = await res.json();

        if (!res.ok) {
            if (res.status === 422) {
                // ✅ Validation errors → show in toaster
                Object.keys(data.errors).forEach(field => {
                    data.errors[field].forEach(msg => {
                        toastr.error(msg);
                    });
                });
            } else {
                toastr.error(data.message || "Une erreur est survenue");
            }
            throw new Error("Validation or server error");
        }

        // ✅ Success
        if (data.success) {
            document.getElementById('qrImage').src = data.qr_pdf_img;
            document.getElementById('pdfLink').href = data.pdf_url;

            let qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
            qrModal.show();

            toastr.success(data.message || "Fan créé avec succès !");
            document.getElementById('fanForm').reset();
        }
    })
    .catch(err => {
        console.error(err);
        toastr.error("Erreur serveur: " + err.message);
    })
    .finally(() => {
        // ✅ Restaurer le bouton
        submitBtn.disabled = false;
        btnSpinner.classList.add('d-none');
        btnText.textContent = "Créer un fan";
    });
});
</script>

@endsection
