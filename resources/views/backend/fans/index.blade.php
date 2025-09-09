@extends('backend.layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Existing dashboard cards ... -->

        <!-- Users List Table -->
        <div class="card mt-4">
            <div class="card-body">
                <!-- Filters -->
                <form class="row g-3 mb-4">
                    <div class="col-md-3">
                        <select class="form-select" name="role">
                            <option selected>Select Role</option>
                            <option>Maintainer</option>
                            <option>Subscriber</option>
                            <option>Editor</option>
                            <option>Author</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="plan">
                            <option selected>Select Plan</option>
                            <option>Enterprise</option>
                            <option>Basic</option>
                            <option>Team</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option selected>Select Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-danger"><i class="bx bx-plus"></i> Add New User</button>
                    </div>
                </form>
                <!-- Search & Export -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <select class="form-select">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                    </div>
                    <div class="col-md-7"></div>
                    <div class="col-md-3 d-flex">
                        <input type="text" class="form-control me-2" placeholder="Search User">
                        <button class="btn btn-outline-secondary me-2"><i class="bx bx-export"></i> Export</button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Plan</th>
                                <th>Billing</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="avatar" class="rounded-circle me-2" width="36" height="36">
                                        <div>
                                            <span class="fw-bold text-primary" style="background:#7B61FF; color:#fff; border-radius:3px; padding:2px 6px;">Zsazsa McCleverty</span><br>
                                            <small>zmcclevertye@soundcloud.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td><i class="bx bx-user-circle text-success"></i> Maintainer</td>
                                <td>Enterprise</td>
                                <td>Auto Debit</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-link text-danger"><i class="bx bx-trash"></i></button>
                                    <button class="btn btn-sm btn-link text-secondary"><i class="bx bx-show"></i></button>
                                    <button class="btn btn-sm btn-link text-secondary"><i class="bx bx-dots-vertical-rounded"></i></button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed, or loop over your users -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span>Showing 1 to 10 of 100 entries</span>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">…</a></li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /Users List Table -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>
@endsection
