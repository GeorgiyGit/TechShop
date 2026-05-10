document.addEventListener('DOMContentLoaded', () => {
    const group = document.querySelector('.payment-method-group');
    const submitLabel = document.querySelector('[data-payment-submit-label]');
    if (!group) return;

    const refreshSelection = () => {
        const selected = group.querySelector('input[type="radio"]:checked');
        group.querySelectorAll('.payment-method-card').forEach((card) => {
            card.classList.toggle('selected', card.querySelector('input[type="radio"]').checked);
        });
        if (submitLabel) {
            submitLabel.textContent = selected?.value === 'cash' ? 'Place Order' : 'Pay for Order';
        }
    };

    group.querySelectorAll('input[type="radio"]').forEach((input) => {
        input.addEventListener('change', refreshSelection);
    });

    refreshSelection();
});
