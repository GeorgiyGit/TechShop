(() => {
    const form = document.getElementById('productsFiltersForm');
    if (!form) return;

    const minPriceInput = form.querySelector('input[name="min_price"]');
    const maxPriceInput = form.querySelector('input[name="max_price"]');
    const priceMinRange = document.getElementById('priceMinRange');
    const priceMaxRange = document.getElementById('priceMaxRange');
    const priceRangeFill = document.querySelector('[data-price-range-fill]');
    const priceMinLabel = document.querySelector('[data-price-min-label]');
    const priceMaxLabel = document.querySelector('[data-price-max-label]');

    if (!priceMinRange || !priceMaxRange || !minPriceInput || !maxPriceInput) return;

    const sync = () => {
        let left = Number(priceMinRange.value);
        let right = Number(priceMaxRange.value);
        if (left > right) [left, right] = [right, left];

        minPriceInput.value = String(left);
        maxPriceInput.value = String(right);

        if (priceRangeFill) {
            const min = Number(priceMinRange.min);
            const max = Number(priceMinRange.max);
            const leftPct = ((left - min) / (max - min)) * 100;
            const rightPct = ((right - min) / (max - min)) * 100;
            priceRangeFill.style.left = `${leftPct}%`;
            priceRangeFill.style.width = `${rightPct - leftPct}%`;
        }

        if (priceMinLabel) priceMinLabel.textContent = `${left.toLocaleString('en-US')} EUR`;
        if (priceMaxLabel) priceMaxLabel.textContent = `${right.toLocaleString('en-US')} EUR`;
    };

    priceMinRange.addEventListener('input', () => {
        if (Number(priceMinRange.value) > Number(priceMaxRange.value)) priceMaxRange.value = priceMinRange.value;
        sync();
    });

    priceMaxRange.addEventListener('input', () => {
        if (Number(priceMaxRange.value) < Number(priceMinRange.value)) priceMinRange.value = priceMaxRange.value;
        sync();
    });

    minPriceInput.addEventListener('input', () => {
        priceMinRange.value = minPriceInput.value || '0';
        sync();
    });

    maxPriceInput.addEventListener('input', () => {
        priceMaxRange.value = maxPriceInput.value || priceMaxRange.max;
        sync();
    });

    sync();
})();
