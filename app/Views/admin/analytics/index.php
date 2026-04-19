<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-chart-line"></i> Deep Traffic Analytics</h1>
            <div class="header-actions">
                <select class="form-control" style="width: auto; display: inline-block;">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                </select>
                <button class="btn btn-primary"><i class="fas fa-sync"></i> REFRESH DATA</button>
            </div>
        </header>

        <!-- KPI Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px;">
            <div class="stat-card" style="border-bottom: 4px solid #4285F4;">
                <div class="stat-val">24,582</div>
                <div class="stat-label">DAILY VISITORS</div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #34A853;">
                <div class="stat-val">84,102</div>
                <div class="stat-label">PAGE VIEWS</div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #FBBC05;">
                <div class="stat-val">3m 42s</div>
                <div class="stat-label">AVG. DURATION</div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #EA4335;">
                <div class="stat-val">842</div>
                <div class="stat-label">LIVE READERS</div>
            </div>
        </div>

        <!-- Main Graphs Section -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; margin-bottom: 40px;">
            <!-- Visitors Line Chart -->
            <div class="admin-panel-box" style="padding: 30px;">
                <div class="box-header" style="margin-bottom: 20px;">
                    <h3>Visitor Growth (Last 7 Days)</h3>
                </div>
                <canvas id="visitorChart" style="max-height: 350px;"></canvas>
            </div>

            <!-- Categories Bar Chart -->
            <div class="admin-panel-box" style="padding: 30px;">
                <div class="box-header" style="margin-bottom: 20px;">
                    <h3>Popular Categories</h3>
                </div>
                <canvas id="categoryChart" style="max-height: 350px;"></canvas>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <!-- Traffic Sources -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Top Traffic Sources</h3>
                </div>
                <div style="padding: 25px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                         <span>Direct Traffic</span>
                         <strong>45%</strong>
                    </div>
                    <div style="height: 8px; background: #eee; border-radius: 4px; margin-bottom: 20px;">
                        <div style="width: 45%; height: 100%; background: #4285F4; border-radius: 4px;"></div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                         <span>Social Media</span>
                         <strong>32%</strong>
                    </div>
                    <div style="height: 8px; background: #eee; border-radius: 4px; margin-bottom: 20px;">
                        <div style="width: 32%; height: 100%; background: #34A853; border-radius: 4px;"></div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                         <span>Google Search</span>
                         <strong>18%</strong>
                    </div>
                    <div style="height: 8px; background: #eee; border-radius: 4px; margin-bottom: 20px;">
                        <div style="width: 18%; height: 100%; background: #FBBC05; border-radius: 4px;"></div>
                    </div>
                </div>
            </div>

            <!-- Device Distribution -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Device Breakdown</h3>
                </div>
                <div style="padding: 25px; display: flex; align-items: center; justify-content: center; gap: 40px; min-height: 250px;">
                    <div style="width: 200px; height: 200px;">
                        <canvas id="deviceChart"></canvas>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                            <div style="width: 12px; height: 12px; background: var(--admin-primary); border-radius: 2px;"></div>
                            <span style="font-weight: 700; font-size: 0.95rem;">82% Mobile</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                            <div style="width: 12px; height: 12px; background: #4a5568; border-radius: 2px;"></div>
                            <span style="font-weight: 700; font-size: 0.95rem;">15% Desktop</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 12px; height: 12px; background: #cbd5e0; border-radius: 2px;"></div>
                            <span style="font-weight: 700; font-size: 0.95rem;">3% Tablet</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Visitor Growth Chart
    const ctxVisitor = document.getElementById('visitorChart').getContext('2d');
    new Chart(ctxVisitor, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Unique Visitors',
                data: [12500, 15300, 14200, 19800, 24582, 21000, 23000],
                borderColor: '#4285F4',
                backgroundColor: 'rgba(66, 133, 244, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });

    // Category Chart
    const ctxCat = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCat, {
        type: 'bar',
        data: {
            labels: ['Punjab', 'Politics', 'Sports', 'Econ', 'Ent'],
            datasets: [{
                label: 'Views',
                data: [45000, 32000, 28000, 15000, 12000],
                backgroundColor: ['#CC2222', '#1a202c', '#1a202c', '#1a202c', '#1a202c'],
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { display: false }, x: { grid: { display: false } } }
        }
    });

    // Device Chart
    const ctxDev = document.getElementById('deviceChart').getContext('2d');
    new Chart(ctxDev, {
        type: 'doughnut',
        data: {
            labels: ['Mobile', 'Desktop', 'Tablet'],
            datasets: [{
                data: [82, 15, 3],
                backgroundColor: ['#CC2222', '#4a5568', '#cbd5e0'],
                borderWidth: 0
            }]
        },
        options: { 
            maintainAspectRatio: true,
            cutout: '70%', 
            plugins: { legend: { display: false } } 
        }
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
