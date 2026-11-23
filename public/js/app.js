/**
 * FixFacility - Frontend Interactions & UI UX
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
    // 2. MODAL KONFIRMASI LOGOUT
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
    // 3. ADMIN STATUS CHIPS & SELECT SYNC
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
    // 4. FORM VALIDATION & FILE UPLOAD (BUAT LAPORAN)
    // ----------------------------------------------------
    const formBuatLaporan = document.getElementById('form-buat-laporan');
    const fileInput = document.getElementById('input-foto');
    const dropZone = document.getElementById('drop-foto');
    const dropTitle = document.getElementById('drop-title');
    const dropSubtitle = document.getElementById('drop-subtitle');
    const alertError = document.getElementById('alert-error-form');

    function handleFile(file) {
        if (!file) return;

        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const isValidType = validTypes.includes(file.type);
        const isValidSize = file.size <= 5 * 1024 * 1024; // 5 MB

        const photoGroup = document.getElementById('group-foto');

        if (!isValidType || !isValidSize) {
            if (photoGroup) photoGroup.classList.add('err');
            if (dropZone) dropZone.classList.add('is-invalid');
            if (dropTitle) dropTitle.textContent = '+ Klik untuk memilih foto atau seret file ke sini';
            if (dropSubtitle) dropSubtitle.textContent = 'Format JPG atau PNG • Maksimal 5 MB';
        } else {
            if (photoGroup) photoGroup.classList.remove('err');
            if (dropZone) dropZone.classList.remove('is-invalid');
            if (dropTitle) dropTitle.textContent = file.name;
            if (dropSubtitle) dropSubtitle.textContent = 'Foto siap dikirim (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)';
        }
    }

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
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                try {
                    fileInput.files = e.dataTransfer.files;
                } catch (err) {
                    // Fallback for older browsers
                }
                handleFile(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files.length) {
                handleFile(fileInput.files[0]);
            }
        });
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
            const hasPhoto = fileInput && fileInput.files && fileInput.files.length > 0;
            if (!hasPhoto) {
                if (photoGroup) {
                    photoGroup.classList.add('err');
                    if (dropZone) dropZone.classList.add('is-invalid');
                    if (dropTitle) dropTitle.textContent = 'Belum ada foto yang diunggah';
                    if (dropSubtitle) dropSubtitle.textContent = 'Format JPG, PNG • Maksimal 5 MB • Minimal 1 foto';
                }
                hasError = true;
            }

            // Hanya cegah pengiriman bila data tidak valid di sisi klien
            if (hasError) {
                e.preventDefault();
                if (alertError) alertError.classList.add('show');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return false;
            }

            // Jika valid, biarkan form terkirim ke backend
            if (alertError) alertError.classList.remove('show');
        });
    }

    // ----------------------------------------------------
    // 5. LOGIN FORM VALIDATION (CLIENT-SIDE)
    // ----------------------------------------------------
    const loginForm = document.getElementById('form-login');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const nimInput = document.getElementById('nim');
            const pwInput = document.getElementById('password');
            const g1 = document.getElementById('g-nim');
            const g2 = document.getElementById('g-password');
            const e1 = document.getElementById('e1');
            const e2 = document.getElementById('e2');

            const nimVal = nimInput ? nimInput.value.trim() : '';
            const pwVal = pwInput ? pwInput.value : '';

            let hasError = false;

            if (!nimVal) {
                if (g1) g1.classList.add('err');
                if (e1) e1.textContent = 'NIM/NIP wajib diisi.';
                hasError = true;
            } else {
                if (g1) g1.classList.remove('err');
            }

            if (!pwVal) {
                if (g2) g2.classList.add('err');
                if (e2) e2.textContent = 'Kata sandi wajib diisi.';
                hasError = true;
            } else {
                if (g2) g2.classList.remove('err');
            }

            // Hanya cegah submit bila ada field yang kosong di sisi klien
            if (hasError) {
                e.preventDefault();
                return false;
            }

            // Jika valid di sisi klien, biarkan form terkirim ke POST /login backend
        });
    }
});
