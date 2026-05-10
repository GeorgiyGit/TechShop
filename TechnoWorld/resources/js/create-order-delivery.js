document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.create-order-form');
    if (!form) return;

    const courierFields = document.getElementById('courierFields');
    const pickupFields = document.getElementById('pickupFields');

    function updateVisibility(method) {
        courierFields.style.display = method === 'courier' ? '' : 'none';
        pickupFields.style.display = method === 'pickup' ? '' : 'none';
    }

    form.querySelectorAll('input[name="delivery_method"]').forEach((radio) => {
        radio.addEventListener('change', () => {
            form.querySelectorAll('.delivery-method-card').forEach((card) => {
                card.classList.toggle('selected', card.querySelector('input').checked);
            });
            updateVisibility(radio.value);
        });
    });
});
