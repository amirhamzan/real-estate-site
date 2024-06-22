<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">List of Authentication</h3>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-success text-dark text-sm" role="alert">
                <strong>Success!</strong> {{Session::get('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Authentication list</h6>
                                    <p class="text-sm">See information about all authentications</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    {{-- <button type="button" class="btn btn-sm btn-white me-2">
                                        View all
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">

                            <div class="card-body px-0 py-0">

                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                                                <th class="text-secondary text-center text-xs font-weight-semibold opacity-7 ps-2">
                                                    User</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    IP</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Agent</th>
                                                <th class="text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($auth_logs as $auth_log)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-secondary text-sm font-weight-normal">
                                                                {{ $auth_log->id }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">{{ $auth_log->user->name }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-success text-lg font-weight-bolder">{{ $auth_log->ip_address }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">{{ $auth_log->user_agent }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    @php
                                                    if($auth_log->action = 1) {
                                                    $badge_style = 'border-success text-success bg-success';
                                                    $badge_text = 'Login';
                                                    } else {
                                                    $badge_style = 'border-danger text-danger bg-danger';
                                                    $badge_text = 'Logout';
                                                    }
                                                    @endphp
                                                    <span class="badge badge-sm border {{ $badge_style }}">{{ $badge_text }}</span>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">No Data</span>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{ $auth_logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <x-app.footer />
            </div>
    </main>

</x-app-layout>