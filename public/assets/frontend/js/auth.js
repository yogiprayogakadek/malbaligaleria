window.addEventListener('load', function() {
    const progressBar = document.getElementById('preloaderProgressBar');
    let width = 0;
    const interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
        } else {
            width++;
            progressBar.style.width = width + '%';
        }
    }, 30);

    setTimeout(function() {
        const preloader = document.getElementById('preloader');
        preloader.style.opacity = '0';
        setTimeout(function() {
            preloader.style.display = 'none';
        }, 500);
    }, 1500);
});

function showForm(formName) {
    // Hide all forms
    document.querySelectorAll('.form-container').forEach(form => {
        form.classList.remove('active');
    });

    // Remove active class from all tabs
    document.querySelectorAll('.auth-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Show selected form
    document.getElementById(formName + '-form').classList.add('active');

    // Find and activate the correct tab based on formName
    if (formName === 'login') {
        document.querySelectorAll('.auth-tab')[0].classList.add('active');
    } else if (formName === 'register') {
        document.querySelectorAll('.auth-tab')[1].classList.add('active');
    }
}

// Fungsi untuk memilih tenant
function selectTenant(value, text) {
    document.getElementById('tenant').value = value;
    document.getElementById('tenant-search').value = text;
    document.getElementById('tenant-options').style.display = 'none';

    // Hapus kelas aktif dari semua opsi
    document.querySelectorAll('.tenant-option').forEach(option => {
        option.style.backgroundColor = 'transparent';
        option.style.color = 'var(--text-primary)';
    });
}

// Inisialisasi searchable select
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tenant-search');
    const optionsContainer = document.getElementById('tenant-options');
    const tenantOptions = document.querySelectorAll('.tenant-option:not(#no-results)');
    const noResults = document.getElementById('no-results');

    // Fokus ke input search saat diklik
    searchInput.addEventListener('focus', function() {
        this.style.borderColor = 'var(--primary-color)';
        this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
        optionsContainer.style.display = 'block';
    });

    // Hilangkan border saat blur kecuali jika klik di opsi
    searchInput.addEventListener('blur', function() {
        setTimeout(function() {
            if (!optionsContainer.matches(':hover') && !searchInput.matches(':hover')) {
                searchInput.style.borderColor = 'var(--border-light)';
                searchInput.style.boxShadow = 'none';
                optionsContainer.style.display = 'none';
            }
        }, 200);
    });

    // Fungsi untuk searching
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let hasVisibleOptions = false;

        tenantOptions.forEach(option => {
            const optionText = option.textContent.toLowerCase();
            if (optionText.includes(searchTerm)) {
                option.style.display = 'block';
                hasVisibleOptions = true;
            } else {
                option.style.display = 'none';
            }
        });

        // Tampilkan atau sembunyikan pesan "Data tidak ada"
        if (hasVisibleOptions || searchTerm === '') {
            noResults.style.display = 'none';
        } else {
            noResults.style.display = 'block';
        }
    });

    // Fungsi untuk menangani klik di luar
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.searchable-select')) {
            optionsContainer.style.display = 'none';
            searchInput.style.borderColor = 'var(--border-light)';
            searchInput.style.boxShadow = 'none';

            // Sembunyikan pesan "Data tidak ada" saat menutup
            noResults.style.display = 'none';

            // Reset semua opsi yang disembunyikan oleh pencarian
            tenantOptions.forEach(option => {
                option.style.display = 'block';
            });
        }
    });

    // Tambahkan event listener ke opsi untuk memilih tenant
    tenantOptions.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent;

            selectTenant(value, text);
        });

        option.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'var(--bg-light)';
        });

        option.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });
    customSelects.forEach(initializeCustomSelect);
});

