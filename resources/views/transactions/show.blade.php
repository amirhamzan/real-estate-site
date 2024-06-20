<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">{{ $transaction->property->name }}</h6>
                                    <p class="text-sm mb-1">{{ $transaction->property->address }}</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <!-- <button type="button" disabled class="btn btn-sm btn-dark px-2 py-2 btn-icon">Edit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button> -->
                                    <button disabled type="button" class="btn btn-sm btn-dark btn-icon me-2">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Edit</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <!-- <p class="text-sm mb-4">
                                Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally
                                difficult paths, choose the one more painful in the short term (pain avoidance is
                                creating an illusion of equality).
                            </p> -->
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Date Issued:</span> &nbsp; {{ $transaction->created_at }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Request price ($):</span> &nbsp; {{ number_format( $transaction->property->price, 2, '.', ',') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Sale/Lease Price ($):</span> &nbsp; <span class="text-lg font-weight-bolder text-success">{{ number_format( $transaction->price, 2, '.', ',') }}</span>
                                </li>
                                <div class="table-responsive py-5">
                                    <table class="table align-items-center mb-0">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Salesperson</th>
                                                <th class="text-secondary text-center text-xs font-weight-semibold opacity-7 ps-2">
                                                    Percentage (%)</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Commission ($)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transaction->transactionUsers as $transaction)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-secondary text-sm font-weight-normal">
                                                                {{ $transaction->user->name }}
                                                            </h6>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $transaction->user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">{{ $transaction->percentage }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-success text-lg font-weight-bolder">{{ number_format( $transaction->commission, 2, '.', ',') }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a class="text-secondary font-weight-bold" data-bs-toggle="tooltip" data-bs-title="Download report">
                                                        <i class="fa-solid fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td class="text-center">No Data</td>
                                            </tr>
                                            @endforelse
                                            <tr class="bg-gray-100">
                                                <td class="align-middle text-start">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-secondary text-sm font-weight-normal">
                                                                TOTAL
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">{{ number_format( $total_percentage, 2, '.', ',') }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">{{ number_format( $total_commission, 2, '.', ',') }}</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>