/**
 * Admin Panel JavaScript
 * Portfolio Admin Dashboard
 */

(function () {
    'use strict';

    /* ---- Sidebar Toggle ---- */

    const sidebar       = document.getElementById('adminSidebar');
    const overlay       = document.getElementById('sidebarOverlay');
    const toggleBtn     = document.getElementById('sidebarToggleBtn');
    const closeBtn      = document.getElementById('sidebarCloseBtn');

    function openSidebar() {
        if (!sidebar) return;
        sidebar.classList.add('sidebar-open');
        overlay && overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('sidebar-open');
        overlay && overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    toggleBtn  && toggleBtn.addEventListener('click', openSidebar);
    closeBtn   && closeBtn.addEventListener('click', closeSidebar);
    overlay    && overlay.addEventListener('click', closeSidebar);

    /* ---- Profile Dropdown ---- */

    const profileTrigger    = document.getElementById('profileTrigger');
    const profileDropdown   = document.getElementById('profileDropdownMenu');

    if (profileTrigger && profileDropdown) {
        profileTrigger.addEventListener('click', function (e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!profileTrigger.contains(e.target)) {
                profileDropdown.classList.remove('open');
            }
        });
    }

    /* ---- Auto-dismiss flash messages ---- */

    const flashMsg = document.getElementById('flashMsg');
    if (flashMsg) {
        setTimeout(() => {
            flashMsg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            flashMsg.style.opacity    = '0';
            flashMsg.style.transform  = 'translateY(-8px)';
            setTimeout(() => flashMsg.remove(), 500);
        }, 4000);
    }

    /* ---- Image preview on file input ---- */

    document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
        input.addEventListener('change', function () {
            const previewId = this.dataset.preview;
            const preview   = document.getElementById(previewId);
            if (!preview) return;

            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });

    /* ---- Confirm delete dialogs ---- */

    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            const msg = this.dataset.confirm || 'Are you sure?';
            if (!window.confirm(msg)) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });

    /* ---- Technologies tag input (for project form) ---- */

    const techInput  = document.getElementById('techInput');
    const techHidden = document.getElementById('techHidden');
    const techTags   = document.getElementById('techTags');

    if (techInput && techHidden && techTags) {
        let techs = [];

        // Load existing
        try {
            const existing = techHidden.value;
            if (existing) {
                techs = JSON.parse(existing);
                renderTechTags();
            }
        } catch (e) { /* ignore */ }

        techInput.addEventListener('keydown', function (e) {
            if ((e.key === 'Enter' || e.key === ',') && this.value.trim()) {
                e.preventDefault();
                const val = this.value.trim().replace(/,$/, '');
                if (val && !techs.includes(val)) {
                    techs.push(val);
                    renderTechTags();
                    updateHidden();
                }
                this.value = '';
            }
        });

        function renderTechTags() {
            techTags.innerHTML = '';
            techs.forEach(function (tech, i) {
                const tag = document.createElement('span');
                tag.className = 'tech-tag';
                tag.innerHTML = `${tech} <button type="button" data-index="${i}">×</button>`;
                tag.querySelector('button').addEventListener('click', function () {
                    techs.splice(parseInt(this.dataset.index), 1);
                    renderTechTags();
                    updateHidden();
                });
                techTags.appendChild(tag);
            });
        }

        function updateHidden() {
            techHidden.value = JSON.stringify(techs);
        }
    }

    /* ---- Skill level slider display ---- */

    const levelInput   = document.getElementById('skillLevel');
    const levelDisplay = document.getElementById('levelDisplay');

    if (levelInput && levelDisplay) {
        levelDisplay.textContent = levelInput.value + '%';
        levelInput.addEventListener('input', function () {
            levelDisplay.textContent = this.value + '%';
        });
    }

    /* ---- Close sidebar on window resize if large ---- */

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });

})();