function initializeCustomSelect(customSelectElement) {
    // Get the original select element
    const originalSelect = customSelectElement.querySelector('select');
    if (!originalSelect) return; // Exit if no select found

    const options = Array.from(originalSelect.options);

    // Create custom dropdown structure
    const dropdownContainer = document.createElement('div');
    dropdownContainer.className = 'select-dropdown';

    // Create selected value display
    const selectedValueDiv = document.createElement('div');
    selectedValueDiv.className = 'selected-value';

    const selectedTextSpan = document.createElement('span');
    selectedTextSpan.className = 'selected-text';
    const selectedOption = originalSelect.options[originalSelect.selectedIndex];
    selectedTextSpan.textContent = selectedOption ? selectedOption.text : originalSelect.options[0].text ||
        'Select a tenant';

    const arrowSpan = document.createElement('span');
    arrowSpan.className = 'arrow';
    arrowSpan.innerHTML = '▼'; // Dropdown arrow

    selectedValueDiv.appendChild(selectedTextSpan);
    selectedValueDiv.appendChild(arrowSpan);
    dropdownContainer.appendChild(selectedValueDiv);

    // Create options container
    const optionsContainer = document.createElement('div');
    optionsContainer.className = 'dropdown-options';

    // Create search box
    const searchBoxDiv = document.createElement('div');
    searchBoxDiv.className = 'search-box';

    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.placeholder = 'Search tenants...';
    searchInput.setAttribute('autocomplete', 'off');

    searchBoxDiv.appendChild(searchInput);
    optionsContainer.appendChild(searchBoxDiv);

    // Create option list
    options.forEach((option, index) => {
        if (option.value === '') return; // Skip the default "Select a tenant" option

        const optionElement = document.createElement('div');
        optionElement.className = 'option';
        optionElement.dataset.value = option.value;
        optionElement.dataset.index = index;
        optionElement.textContent = option.text;

        if (option.selected) {
            optionElement.classList.add('selected');
        }

        optionElement.addEventListener('click', function() {
            // Update original select
            originalSelect.selectedIndex = index;

            // Update custom dropdown display
            selectedTextSpan.textContent = option.text;
            selectedTextSpan.classList.remove('error'); // Remove error styling if present

            // Update selected classes
            optionsList.querySelectorAll('.option').forEach(opt => {
                opt.classList.remove('selected');
            });
            this.classList.add('selected');

            // Trigger change event on original select
            originalSelect.dispatchEvent(new Event('change'));

            // Close the dropdown after selection
            dropdownContainer.classList.remove('open');
            optionsContainer.classList.remove('show');
        });

        optionsList.appendChild(optionElement);
    });

    dropdownContainer.appendChild(optionsContainer);
    customSelectElement.appendChild(dropdownContainer);

    // Hide original select
    originalSelect.style.display = 'none';

    // Toggle dropdown visibility
    selectedValueDiv.addEventListener('click', function() {
        const isOpen = dropdownContainer.classList.contains('open');

        // Close all other dropdowns
        document.querySelectorAll('.select-dropdown').forEach(dropdown => {
            if (dropdown !== dropdownContainer) {
                dropdown.classList.remove('open');
                const options = dropdown.querySelector('.dropdown-options');
                if (options) {
                    options.classList.remove('absolute', 'fixed');
                }
            }
        });

        // Toggle this dropdown
        if (isOpen) {
            dropdownContainer.classList.remove('open');
            optionsContainer.classList.remove('absolute', 'fixed');
        } else {
            dropdownContainer.classList.add('open');

            // Calculate position after it's displayed
            setTimeout(() => {
                const rect = dropdownContainer.getBoundingClientRect();
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

                // If dropdown would go below viewport, position it above
                if (rect.bottom + 200 > window.innerHeight + window.pageYOffset) {
                    // Use fixed positioning for better control
                    optionsContainer.classList.add('fixed');

                    // Position it above the select
                    optionsContainer.style.top = (rect.top + scrollTop - optionsContainer
                        .offsetHeight) + 'px';
                    optionsContainer.style.left = (rect.left + scrollLeft) + 'px';
                    optionsContainer.style.width = rect.width + 'px';
                } else {
                    // Position normally below the select
                    optionsContainer.classList.add('absolute');
                    optionsContainer.style.top = rect.bottom + 'px';
                    optionsContainer.style.left = rect.left + 'px';
                    optionsContainer.style.width = rect.width + 'px';
                }

                searchInput.focus();
            }, 10);
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!customSelectElement.contains(event.target)) {
            dropdownContainer.classList.remove('open');
            optionsContainer.classList.remove('absolute', 'fixed');
            // Reset inline styles
            optionsContainer.style.top = '';
            optionsContainer.style.left = '';
            optionsContainer.style.width = '';
        }
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const optionElements = optionsContainer.querySelectorAll('.option');

        optionElements.forEach(optionElement => {
            const optionText = optionElement.textContent.toLowerCase();
            if (optionText.includes(searchTerm)) {
                optionElement.classList.remove('hidden');
            } else {
                optionElement.classList.add('hidden');
            }
        });
    });

    // Handle keyboard navigation
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            dropdownContainer.classList.remove('open');
            selectedValueDiv.focus();
        } else if (event.key === 'Enter') {
            event.preventDefault();
            const firstVisibleOption = optionsContainer.querySelector('.option:not(.hidden)');
            if (firstVisibleOption) {
                firstVisibleOption.click();
            }
        }
    });

    // Update display if original select value changes programmatically
    originalSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption) {
            selectedTextSpan.textContent = selectedOption.text;
        }
    });
}

// Handle form submission and validation
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('#register-form form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const tenantSelect = registerForm.querySelector('#tenant');
            if (tenantSelect && tenantSelect.value === '') {
                e.preventDefault();

                // Find the custom select container
                const customSelect = tenantSelect.closest('.form-group').querySelector(
                    '.custom-select');
                if (customSelect) {
                    const selectedText = customSelect.querySelector('.selected-text');
                    selectedText.classList.add('error');

                    // Add error message if not already present
                    let errorElement = customSelect.parentNode.querySelector('.error-message');
                    if (!errorElement) {
                        errorElement = document.createElement('div');
                        errorElement.className = 'error-message';
                        errorElement.textContent = 'Tenant is required';
                        customSelect.parentNode.appendChild(errorElement);
                    }
                }
            }
        });
    }
});
