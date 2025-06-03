<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
$usuario = $_SESSION['matricula'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel UTN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>UTTN</h4>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="#" class="active"><i class="fas fa-home"></i>Inicio</a></li>
                <li><a href="#"><i class="fas fa-user-times"></i>Deserción</a></li>
                <li><a href="#"><i class="fas fa-user-check"></i>Ingresados</a></li>
                <li><a href="#"><i class="fas fa-user-graduate"></i>Titulados</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i>Aprovechamiento</a></li>
                <li><a href="#"><i class="fas fa-user-slash"></i>Reprobados</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h2>Hola, <?php echo htmlspecialchars($usuario); ?></h2>
            <div class="search-box">
                <input type="text" placeholder="Buscar...">
                <i class="fas fa-search"></i>
            </div>
            <div class="user-info">
                <img src="img/peakpx.jpg" class="user-avatar" alt="user">
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card-modern">
                <h5 class="card-title">Resumen General</h5>
                <div class="summary-grid">
                    <div class="summary-item">
                        <span class="summary-label">Total de archivos:</span>
                        <span class="summary-value">5</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Último Procesamiento:</span>
                        <span class="summary-value">30/05/2024</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Programas Analizados:</span>
                        <span class="summary-value summary-highlight">4</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Estudiantes Registrados:</span>
                        <span class="summary-value">1,200</span>
                    </div>
                </div>
                <div class="progress-container">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                    </div>
                    <div style="text-align: right; margin-top: 8px; font-size: 14px; font-weight: 600; color: #64748b;">80%</div>
                </div>
            </div>

            <div class="card-modern">
                <h5 class="card-title">Tasa de Titulación</h5>
                <div class="chart-container">
                    <canvas id="graficaTitulacion" width="180" height="180"></canvas>
                    <div class="chart-percentage">85%</div>
                </div>
                <div style="text-align: center;">
                    <span class="chart-growth">+15% vs 2021</span>
                </div>
            </div>

            <div class="card-modern">
                <h5 class="card-title">Cargar Datos</h5>
                <div class="upload-area">
                    <div class="upload-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="upload-text">Arrastra un archivo Excel o haz clic para seleccionar</div>
                    <div class="upload-subtext">Formatos soportados: .xlsx, .xls</div>
                    <input type="file" style="display: none;" id="fileInput" accept=".xlsx,.xls">
                </div>
            </div>

            <div class="card-modern files-section">
                <h5 class="card-title">Archivos Cargados</h5>
                <div class="files-grid">
                    <div class="file-card">
                        <div class="file-header">
                            <span class="file-name">Datos_2024A.xlsx</span>
                            <span class="file-status status-procesado">Procesado</span>
                        </div>
                        <div class="file-info">
                            <div class="file-stat">
                                <div class="file-stat-value">15/04/2024</div>
                                <div class="file-stat-label">Fecha</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">400</div>
                                <div class="file-stat-label">Registros</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">Ver</div>
                                <div class="file-stat-label">Acciones</div>
                            </div>
                        </div>
                        <div class="file-actions">
                            <a href="#" class="btn-action btn-delete">Eliminar</a>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-header">
                            <span class="file-name">Datos_2023B.xlsx</span>
                            <span class="file-status status-cargado">Cargado</span>
                        </div>
                        <div class="file-info">
                            <div class="file-stat">
                                <div class="file-stat-value">12/09/2023</div>
                                <div class="file-stat-label">Fecha</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">460</div>
                                <div class="file-stat-label">Registros</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">Ver</div>
                                <div class="file-stat-label">Acciones</div>
                            </div>
                        </div>
                        <div class="file-actions">
                            <a href="#" class="btn-action btn-delete">Eliminar</a>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-header">
                            <span class="file-name">Datos_2023A.xlsx</span>
                            <span class="file-status status-ingresado">Ingresado</span>
                        </div>
                        <div class="file-info">
                            <div class="file-stat">
                                <div class="file-stat-value">08/03/2023</div>
                                <div class="file-stat-label">Fecha</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">385</div>
                                <div class="file-stat-label">Registros</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">Ver</div>
                                <div class="file-stat-label">Acciones</div>
                            </div>
                        </div>
                        <div class="file-actions">
                            <a href="#" class="btn-action btn-delete">Eliminar</a>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-header">
                            <span class="file-name">Datos_2022B.xlsx</span>
                            <span class="file-status status-archivado">Archivado</span>
                        </div>
                        <div class="file-info">
                            <div class="file-stat">
                                <div class="file-stat-value">20/11/2022</div>
                                <div class="file-stat-label">Fecha</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">310</div>
                                <div class="file-stat-label">Registros</div>
                            </div>
                            <div class="file-stat">
                                <div class="file-stat-value">Ver</div>
                                <div class="file-stat-label">Acciones</div>
                            </div>
                        </div>
                        <div class="file-actions">
                            <a href="#" class="btn-action btn-delete">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfica de dona
        const ctx = document.getElementById('graficaTitulacion').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Titulado', 'No Titulado'],
                datasets: [{
                    data: [85, 15],
                    backgroundColor: ['#10b981', '#e5e7eb'],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });

        // Funcionalidad del área de carga
        document.querySelector('.upload-area').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                alert('Archivo seleccionado: ' + e.target.files[0].name);
            }
        });

        // Drag and drop
        document.querySelector('.upload-area').addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#059669';
        });

        document.querySelector('.upload-area').addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#10b981';
        });

        document.querySelector('.upload-area').addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#10b981';
            if (e.dataTransfer.files.length > 0) {
                alert('Archivo cargado: ' + e.dataTransfer.files[0].name);
            }
        });
    </script>
</body>
</html>