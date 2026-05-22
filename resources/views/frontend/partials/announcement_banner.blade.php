@if(isset($globalAnnouncement) && $globalAnnouncement['active'])
    <div class="global-announcement-banner" style="position: fixed; top: 0; left: 0; right: 0; height: 40px; background-color: {{ $globalAnnouncement['type'] === 'danger' ? '#dc3545' : ($globalAnnouncement['type'] === 'warning' ? '#ffc107' : ($globalAnnouncement['type'] === 'success' ? '#198754' : '#0d6efd')) }}; color: {{ $globalAnnouncement['type'] === 'warning' ? '#000' : '#fff' }}; text-align: center; line-height: 40px; font-weight: 600; font-size: 14px; z-index: 1001; font-family: 'Plus Jakarta Sans', Montserrat, sans-serif; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding: 0 15px;">
        {{ $globalAnnouncement['text'] }}
    </div>
    <style>
        header, #mainHeader, .topbar {
            top: 40px !important;
        }
        body {
            padding-top: 40px !important;
        }
        .sidebar {
            padding-top: 140px !important;
        }
        @media (max-width: 768px) {
            .global-announcement-banner {
                font-size: 12px;
                height: 35px;
                line-height: 35px;
            }
            header, #mainHeader, .topbar {
                top: 35px !important;
            }
            body {
                padding-top: 35px !important;
            }
        }
    </style>
@endif
