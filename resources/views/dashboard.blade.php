@extends('backend.layouts.master')
@section('context')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Vue d’ensemble
          </div>
          <h2 class="page-title">
            Dashboard
          </h2>
        </div>
        <!-- Page title actions -->

      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">


        <div class="col-12">
          <div class="row row-cards">

            <div class="row g-3">

              <!-- Fans Count -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                          <i class="ti ti-users"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $fansCount }} Fans</div>
                        <div class="text-secondary">Total des fans</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Total Prix -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-success text-white avatar">
                          <i class="ti ti-currency-dollar"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ number_format($prixTotal, 2) }} DA</div>
                        <div class="text-secondary">Total des ventes</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Appareils Count -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-warning text-white avatar">
                          <i class="ti ti-device-mobile"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $appareilsCount }} Appareils</div>
                        <div class="text-secondary">Total des appareils</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Events Active -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-info text-white avatar">
                          <i class="ti ti-calendar-check"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $eventsActive }} Actifs</div>
                        <div class="text-secondary">Événements actifs</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Events Inactive -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-secondary text-white avatar">
                          <i class="ti ti-calendar-off"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $eventsInactive }} Inactifs</div>
                        <div class="text-secondary">Événements inactifs</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Events Terminer -->
              <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                          <i class="ti ti-calendar-event"></i>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $eventsTerminer }} Terminés</div>
                        <div class="text-secondary">Événements terminés</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>







        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Derniers Fans Actifs</h3>
            </div>
            <div class="card-body border-bottom py-3">
              <div class="d-flex">
                <div class="text-secondary">
                  Afficher
                  <div class="mx-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" value="12" size="3" aria-label="Fans count">
                  </div>
                  entrées
                </div>
                <div class="ms-auto text-secondary">
                  Rechercher:
                  <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" aria-label="Rechercher fan">
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                        aria-label="Tout sélectionner"></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro Télé</th>
                    <th>Date de Naissance</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($lastActiveFans as $fan)
                    <tr>
                      <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Sélectionner fan">
                      </td>
                      <td>{{ $fan->nom }}</td>
                      <td>{{ $fan->prenom }}</td>
                      <td>{{ $fan->numero_tele }}</td>
                      <td>{{ \Carbon\Carbon::parse($fan->date_de_nai)->format('d M Y') }}</td>
                      <td>
                        <span class="badge bg-success me-1"></span> Actif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer d-flex align-items-center">
              <p class="m-0 text-secondary">Affichage de <span>1</span> à <span>{{ $lastActiveFans->count() }}</span> sur
                <span>{{ $fansCount }}</span> entrées</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection