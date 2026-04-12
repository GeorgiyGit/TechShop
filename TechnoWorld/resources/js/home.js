document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.href;
    const modals = new Map(
        Array.from(document.querySelectorAll('[data-auth-modal]')).map((modal) => [modal.dataset.authModal, modal])
    );

    const body = document.body;
    let activeModal = null;

    const syncNameFromEmail = (emailInput, nameInput) => {
        if (!emailInput || !nameInput) {
            return;
        }

        const updateName = () => {
            const localPart = emailInput.value.split('@')[0] ?? '';
            nameInput.value = localPart.trim().replace(/[._-]+/g, ' ');
        };

        emailInput.addEventListener('input', updateName);
        updateName();
    };

    const updateBodyState = () => {
        const anyOpen = Array.from(modals.values()).some((modal) => !modal.hasAttribute('hidden'));

        body.classList.toggle('modal-open', anyOpen);
    };

    const focusFirstField = (modal) => {
        const focusTarget = modal.querySelector('[autofocus]') ?? modal.querySelector('input, button, textarea, select, a[href]');

        if (focusTarget) {
            focusTarget.focus();
        }
    };

    const syncReturnTo = (modal) => {
        const returnToInput = modal.querySelector('input[name="return_to"]');

        if (returnToInput) {
            returnToInput.value = currentUrl;
        }
    };

    const openModal = (modalName) => {
        const modal = modals.get(modalName);

        if (!modal) {
            return;
        }

        if (activeModal && activeModal !== modal) {
            activeModal.setAttribute('hidden', 'hidden');
            activeModal.setAttribute('aria-hidden', 'true');
        }

        modal.removeAttribute('hidden');
        modal.setAttribute('aria-hidden', 'false');
        syncReturnTo(modal);
        activeModal = modal;
        updateBodyState();
        focusFirstField(modal);
    };

    const closeModal = (modal) => {
        if (!modal) {
            return;
        }

        modal.setAttribute('hidden', 'hidden');
        modal.setAttribute('aria-hidden', 'true');

        if (activeModal === modal) {
            activeModal = null;
        }

        updateBodyState();
    };

    document.querySelectorAll('[data-auth-modal-target]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            openModal(trigger.dataset.authModalTarget);
        });
    });

    document.querySelectorAll('[data-auth-modal-switch]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            openModal(trigger.dataset.authModalSwitch);
        });
    });

    document.querySelectorAll('[data-auth-modal-close]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            closeModal(trigger.closest('[data-auth-modal]'));
        });
    });

    document.querySelectorAll('[data-auth-modal-backdrop]').forEach((backdrop) => {
        backdrop.addEventListener('click', () => {
            closeModal(backdrop.closest('[data-auth-modal]'));
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && activeModal) {
            closeModal(activeModal);
        }
    });

    document.querySelectorAll('[data-sync-name-from-email]').forEach((emailInput) => {
        const nameInputSelector = emailInput.dataset.syncNameFromEmail;
        const nameInput = nameInputSelector ? document.querySelector(nameInputSelector) : null;

        syncNameFromEmail(emailInput, nameInput);
    });

    const initialModal = body.dataset.openAuthModal;

    if (initialModal) {
        openModal(initialModal);
    } else {
        modals.forEach(syncReturnTo);
    }
});