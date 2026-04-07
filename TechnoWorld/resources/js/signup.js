document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.querySelector('#email');
    const nameInput = document.querySelector('#signup-name');

    if (emailInput && nameInput) {
        const syncName = () => {
            const localPart = emailInput.value.split('@')[0] ?? '';
            const nextName = localPart.trim().replace(/[._-]+/g, ' ');

            nameInput.value = nextName;
        };

        emailInput.addEventListener('input', syncName);
        syncName();
    }
});