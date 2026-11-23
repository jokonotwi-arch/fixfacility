/**
 * FixFacility - Frontend Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
    // ----------------------------------------------------
    // 1. MODAL KONFIRMASI HAPUS
    // ----------------------------------------------------
    const deleteModal = document.getElementById('modal-konfirmasi-hapus');
    const deleteModalTitle = document.getElementById('modal-hapus-title');
    const deleteModalDesc = document.getElementById('modal-hapus-desc');
    const deleteModalForm = document.getElementById('modal-hapus-form');

    window.bukaModalHapus = function (kode, judul, url) {
        if (!deleteModal) return;
        if (deleteModalTitle) deleteModalTitle.textContent = 'Hapus laporan ini?';
        if (deleteModalDesc) {
            deleteModalDesc.textContent = `Laporan ${kode} — ${judul} akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.`;
        }
        if (deleteModalForm && url) {
            deleteModalForm.action = url;
        }
        deleteModal.classList.add('on');
    };

    window.tutupModalHapus = function () {
        if (deleteModal) {
            deleteModal.classList.remove('on');
        }
    };

    if (deleteModal) {
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                tutupModalHapus();
            }
        });
    }

    // ----------------------------------------------------
    // MODAL KONFIRMASI LOGOUT
    // ----------------------------------------------------
    const logoutModal = document.getElementById('modal-konfirmasi-logout');

    window.bukaModalLogout = function () {
        if (logoutModal) {
            logoutModal.classList.add('on');
        }
    };

    window.tutupModalLogout = function () {
        if (logoutModal) {
            logoutModal.classList.remove('on');
        }
    };

    if (logoutModal) {
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                tutupModalLogout();
            }
        });
    }

    // ----------------------------------------------------
    // 2. ADMIN STATUS CHIPS & SELECT SYNC
    // ----------------------------------------------------
    const statusSelect = document.getElementById('status-select');
    const statusChips = document.querySelectorAll('.chips .chip-status');

    if (statusSelect && statusChips.length) {
        statusChips.forEach(chip => {
            chip.addEventListener('click', () => {
                const val = chip.getAttribute('data-status');
                statusSelect.value = val;
                statusChips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
            });
        });

        statusSelect.addEventListener('change', () => {
            const val = statusSelect.value;
            statusChips.forEach(chip => {
                if (chip.getAttribute('data-status') === val) {
                    chip.classList.add('active');
                } else {
                    chip.classList.remove('active');
                }
            });
        });
    }

    // ----------------------------------------------------
    // 3. FORM VALIDATION & FILE UPLOAD (BUAT LAPORAN)
    // ----------------------------------------------------
    const formBuatLaporan = document.getElementById('form-buat-laporan');
    const fileInput = document.getElementById('input-foto');
    const dropZone = document.getElementById('drop-foto');
    const dropTitle = document.getElementById('drop-title');
    const dropSubtitle = document.getElementById('drop-subtitle');
    const alertError = document.getElementById('alert-error-form');
    let uploadedFile = null;

    if (dropZone && fileInput) {
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = 'var(--pr)';
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '';
            if (e.dataTransfer.files && e.dataTransfer.files.length) {
                handleFile(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files.length) {
                handleFile(fileInput.files[0]);
            }
        });
    }

    function handleFile(file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const isValidType = validTypes.includes(file.type);
        const isValidSize = file.size <= 5 * 1024 * 1024; // 5 MB

        const photoGroup = document.getElementById('group-foto');

        if (!isValidType || !isValidSize) {
            uploadedFile = null;
            if (photoGroup) photoGroup.classList.add('err');
            if (dropTitle) dropTitle.textContent = '+ Klik untuk memilih foto atau seret file ke sini';
            if (dropSubtitle) dropSubtitle.textContent = 'Format JPG atau PNG • Maksimal 5 MB';
        } else {
            uploadedFile = file;
            if (photoGroup) photoGroup.classList.remove('err');
            if (dropTitle) dropTitle.textContent = file.name;
            if (dropSubtitle) dropSubtitle.textContent = 'Foto siap dikirim. (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)';
        }
    }

    if (formBuatLaporan) {
        formBuatLaporan.addEventListener('submit', (e) => {
            let hasError = false;
            const requiredFields = ['judul', 'fasilitas', 'lokasi', 'kategori', 'deskripsi'];

            requiredFields.forEach(fieldName => {
                const input = formBuatLaporan.querySelector(`[name="${fieldName}"]`);
                if (input) {
                    const group = input.closest('.g');
                    if (!input.value.trim()) {
                        if (group) group.classList.add('err');
                        hasError = true;
                    } else {
                        if (group) group.classList.remove('err');
                    }
                }
            });

            const photoGroup = document.getElementById('group-foto');
            if (!uploadedFile && (!fileInput || !fileInput.files.length)) {
                if (photoGroup) {
                    photoGroup.classList.add('err');
                    if (dropTitle) dropTitle.textContent = 'Belum ada foto yang diunggah';
                    if (dropSubtitle) dropSubtitle.textContent = 'Format JPG, PNG • Maksimal 5 MB • Minimal 1 foto';
                }
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                if (alertError) alertError.classList.add('show');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return false;
            } else {
                if (alertError) alertError.classList.remove('show');
            }
        });
    }

    // ----------------------------------------------------
    // 4. LOGIN FORM VALIDATION & DEMO ROUTING
    // ----------------------------------------------------
    const loginForm = document.getElementById('form-login');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const nimInput = document.getElementById('nim');
            const pwInput = document.getElementById('password');
            const g1 = document.getElementById('g-nim');
            const g2 = document.getElementById('g-password');

            const nimVal = nimInput ? nimInput.value.trim() : '';
            const pwVal = pwInput ? pwInput.value : '';

            let hasError = false;

            if (!nimVal) {
                if (g1) g1.classList.add('err');
                hasError = true;
            } else {
                if (g1) g1.classList.remove('err');
            }

            if (!pwVal) {
                if (g2) g2.classList.add('err');
                hasError = true;
            } else {
                if (g2) g2.classList.remove('err');
            }

            // Demo verification
            if (!hasError) {
                const isAdmin = nimVal.toLowerCase() === 'admin';
                const isPelapor = /^[A-Za-z0-9]{5,}$/.test(nimVal);

                if (!isAdmin && !isPelapor) {
                    if (g1) g1.classList.add('err');
                    hasError = true;
                } else if (pwVal !== '12345678') {
                    if (g2) g2.classList.add('err');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                    return false;
                }

                // If demo credentials match, navigate seamlessly
                if (isAdmin) {
                    window.location.href = '/admin/dashboard';
                    e.preventDefault();
                    return false;
                } else {
                    window.location.href = '/pelapor/dashboard';
                    e.preventDefault();
                    return false;
                }
            } else {
                e.preventDefault();
            }
        });
    }

    // ----------------------------------------------------
    // 5. ADMIN FILTER & SEARCH TABLE
    // ----------------------------------------------------
    const searchInput = document.getElementById('filter-search');
    const statusFilter = document.getElementById('filter-status');
    const kategoriFilter = document.getElementById('filter-kategori');
    const btnTerapkan = document.getElementById('btn-filter-terapkan');
    const tableBody = document.getElementById('laporan-tbody');
    const countText = document.getElementById('laporan-count-text');

    function applyAdminFilters() {
        if (!tableBody) return;
        const q = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const s = statusFilter ? statusFilter.value : '';
        const c = kategoriFilter ? kategoriFilter.value : '';

        const rows = tableBody.querySelectorAll('tr[data-kode]');
        let visibleCount = 0;

        rows.forEach(row => {
            const kode = (row.getAttribute('data-kode') || '').toLowerCase();
            const judul = (row.getAttribute('data-judul') || '').toLowerCase();
            const pelapor = (row.getAttribute('data-pelapor') || '').toLowerCase();
            const status = row.getAttribute('data-status') || '';
            const kategori = row.getAttribute('data-kategori') || '';

            const matchQuery = !q || kode.includes(q) || judul.includes(q) || pelapor.includes(q);
            const matchStatus = !s || status === s;
            const matchKategori = !c || kategori === c;

            if (matchQuery && matchStatus && matchKategori) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Handle empty row
        let noMatchRow = document.getElementById('row-no-match');
        if (visibleCount === 0) {
            if (!noMatchRow) {
                noMatchRow = document.createElement('tr');
                noMatchRow.id = 'row-no-match';
                noMatchRow.innerHTML = '<td colspan="7" style="text-align:center;color:var(--mu);padding:24px;">Tidak ada laporan yang cocok.</td>';
                tableBody.appendChild(noMatchRow);
            }
            noMatchRow.style.display = '';
        } else if (noMatchRow) {
            noMatchRow.style.display = 'none';
        }

        if (countText) {
            countText.textContent = `${visibleCount} laporan ditemukan`;
        }
    }

    if (btnTerapkan) {
        btnTerapkan.addEventListener('click', (e) => {
            e.preventDefault();
            applyAdminFilters();
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                applyAdminFilters();
            }
        });
    }
});
