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
    // 4. FORM VALIDATION & FILE UPLOAD DENGAN PRATINJAU (BUAT LAPORAN)
    // ----------------------------------------------------
    const formBuatLaporan = document.getElementById('form-buat-laporan');
    const fileInput = document.getElementById('input-foto');
    const dropZone = document.getElementById('drop-foto');
    const dropTitle = document.getElementById('drop-title');
    const dropSubtitle = document.getElementById('drop-subtitle');
    const alertError = document.getElementById('alert-error-form');

    const previewWrapper = document.getElementById('foto-preview-wrapper');
    const previewImg = document.getElementById('foto-preview-img');
    const previewName = document.getElementById('foto-preview-name');
    const previewSize = document.getElementById('foto-preview-size');
    const btnGantiFoto = document.getElementById('btn-ganti-foto');
    const btnHapusFoto = document.getElementById('btn-hapus-foto');
    const fotoErrorMsg = document.getElementById('foto-error-msg');
    const photoGroup = document.getElementById('group-foto');

    let currentPreviewUrl = null;

    function formatFileSize(bytes) {
        if (!bytes || bytes === 0) return '0 B';
        if (bytes >= 1024 * 1024) {
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }
        return (bytes / 1024).toFixed(1) + ' KB';
    }

    function bersihkanFoto() {
        if (fileInput) {
            fileInput.value = '';
        }
        if (currentPreviewUrl) {
            URL.revokeObjectURL(currentPreviewUrl);
            currentPreviewUrl = null;
        }
        if (previewImg) previewImg.src = '';
        if (previewWrapper) previewWrapper.style.display = 'none';
        if (dropZone) {
            dropZone.style.display = 'block';
            dropZone.classList.remove('is-invalid');
        }
        if (photoGroup) photoGroup.classList.remove('err');
    }

    function handleFile(file) {
        if (!file) return;

        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        const isValidType = validTypes.includes(file.type.toLowerCase()) || /\.(jpe?g|png|webp)$/i.test(file.name);
        const isValidSize = file.size <= 5 * 1024 * 1024; // 5 MB

        if (!isValidType) {
            bersihkanFoto();
            if (photoGroup) photoGroup.classList.add('err');
            if (dropZone) dropZone.classList.add('is-invalid');
            if (fotoErrorMsg) {
                fotoErrorMsg.textContent = 'Format foto harus berupa JPG, PNG, atau WEBP.';
                fotoErrorMsg.style.display = 'block';
            }
            return;
        }

        if (!isValidSize) {
            bersihkanFoto();
            if (photoGroup) photoGroup.classList.add('err');
            if (dropZone) dropZone.classList.add('is-invalid');
            if (fotoErrorMsg) {
                fotoErrorMsg.textContent = 'Ukuran foto maksimal 5 MB.';
                fotoErrorMsg.style.display = 'block';
            }
            return;
        }

        // Foto valid: Bersihkan error dan tampilkan pratinjau
        if (photoGroup) photoGroup.classList.remove('err');
        if (dropZone) {
            dropZone.classList.remove('is-invalid');
            dropZone.style.display = 'none';
        }
        if (fotoErrorMsg) fotoErrorMsg.style.display = 'none';

        if (currentPreviewUrl) {
            URL.revokeObjectURL(currentPreviewUrl);
        }
        currentPreviewUrl = URL.createObjectURL(file);

        if (previewImg) previewImg.src = currentPreviewUrl;
        if (previewName) previewName.textContent = file.name;
        if (previewSize) previewSize.textContent = formatFileSize(file.size);
        if (previewWrapper) previewWrapper.style.display = 'block';
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
                    // Fallback
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

    if (btnGantiFoto && fileInput) {
        btnGantiFoto.addEventListener('click', () => {
            fileInput.click();
        });
    }

    if (btnHapusFoto) {
        btnHapusFoto.addEventListener('click', () => {
            bersihkanFoto();
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

            const hasPhoto = fileInput && fileInput.files && fileInput.files.length > 0;
            if (!hasPhoto) {
                if (photoGroup) {
                    photoGroup.classList.add('err');
                    if (dropZone) dropZone.classList.add('is-invalid');
                    if (fotoErrorMsg) {
                        fotoErrorMsg.textContent = 'Foto bukti kerusakan wajib diunggah.';
                        fotoErrorMsg.style.display = 'block';
                    }
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
    // 5. MODAL LIGHTBOX FOTO DETAIL LAPORAN
    // ----------------------------------------------------
    window.bukaLightbox = function (src, caption) {
        let modal = document.getElementById('modal-lightbox');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'modal-lightbox';
            modal.className = 'lightbox-modal';
            modal.innerHTML = `
                <div class="lightbox-content" onclick="event.stopPropagation()">
                    <button type="button" class="lightbox-close" onclick="tutupLightbox()">&times;</button>
                    <img id="lightbox-img" src="" alt="Pratinjau Foto Penuh">
                    <div id="lightbox-caption" class="lightbox-caption"></div>
                </div>
            `;
            modal.addEventListener('click', window.tutupLightbox);
            document.body.appendChild(modal);
        }

        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        if (img) img.src = src;
        if (cap) cap.textContent = caption || '';

        modal.classList.add('on');
        document.body.style.overflow = 'hidden';
    };

    window.tutupLightbox = function () {
        const modal = document.getElementById('modal-lightbox');
        if (modal) {
            modal.classList.remove('on');
        }
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            window.tutupLightbox();
        }
    });

    // ----------------------------------------------------
    // 6. LOGIN FORM VALIDATION (CLIENT-SIDE)
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
