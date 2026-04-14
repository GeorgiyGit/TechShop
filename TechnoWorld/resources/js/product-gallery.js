(() => {
    const THUMB_H = 80;
    const THUMB_GAP = 8;
    const STEP = THUMB_H + THUMB_GAP;
    const VISIBLE = 5;

    const mainImg = document.getElementById('galleryMain');
    const thumbList = document.getElementById('thumbList');
    const thumbs = thumbList ? Array.from(thumbList.querySelectorAll('.gallery-thumb')) : [];
    let offset = 0;

    if (!mainImg || !thumbList || thumbs.length === 0) return;

    const applyOffset = () => {
        thumbList.style.transform = `translateY(-${offset * STEP}px)`;
    };

    const updateActive = (src) => {
        thumbs.forEach(t => t.classList.toggle('active', t.dataset.gallerySrc === src));
    };

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            mainImg.src = thumb.dataset.gallerySrc;
            updateActive(thumb.dataset.gallerySrc);
        });
    });

    document.getElementById('thumbScrollUp')?.addEventListener('click', () => {
        if (offset > 0) { offset--; applyOffset(); }
    });

    document.getElementById('thumbScrollDown')?.addEventListener('click', () => {
        if (offset < thumbs.length - VISIBLE) { offset++; applyOffset(); }
    });
})();
