@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Event Statistics: {{ $event->nom }}</h3>
            </div>

            <div class="card-body">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Checked In ✅</td>
                            <td>{{ $stats->checked_in ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Absent ❌</td>
                            <td>{{ $stats->absent ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>QR Invalid 🚫</td>
                            <td>{{ $stats->qr_invalid ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Scanned Twice 🔄</td>
                            <td>{{ $stats->scanned_twice ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Expired ⏳</td>
                            <td>{{ $stats->expired ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">⬅️ Back to Events</a>
            </div>
        </div>
    </div>
</div>
@endsection
