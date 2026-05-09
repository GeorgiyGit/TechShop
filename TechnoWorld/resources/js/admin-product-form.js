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
            <div class="col-6">
                <input type="text" name="char_value[]" class="admin-form-control" placeholder="Value">
            </div>
            <div class="col-1">
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

    // Accumulate files across multiple dialog opens
    const dt = new DataTransfer();

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
}
