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
                        <input type="text" class="form-control" name="nom" placeholder="Entrez le nom de famille">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIN</label>
                        <input type="text" class="form-control" name="nin" placeholder="Enter NIN">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Numéro Téléphone</label>
                        <input type="text" class="form-control" name="numero_tele" placeholder="Enter phone number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" name="date_de_nai">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image DE CCART NATIONAL</label>
                        <input type="file" class="form-control" name="imagecart">
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
                        <button class="btn btn-primary" type="submit">Créer un fan</button>
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
        <a id="pdfLink" href="#" target="_blank" class="btn btn-success">Télécharger </a>
      </div>
    </div>
  </div>
</div>
<script>
document.getElementById('fanForm').addEventListener('submit', function(e) {
    e.preventDefault(); // ✅ Stop normal form submit

    let formData = new FormData(this);

    fetch("{{ route('fans.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // ✅ Insert QR in modal
            document.getElementById('qrImage').src = data.qr_pdf_img;
            document.getElementById('pdfLink').href = data.pdf_url;

            // ✅ Show modal
            let qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
            qrModal.show();

            // ✅ Reset form
            document.getElementById('fanForm').reset();
        } else {
            alert("Erreur: " + data.message);
        }
    })
    .catch(err => console.error(err));
});
</script>
@endsection



