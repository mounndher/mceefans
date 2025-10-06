@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer des tickets</h3>
            </div>

            <div class="card-body">
                <form id="ticketForm" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nombre de tickets -->
                    <div class="mb-3">
                        <label class="form-label">Nombre de tickets à générer</label>
                        <input type="number" name="count" class="form-control" min="1" max="100" value="1" required>
                        @error('count')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Événement -->
                    <div class="mb-3">
                        <label class="form-label">Événement</label>
                        <select name="id_event" class="form-control" required>
                            <option value="">-- Sélectionnez un événement --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->nom }}</option>
                            @endforeach
                        </select>
                        @error('id_event')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Template du ticket -->
                   

                    <!-- Bouton de soumission -->
                    <div class="mb-3">
                        <button id="submitBtn" class="btn btn-primary" type="submit">
                            <span id="btnText">Générer les tickets</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>

                <!-- Zone de résultat -->
                <div id="resultArea" class="mt-4 d-none">
                    <div class="alert alert-success">
                        <strong>Succès !</strong> Les tickets ont été générés.
                    </div>
                    <p><strong>Total :</strong> <span id="totalTickets"></span></p>
                    <a id="pdfLink" href="#" target="_blank" class="btn btn-outline-primary">📄 Télécharger le PDF</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Script AJAX -->
<script>
document.getElementById('ticketForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const spinner = document.getElementById('btnSpinner');

    btn.disabled = true;
    spinner.classList.remove('d-none');
    btnText.textContent = "Génération...";

    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            // ✅ Open PDF in new tab automatically
            window.open(data.pdf_path, '_blank');
        } else {
            alert('Erreur : ' + (data.message || 'Quelque chose a mal tourné.'));
        }
    } catch (error) {
        alert('Erreur serveur : ' + error.message);
    }

    btn.disabled = false;
    spinner.classList.add('d-none');
    btnText.textContent = "Générer les tickets";
});
</script>

@endsection
