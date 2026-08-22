import './bootstrap';
import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.store('authPanel', {
        open: false,
    });

    Alpine.store('registerPanel', {
        open: false,
    });
});

window.Alpine = Alpine;

Alpine.start();