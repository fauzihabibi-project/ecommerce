<div class="container-fluid">

    <!-- ROW CARD -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #287fa7ff, #5ca6d1ff);">
                <div class="card-body text-white">
                    <h5 class="card-title fw-semibold text-white">Income</h5>
                    <p class="text-muted small mb-0 text-white">Total of all sales</p>
                    <h2 class="fw-bold mt-2 mb-0 text-white">
                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW CARD -->


    <div class="row">
        <!-- Grafik Batang -->
        <div class="col-lg-8 d-flex mb-4">
            <div class="card shadow-sm border-0 w-100" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title fw-semibold">Sales report</h5>
                    <p class="text-muted small mb-0">Sales report based on months</p>
                </div>
                <div class="card-body">
                    <div id="grafik-penjualan" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>

        <!-- Grafik Pie -->
        <div class="col-lg-4 d-flex mb-4">
            <div class="card shadow-sm border-0 w-100" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title fw-semibold">Categories Sold</h5>
                    <p class="text-muted small mb-0">Percentage of product categories sold</p>
                </div>
                <div class="card-body">
                    <div id="grafik-kategori" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    let laporanPenjualan = @json($laporanPenjualan);
    let kategoriTerjual = @json($kategoriTerjual);

    let months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    // ================== GRAFIK BATANG MODERN ====================
    new ApexCharts(document.querySelector("#grafik-penjualan"), {
        series: [{
            name: 'Total Order',
            data: months.map((m,i) => laporanPenjualan[String(i+1).padStart(2, '0')] ?? 0)
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '45%',
            }
        },
        colors: ['#4e73df'],
        dataLabels: { enabled: false },
        xaxis: { 
            categories: months,
            labels: { style: { fontSize: '13px' } }
        },
        grid: { borderColor: '#f1f1f1' }
    }).render();


    // ================== GRAFIK PIE MODERN ====================
    new ApexCharts(document.querySelector("#grafik-kategori"), {
        series: Object.values(kategoriTerjual),
        labels: Object.keys(kategoriTerjual),
        chart: { 
            type: 'donut', 
            height: 350 
        },
        legend: { position: 'bottom' },
        stroke: { width: 0 },
        dataLabels: { enabled: true },
        colors: ['#ff6384','#36a2eb','#4bc0c0','#9966ff','#f7b731','#fa8231'],
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total'
                        }
                    }
                }
            }
        }
    }).render();
</script>
@endpush
