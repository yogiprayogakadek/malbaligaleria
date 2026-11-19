(function () {
    'use strict';

    var config = window.__PET_POLL_CONFIG__ || {};
    var searchUrl = config.searchUrl;

    var searchInput = document.getElementById('tenantSearchInput');
    var resultsList = document.getElementById('tenantSearchResults');
    var selectedTenantId = document.getElementById('selectedTenantId');
    var plaque = document.getElementById('tenantPlaque');
    var plaqueName = document.getElementById('tenantPlaqueName');
    var plaqueCategory = document.getElementById('tenantPlaqueCategory');
    var btnChangeTenant = document.getElementById('btnChangeTenant');
    var pollForm = document.getElementById('petPollForm');
    var btnSubmit = document.getElementById('btnSubmitPoll');
    var noteInput = document.getElementById('pollNote');
    var charCount = document.getElementById('charCount');

    var currentOptions = [];
    var activeIndex = -1;
    var debounceTimer = null;

    if (noteInput && charCount) {
        var updateCount = function () {
            charCount.textContent = String(noteInput.value.length);
        };
        noteInput.addEventListener('input', updateCount);
        updateCount();
    }

    if (!searchInput || !resultsList || !searchUrl) {
        return;
    }

    function clearResults() {
        resultsList.innerHTML = '';
        resultsList.style.display = 'none';
        searchInput.setAttribute('aria-expanded', 'false');
        searchInput.removeAttribute('aria-activedescendant');
        currentOptions = [];
        activeIndex = -1;
    }

    function renderResults(tenants) {
        resultsList.innerHTML = '';
        currentOptions = tenants;
        activeIndex = -1;

        if (tenants.length === 0) {
            var emptyLi = document.createElement('li');
            emptyLi.className = 'combobox-status';
            emptyLi.textContent = 'Tenant tidak ditemukan. Periksa ejaan atau hubungi pihak mall.';
            resultsList.appendChild(emptyLi);
            resultsList.style.display = 'block';
            searchInput.setAttribute('aria-expanded', 'true');
            return;
        }

        tenants.forEach(function (t, idx) {
            var li = document.createElement('li');
            li.className = 'combobox-option';
            li.id = 'tenant-opt-' + idx;
            li.setAttribute('role', 'option');
            li.setAttribute('aria-selected', 'false');

            var nameSpan = document.createElement('strong');
            nameSpan.textContent = t.name;
            li.appendChild(nameSpan);

            if (t.category) {
                var catSpan = document.createElement('span');
                catSpan.className = 'combobox-option-category';
                catSpan.textContent = t.category;
                li.appendChild(catSpan);
            }

            li.addEventListener('mousedown', function (e) {
                e.preventDefault();
                selectTenant(t);
            });

            resultsList.appendChild(li);
        });

        resultsList.style.display = 'block';
        searchInput.setAttribute('aria-expanded', 'true');
    }

    function selectTenant(tenant) {
        selectedTenantId.value = tenant.id;
        searchInput.value = tenant.name;
        plaqueName.textContent = tenant.name;
        plaqueCategory.textContent = tenant.category || '';
        plaque.style.display = 'flex';
        clearResults();

        var firstRadio = document.getElementById('allowsPetsYes');
        if (firstRadio) {
            firstRadio.focus();
        }
    }

    if (btnChangeTenant) {
        btnChangeTenant.addEventListener('click', function () {
            selectedTenantId.value = '';
            plaque.style.display = 'none';
            searchInput.value = '';
            searchInput.focus();
        });
    }

    function setActiveOption(index) {
        var options = resultsList.querySelectorAll('.combobox-option');
        options.forEach(function (opt, idx) {
            var active = (idx === index);
            opt.classList.toggle('is-active', active);
            opt.setAttribute('aria-selected', active ? 'true' : 'false');
            if (active) {
                searchInput.setAttribute('aria-activedescendant', opt.id);
                opt.scrollIntoView({ block: 'nearest' });
            }
        });
        activeIndex = index;
    }

    function performSearch(query) {
        var clean = query.trim();
        if (clean.length < 2) {
            clearResults();
            return;
        }

        resultsList.innerHTML = '<li class="combobox-status">Mencari tenant...</li>';
        resultsList.style.display = 'block';
        searchInput.setAttribute('aria-expanded', 'true');

        var url = searchUrl + (searchUrl.indexOf('?') === -1 ? '?' : '&') + 'q=' + encodeURIComponent(clean);

        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function (res) {
                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }
                return res.json();
            })
            .then(function (data) {
                renderResults(data);
            })
            .catch(function () {
                resultsList.innerHTML = '<li class="combobox-status">Daftar tenant gagal dimuat. Coba lagi.</li>';
                resultsList.style.display = 'block';
            });
    }

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        var q = searchInput.value;
        debounceTimer = setTimeout(function () {
            performSearch(q);
        }, 220);
    });

    searchInput.addEventListener('keydown', function (e) {
        var options = resultsList.querySelectorAll('.combobox-option');
        if (options.length === 0) {
            return;
        }

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            var next = activeIndex + 1;
            if (next >= options.length) {
                next = 0;
            }
            setActiveOption(next);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            var prev = activeIndex - 1;
            if (prev < 0) {
                prev = options.length - 1;
            }
            setActiveOption(prev);
        } else if (e.key === 'Enter') {
            if (activeIndex >= 0 && activeIndex < currentOptions.length) {
                e.preventDefault();
                selectTenant(currentOptions[activeIndex]);
            }
        } else if (e.key === 'Escape') {
            clearResults();
        }
    });

    searchInput.addEventListener('blur', function () {
        setTimeout(function () {
            clearResults();
        }, 180);
    });

    if (pollForm && btnSubmit) {
        pollForm.addEventListener('submit', function () {
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner" aria-hidden="true"></span><span>Mengirim...</span>';
        });
    }

    var btnCopy = document.getElementById('btnCopyEditLink');
    var editInput = document.getElementById('editUrlInput');
    var copyStatus = document.getElementById('copyStatus');
    var copyLabel = btnCopy ? btnCopy.querySelector('.btn-copy-label') : null;
    var copyResetTimer = null;

    if (btnCopy && editInput && copyLabel) {
        btnCopy.addEventListener('click', function () {
            var url = editInput.value;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(onCopied).catch(function () {
                    legacyCopy();
                });
            } else {
                legacyCopy();
            }
        });

        function legacyCopy() {
            var copied = false;
            editInput.select();

            try {
                copied = document.execCommand('copy');
            } catch (error) {
                copied = false;
            }

            if (copied) {
                onCopied();
            } else {
                onCopyFailed();
            }
        }

        function setButtonState(state, label) {
            window.clearTimeout(copyResetTimer);
            btnCopy.classList.remove('is-copied', 'is-copy-failed');

            if (state) {
                btnCopy.classList.add(state);
            }

            copyLabel.textContent = label;

            if (copyStatus) {
                copyStatus.textContent = state === 'is-copied'
                    ? 'Tautan edit berhasil disalin.'
                    : 'Tautan edit gagal disalin. Pilih tautan lalu salin manual.';
            }

            if (state) {
                copyResetTimer = window.setTimeout(function () {
                    btnCopy.classList.remove(state);
                    copyLabel.textContent = 'Salin tautan';
                    if (copyStatus) {
                        copyStatus.textContent = '';
                    }
                }, 2400);
            }
        }

        function onCopied() {
            setButtonState('is-copied', 'Tersalin');
        }

        function onCopyFailed() {
            setButtonState('is-copy-failed', 'Pilih manual');
        }
    }
})();
