<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari Laravel
        const distribusiData = @json($distribusi);
        const modulPopulerData = @json($modulPopuler);
        const skorRataData = @json($skorRataModul);

        // 1. Donut Chart - Distribusi Penyelesaian
        new Chart(document.getElementById('distribusiChart'), {
            type: 'doughnut',
            data: {
                labels: distribusiData.map(d => d.status),
                datasets: [{
                    data: distribusiData.map(d => d.total),
                    backgroundColor: ['#033E8A', '#60a5fa', '#e5e7eb'],
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // 2. Bar Chart - Modul Terpopuler
        new Chart(document.getElementById('modulPopulerChart'), {
            type: 'bar',
            data: {
                labels: modulPopulerData.map(d => d.modul ? d.modul.judul_modul : '-'),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: modulPopulerData.map(d => d.total),
                    backgroundColor: '#033E8A',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // 3. Bar Chart - Skor Rata-rata per Modul
        new Chart(document.getElementById('skorRataChart'), {
            type: 'bar',
            data: {
                labels: skorRataData.map(d => d.modul ? d.modul.judul_modul : '-'),
                datasets: [{
                    label: 'Skor Rata-rata',
                    data: skorRataData.map(d => parseFloat(d.rata_skor).toFixed(1)),
                    backgroundColor: '#60a5fa',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, max: 100 } }
            }
        });
    });
</script>