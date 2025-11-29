<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Transactions</h5>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">User</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Transaction Code</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Total</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Date</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $index => $transactions)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transactions->user->name ?? 'User Dihapus' }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $transactions->transaction_code ?? '' }}
                                        </small>
                                    </td>
                                    <td>Rp {{ number_format($transactions->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                        $statusColor = match($transactions->status) {
                                        'Gagal' => 'warning',
                                        'Berhasil' => 'success',
                                        default => 'secondary',
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ $transactions->status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($transactions->transaction_date)->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('order.detail', $transactions->order_id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        No Transactions Yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>