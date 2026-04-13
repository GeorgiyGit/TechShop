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

    const clearModalState = (modal) => {
        if (!modal) {
            return;
        }

        modal.querySelectorAll('input').forEach((input) => {
            if (input.type === 'hidden' || input.type === 'submit' || input.type === 'button') {
                return;
            }

            input.value = '';
        });

        modal.querySelectorAll('input[type="hidden"]').forEach((hiddenInput) => {
            if (hiddenInput.name !== 'return_to' && hiddenInput.name !== '_token') {
                hiddenInput.value = '';
            }
        });

        modal.querySelectorAll('.login-status-message, .signup-status-message').forEach((statusMessage) => {
            statusMessage.setAttribute('hidden', 'hidden');
            statusMessage.textContent = '';
        });
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
        clearModalState(modal);

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

            const targetModalName = trigger.dataset.authModalSwitch;
            const targetModal = modals.get(targetModalName);

            clearModalState(targetModal);
            openModal(targetModalName);
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

    const searchCatalogScript = document.getElementById('searchCatalogData');
    const searchCatalog = searchCatalogScript ? JSON.parse(searchCatalogScript.textContent || '{"products":[],"brands":[]}') : { products: [], brands: [] };

    const attachSearchAutocomplete = (container) => {
        const input = container.querySelector('[data-search-input]');
        const dropdown = container.querySelector('[data-search-dropdown]');
        const productsList = container.querySelector('[data-search-products-list]');
        const brandsList = container.querySelector('[data-search-brands-list]');
        const toggleButton = container.querySelector('[data-search-toggle]');

        if (!input || !dropdown || !productsList || !brandsList) {
            return;
        }

        const renderItems = (items, targetList) => {
            targetList.innerHTML = '';

            items.forEach((item) => {
                const link = document.createElement('a');
                link.className = 'search-dropdown-item search-dropdown-item-link';
                link.href = item.href;
                link.innerHTML = `
                    <span class="search-dropdown-item-label">${item.label}</span>
                    <span class="search-dropdown-item-meta">${item.meta}</span>
                `;

                link.addEventListener('click', () => {
                    closeDropdown();
                });

                targetList.appendChild(link);
            });
        };

        const openDropdown = () => {
            dropdown.removeAttribute('hidden');
            input.setAttribute('aria-expanded', 'true');
        };

        const closeDropdown = () => {
            dropdown.setAttribute('hidden', 'hidden');
            input.setAttribute('aria-expanded', 'false');
        };

        const updateDropdown = () => {
            const query = input.value.trim().toLowerCase();

            const productMatches = searchCatalog.products.filter((item) =>
                item.label.toLowerCase().includes(query) || item.meta.toLowerCase().includes(query)
            ).slice(0, 6);

            const brandMatches = searchCatalog.brands.filter((item) =>
                item.label.toLowerCase().includes(query)
            ).slice(0, 6);

            renderItems(productMatches, productsList);
            renderItems(brandMatches, brandsList);

            const hasItems = productMatches.length > 0 || brandMatches.length > 0;
            dropdown.hidden = !hasItems;
        };

        input.addEventListener('focus', () => {
            updateDropdown();
        });

        input.addEventListener('input', () => {
            updateDropdown();
        });

        if (toggleButton) {
            toggleButton.addEventListener('click', () => {
                updateDropdown();
                input.focus();
            });
        }

        document.addEventListener('click', (event) => {
            if (!container.contains(event.target)) {
                closeDropdown();
            }
        });

        input.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeDropdown();
            }
        });
    };

    document.querySelectorAll('[data-search-autocomplete]').forEach(attachSearchAutocomplete);

    if (initialModal) {
        openModal(initialModal);
    } else {
        modals.forEach(syncReturnTo);
    }
});