@extends('backend.layouts.master')

@section('context')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Liste de présence</h3>

                    <!-- 🔎 Search Form -->
                    <form method="GET" action="{{ route('attendances.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2"
                               placeholder="chercher..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">chercher</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fan</th>
                                    <th>Event</th>
                                    <th>Appareil</th>

                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->id }}</td>
                                        <td>{{ $attendance->fan->nom ?? 'N/A' }}</td>
                                        <td>{{ $attendance->event->nom ?? 'N/A' }}</td>
                                        <td>{{ $attendance->appareil->nom_utilisateur ?? 'N/A' }}</td>
                                        
                                        <td>{{ $attendance->status }}</td>
                                        <td>{{ optional($attendance->created_at)->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No attendance records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $attendances->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
