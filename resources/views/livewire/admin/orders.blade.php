<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Orders</h5>

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
                                        <h6 class="fw-semibold mb-0">Address</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Courier</h6>
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
                                @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->user->name ?? 'User Dihapus' }}</td>
                                    <td>
                                        {{ $order->address->recipient_name ?? '-' }}<br>
                                        <small class="text-muted">
                                            {{ $order->address->city->name ?? '' }},
                                            {{ $order->address->province->name ?? '' }}
                                        </small>
                                    </td>
                                    <td>{{ $order->courier ?? '-' }}</td>
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                        $statusColor = match($order->status) {
                                        'Menunggu Pembayaran' => 'warning',
                                        'Dikemas' => 'info',
                                        'Dikirim' => 'primary',
                                        'Selesai' => 'success',
                                        default => 'secondary',
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('order.detail', $order->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <button wire:click="$dispatch('confirm-delete', { id: {{ $order->id }} })"
                                                class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        No orders yet
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
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('confirm-delete', data => {

            Swal.fire({
                title: 'Delete Order?',
                text: "This order will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteOrder', {
                        id: data.id
                    });
                }
            });

        });
    });
</script>
@endpush