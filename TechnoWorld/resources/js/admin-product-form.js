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

    input.addEventListener('change', () => {
        preview.innerHTML = '';
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const item = document.createElement('div');
                item.className = 'admin-image-preview-item';
                item.innerHTML = `<img src="${e.target.result}" alt="">`;
                preview.appendChild(item);
            };
            reader.readAsDataURL(file);
        });
    });
}
