<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa XI RPL</title>
    <!-- CDN CSS Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }

        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
            padding: 14px 16px;
        }

        .table-custom tbody tr {
            transition: background-color 0.15s ease-in-out;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc !important;
        }

        .table-custom td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-nis {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        /* Styling Pagination Presisi */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination-container ul {
            display: flex;
            gap: 6px;
            padding: 0;
            margin: 0;
            list-style: none;
            align-items: center;
        }

        .pagination-container li {
            list-style: none !important;
            margin: 0;
        }

        .pagination-container li a, 
        .pagination-container li span {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .pagination-container li a:hover {
            background-color: #3b82f6;
            color: #ffffff;
            border-color: #3b82f6;
            transform: translateY(-1px);
        }

        .pagination-container li.active span,
        .pagination-container li.active a {
            background-color: #2563eb !important;
            color: #ffffff !important;
            border-color: #2563eb !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="#">
                Data Siswa XI RPL
            </a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mb-5">
        <div class="card card-custom p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h4 class="fw-bold m-0 text-dark">Daftar Siswa Terdaftar</h4>
                </div>
            </div>

            <!-- Form Bulk Delete & Action Buttons -->
            <form action="<?= site_url('home/hapus_semua'); ?>" method="POST" id="formBulkDelete">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type="button" class="btn btn-primary fw-semibold px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-lg"></i> Tambah Data Siswa
                    </button>
                    
                    <button type="submit" class="btn btn-danger fw-semibold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2" onclick="return confirm('Apakah kamu yakin ingin menghapus data yang dipilih?');">
                        <i class="bi bi-trash3"></i> Hapus Data Terpilih
                    </button>
                </div>

                <div class="table-responsive rounded-3 border">
                    <table class="table table-custom align-middle m-0">
                        <thead>
                            <tr>
                                <th scope="col" width="5%" class="text-center">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th scope="col" width="8%" class="text-center">No</th>
                                <th scope="col" width="18%">NIS</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col" width="20%">Kelas</th>
                                <th scope="col" width="18%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($siswa)) : ?>
                                <?php $no = 1 + (7 * ($pager->getCurrentPage() - 1)); ?>
                                <?php foreach ($siswa as $row) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="id_siswa[]" value="<?= $row['id']; ?>" class="form-check-input porsi-checkbox">
                                        </td>
                                        <td class="text-center fw-semibold text-muted"><?= $no++; ?></td>
                                        <td><span class="badge-nis"><?= $row['nis']; ?></span></td>
                                        <td class="fw-semibold text-dark"><?= $row['nama']; ?></td>
                                        <td><span class="badge bg-light text-secondary border px-2 py-1"><?= $row['kelas']; ?></span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-warning btn-sm text-white rounded-2 px-2 py-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>" title="Edit">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <a href="<?= site_url('home/hapus/' . $row['id']); ?>" 
                                                   class="btn btn-danger btn-sm rounded-2 px-2 py-1 shadow-sm" 
                                                   onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?');" title="Hapus">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data Siswa -->
                                    <div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow rounded-4">
                                                <div class="modal-header bg-warning text-white rounded-top-4">
                                                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Data Siswa</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="<?= site_url('home/edit/' . $row['id']); ?>" method="POST">
                                                    <div class="modal-body p-4">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">NIS</label>
                                                            <input type="text" name="nis" class="form-control rounded-3" value="<?= $row['nis']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nama Lengkap</label>
                                                            <input type="text" name="nama" class="form-control rounded-3" value="<?= $row['nama']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Kelas</label>
                                                            <input type="text" name="kelas" class="form-control rounded-3" value="<?= $row['kelas']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light border-0 rounded-bottom-4">
                                                        <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning text-white rounded-3 fw-semibold">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->

                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada data siswa.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>

            <!-- Navigasi Pagination -->
            <div class="mt-4 pagination-container">
                <?php if ($pager) : ?>
                    <?= $pager->links('default', 'default_full') ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Modal Tambah Data Siswa (Bulk Insert) -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-plus-fill me-2"></i>Tambah Data Siswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= site_url('home/tambah'); ?>" method="POST">
                    <div class="modal-body p-4">
                        <div id="wrapper-input">
                            <div class="row g-3 align-items-center mb-3 input-row border-bottom pb-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">NIS</label>
                                    <input type="text" name="nis[]" class="form-control rounded-3" placeholder="Masukkan NIS" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" name="nama[]" class="form-control rounded-3" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Kelas</label>
                                    <input type="text" name="kelas[]" class="form-control rounded-3" placeholder="Contoh: XI RPL 2" required>
                                </div>
                                <div class="col-md-1 text-end">
                                    <label class="form-label d-block">&nbsp;</label>
                                    <button type="button" class="btn btn-outline-danger btn-sm border-0" disabled><i class="bi bi-x-circle-fill fs-5"></i></button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="tambahBaris" class="btn btn-outline-primary btn-sm fw-semibold rounded-3 mt-2">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Baris Input
                        </button>
                    </div>
                    <div class="modal-footer bg-light border-0 rounded-bottom-4">
                        <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 fw-semibold">Simpan Semua Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CDN JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Dinamis -->
    <script>
        // 1. Script Tambah Baris Input Dinamis
        document.getElementById('tambahBaris').addEventListener('click', function() {
            let wrapper = document.getElementById('wrapper-input');
            let newRow = document.createElement('div');
            newRow.classList.add('row', 'g-3', 'align-items-center', 'mb-3', 'input-row', 'border-bottom', 'pb-3');
            newRow.innerHTML = `
                <div class="col-md-3">
                    <input type="text" name="nis[]" class="form-control rounded-3" placeholder="Masukkan NIS" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="nama[]" class="form-control rounded-3" placeholder="Nama Lengkap" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="kelas[]" class="form-control rounded-3" placeholder="Contoh: XI RPL 2" required>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm border-0 hapus-baris"><i class="bi bi-x-circle-fill fs-5"></i></button>
                </div>
            `;
            wrapper.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.hapus-baris')) {
                e.target.closest('.input-row').remove();
            }
        });

        // 2. Script Checkbox State Storage (localStorage)
        document.addEventListener("DOMContentLoaded", function() {
            let selectAll = document.getElementById('selectAll');
            let checkboxes = document.querySelectorAll('.porsi-checkbox');

            let savedIds = JSON.parse(localStorage.getItem('selectedSiswaIds')) || [];
            
            checkboxes.forEach((checkbox) => {
                if (savedIds.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });

            function updateLocalStorage() {
                let currentSavedIds = JSON.parse(localStorage.getItem('selectedSiswaIds')) || [];
                
                checkboxes.forEach((checkbox) => {
                    let id = checkbox.value;
                    if (checkbox.checked && !currentSavedIds.includes(id)) {
                        currentSavedIds.push(id);
                    } else if (!checkbox.checked && currentSavedIds.includes(id)) {
                        currentSavedIds = currentSavedIds.filter(item => item !== id);
                    }
                });

                localStorage.setItem('selectedSiswaIds', JSON.stringify(currentSavedIds));
            }

            if (selectAll) {
                selectAll.addEventListener('click', function() {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = this.checked;
                    });
                    updateLocalStorage();
                });
            }

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function() {
                    updateLocalStorage();
                });
            });

            let formBulkDelete = document.getElementById('formBulkDelete');
            if (formBulkDelete) {
                formBulkDelete.addEventListener('submit', function() {
                    localStorage.removeItem('selectedSiswaIds');
                });
            }
        });
    </script>
</body>
</html>