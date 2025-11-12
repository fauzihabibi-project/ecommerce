<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Laporan Penjualan</h5>
                        </div>
                    </div>
                    <div id="grafik-penjualan"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    let laporanPenjualan = @json($laporanPenjualan);
    let months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    new ApexCharts(document.querySelector("#grafik-penjualan"), {
        series: [{
            name: 'Laporan',
            data: months.map((m,i) => laporanPenjualan[String(i+1).padStart(2, '0')] ?? 0)
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        xaxis: {
            categories: months
        }
    }).render();
</script>
@endpush