function setIcon(icon) {
    const input = document.getElementById('catIcon');
    const preview = document.getElementById('iconPreview');
    if (input) input.value = icon;
    if (preview) {
        preview.className = 'bi ' + icon;
    }
}

function updateIconPreview(value) {
    const preview = document.getElementById('iconPreview');
    if (preview) {
        preview.className = 'bi ' + (value.trim() || 'bi-grid');
    }
}

window.setIcon = setIcon;
window.updateIconPreview = updateIconPreview;
