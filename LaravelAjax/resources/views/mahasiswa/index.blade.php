<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Mahasiswa</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1e429f;
            --accent: #f59e0b;
            --bg: #f0f4ff;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== HEADER ===== */
        .site-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            padding: 2.5rem 0 3.5rem;
            position: relative;
            overflow: hidden;
        }

        .site-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 40px;
            background: var(--bg);
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .site-header .badge-label {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            margin-bottom: 0.75rem;
        }

        .site-header h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 0.4rem;
        }

        .site-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 1.5rem 0 4rem;
        }

        /* ===== CARD PANEL ===== */
        .panel {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .panel-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .panel-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-title i {
            color: var(--primary);
        }

        /* ===== TOMBOL ===== */
        .btn-fetch {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(26,86,219,0.3);
        }

        .btn-fetch:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 16px rgba(26,86,219,0.4);
        }

        .btn-fetch:active { transform: scale(0.97); }

        .btn-fetch:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        /* ===== AREA HASIL ===== */
        #result-area {
            padding: 1.5rem;
            min-height: 220px;
        }

        /* Placeholder kosong */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 160px;
            color: var(--text-muted);
            text-align: center;
            gap: 0.75rem;
        }

        .empty-state i {
            font-size: 2.5rem;
            opacity: 0.35;
        }

        .empty-state p {
            font-size: 0.875rem;
        }

        /* Loading spinner */
        .loading-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 160px;
            gap: 1rem;
            color: var(--text-muted);
        }

        .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== TABEL ===== */
        .table-wrapper {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeUp 0.4s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .data-table thead {
            background: var(--primary);
            color: white;
        }

        .data-table thead th {
            padding: 0.85rem 1rem;
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .data-table tbody tr:last-child { border-bottom: none; }

        .data-table tbody tr:hover { background: #f8faff; }

        .data-table tbody td {
            padding: 0.9rem 1rem;
            vertical-align: middle;
        }

        .nim-badge {
            display: inline-block;
            background: #eff6ff;
            color: var(--primary);
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 0.15rem 0.55rem;
            font-size: 0.78rem;
            font-weight: 600;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.03em;
        }

        .kelas-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .prodi-tag {
            display: inline-block;
            background: #f0fdf4;
            color: #065f46;
            border: 1px solid #bbf7d0;
            border-radius: 50px;
            padding: 0.2rem 0.65rem;
            font-size: 0.78rem;
            font-weight: 500;
        }

        /* Row counter */
        .data-table tbody tr td:first-child {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* ===== FOOTER INFO ===== */
        .result-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 1rem;
        }

        .result-info i { color: var(--success); }

        /* ===== FOOTER PAGE ===== */
        .site-footer {
            text-align: center;
            padding: 1.5rem 0;
            font-size: 0.78rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <header class="site-header">
        <div class="container">
            <div class="badge-label">
                <i class="bi bi-mortarboard-fill me-1"></i> Sistem Informasi Akademik
            </div>
            <h1>Data Mahasiswa</h1>
            <p>Klik tombol di bawah untuk menampilkan data mahasiswa secara dinamis.</p>
        </div>
    </header>

    {{-- KONTEN UTAMA --}}
    <main class="main-content">
        <div class="container">
            <div class="panel">
                {{-- Panel Header --}}
                <div class="panel-header">
                    <div class="panel-title">
                        <i class="bi bi-table"></i>
                        Daftar Mahasiswa
                    </div>
                    <button class="btn-fetch" id="btnTampilkan" onclick="tampilkanData()">
                        <i class="bi bi-database-down"></i>
                        Tampilkan Data
                    </button>
                </div>

                {{-- Area Hasil --}}
                <div id="result-area">
                    {{-- Kondisi awal: kosong --}}
                    <div class="empty-state" id="emptyState">
                        <i class="bi bi-inbox"></i>
                        <p>Data belum dimuat.<br>Klik tombol <strong>Tampilkan Data</strong> untuk memulai.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="container">
            &copy; {{ date('Y') }} &mdash; Raka Andriy Shevchenko &bull; Tugas Laravel Ajax
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function tampilkanData() {
            const btn        = document.getElementById('btnTampilkan');
            const resultArea = document.getElementById('result-area');

            // Tampilkan loading
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner" style="width:18px;height:18px;border-width:2px;display:inline-block;vertical-align:middle;margin-right:6px;"></span> Memuat...';

            resultArea.innerHTML = `
                <div class="loading-state">
                    <div class="spinner"></div>
                    <span>Mengambil data mahasiswa...</span>
                </div>
            `;

            // AJAX ke route /mahasiswa/data
            fetch('{{ route("mahasiswa.data") }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengambil data.');
                return response.json();
            })
            .then(result => {
                if (result.success && result.data.length > 0) {
                    renderTabel(result.data);
                } else {
                    resultArea.innerHTML = `
                        <div class="empty-state">
                            <i class="bi bi-exclamation-circle"></i>
                            <p>Data tidak ditemukan.</p>
                        </div>`;
                }
            })
            .catch(err => {
                resultArea.innerHTML = `
                    <div class="empty-state" style="color:#ef4444">
                        <i class="bi bi-wifi-off"></i>
                        <p>${err.message}</p>
                    </div>`;
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Refresh Data';
            });
        }

        function renderTabel(data) {
            const resultArea = document.getElementById('result-area');

            // Buat baris tabel
            const rows = data.map((mhs, i) => `
                <tr>
                    <td>${i + 1}</td>
                    <td><strong>${mhs.nama}</strong></td>
                    <td><span class="nim-badge">${mhs.nim}</span></td>
                    <td><span class="kelas-badge">${mhs.kelas}</span></td>
                    <td><span class="prodi-tag">${mhs.prodi}</span></td>
                </tr>
            `).join('');

            resultArea.innerHTML = `
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="bi bi-person me-1"></i>Nama</th>
                                <th><i class="bi bi-card-text me-1"></i>NIM</th>
                                <th><i class="bi bi-bookmark me-1"></i>Kelas</th>
                                <th><i class="bi bi-building me-1"></i>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${rows}
                        </tbody>
                    </table>
                </div>
                <div class="result-info">
                    <i class="bi bi-check-circle-fill"></i>
                    Berhasil memuat <strong>${data.length} data</strong> mahasiswa dari file JSON lokal.
                </div>
            `;
        }
    </script>
</body>
</html>
