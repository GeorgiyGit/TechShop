document.addEventListener('DOMContentLoaded', () => {
    initCharacteristics();
    initImageUpload();
});

function initCharacteristics() {
    const container = document.getElementById('characteristicsContainer');
    const addBtn = document.getElementById('addSpecBtn');
    if (!container || !addBtn) return;

    addBtn.addEventListener('click', () => {
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2 spec-row';
        row.innerHTML = `
            <div class="col-5">
                <input type="text" name="char_name[]" class="admin-form-control" placeholder="Name">
            </div>
            <div class="col-5">
                <input type="text" name="char_value[]" class="admin-form-control" placeholder="Value">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-admin-delete w-100 remove-spec">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>`;
        container.appendChild(row);
    });

    container.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-spec');
        if (btn) btn.closest('.spec-row').remove();
    });
}

function initImageUpload() {
    const input = document.getElementById('productImages');
    const preview = document.getElementById('imagePreviewContainer');
    if (!input || !preview) return;

    const form = input.closest('form');
    const isEdit = form?.querySelector('input[name="_method"]') !== null;
    const MIN_IMAGES = 2;

    const dt = new DataTransfer();

    let errorEl = null;

    function getExistingCount() {
        return document.querySelectorAll('.admin-image-previews .admin-image-preview-item').length;
    }

    function updateCounter() {
        const newCount = dt.files.length;
        const existingCount = isEdit ? getExistingCount() : 0;
        const total = existingCount + newCount;

        let counter = document.getElementById('imageCounter');
        if (!counter) {
            counter = document.createElement('p');
            counter.id = 'imageCounter';
            counter.className = 'admin-form-hint mt-2 mb-0';
            preview.parentElement.insertBefore(counter, preview);
        }
        const enough = total >= MIN_IMAGES;
        counter.className = `admin-form-hint mt-2 mb-0${enough ? '' : ' text-danger'}`;
        counter.textContent = isEdit
            ? `${existingCount} existing + ${newCount} new = ${total} image${total !== 1 ? 's' : ''} (min ${MIN_IMAGES} required)`
            : `${total} of ${MIN_IMAGES} required images selected`;
    }

    function showError(msg) {
        if (!errorEl) {
            errorEl = document.createElement('p');
            errorEl.className = 'admin-form-hint text-danger mt-2';
            preview.parentElement.appendChild(errorEl);
        }
        errorEl.textContent = msg;
    }

    function clearError() {
        if (errorEl) errorEl.textContent = '';
    }

    function renderPreviews() {
        preview.innerHTML = '';
        Array.from(dt.files).forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const item = document.createElement('div');
                item.className = 'admin-image-preview-item';
                item.innerHTML = `
                    <img src="${e.target.result}" alt="">
                    <button type="button" class="remove-image" data-idx="${idx}" title="Remove">
                        <i class="bi bi-x"></i>
                    </button>`;
                preview.appendChild(item);
            };
            reader.readAsDataURL(file);
        });
        updateCounter();
        clearError();
    }

    input.addEventListener('change', () => {
        Array.from(input.files).forEach(f => dt.items.add(f));
        input.files = dt.files;
        renderPreviews();
    });

    preview.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-idx]');
        if (!btn) return;
        const idx = parseInt(btn.dataset.idx, 10);
        dt.items.remove(idx);
        input.files = dt.files;
        renderPreviews();
    });

    if (form) {
        form.addEventListener('submit', (e) => {
            const total = (isEdit ? getExistingCount() : 0) + dt.files.length;
            if (total < MIN_IMAGES) {
                e.preventDefault();
                showError(`Please upload at least ${MIN_IMAGES} product images.`);
                input.closest('.admin-form-card').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }

    updateCounter();
}
