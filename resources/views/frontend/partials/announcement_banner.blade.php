@if(isset($globalAnnouncement) && $globalAnnouncement['active'])
    @php
        $bgColors = [
            'danger' => '#dc3545',
            'warning' => '#ffc107',
            'success' => '#198754',
            'primary' => '#c9a96e',
            'info' => '#0d6efd'
        ];
        $bgColor = $bgColors[$globalAnnouncement['type']] ?? '#0d6efd';
        $textColor = $globalAnnouncement['type'] === 'warning' ? '#212529' : '#ffffff';
        $hasLink = !empty($globalAnnouncement['link']);
    @endphp

    <!-- Announcement Popup Modal -->
    <div id="announcementModal" class="announcement-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', Montserrat, sans-serif; padding: 20px; box-sizing: border-box; backdrop-filter: blur(4px); transition: all 0.3s ease-in-out;">
        <div class="announcement-modal-content" style="background: #fff; width: 100%; max-width: 600px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; flex-direction: column; max-height: 90vh; animation: announcementPop 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <!-- Header -->
            <div style="background: {{ $bgColor }}; color: {{ $textColor }}; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                <h5 style="margin: 0; font-size: 18px; font-weight: 700;">{{ $globalAnnouncement['title'] }}</h5>
                <button onclick="closeAnnouncementModal(event)" style="background: transparent; border: none; color: {{ $textColor }}; font-size: 24px; cursor: pointer; line-height: 1; padding: 0 5px; opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">&times;</button>
            </div>
            <!-- Body -->
            <div style="padding: 24px; overflow-y: auto; flex: 1;">
                @if($globalAnnouncement['image'])
                    <div style="margin-bottom: 20px; text-align: center; border-radius: 8px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $globalAnnouncement['image']) }}" alt="Announcement" style="max-width: 100%; height: auto; display: block; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    </div>
                @endif
                @if($globalAnnouncement['message'])
                    <div class="announcement-content" style="font-size: 15px; line-height: 1.6; color: #4a5568;">
                        {!! $globalAnnouncement['message'] !!}
                    </div>
                @endif
            </div>
            <!-- Footer -->
            <div style="padding: 16px 24px; border-top: 1px solid #edf2f7; display: flex; justify-content: flex-end; gap: 12px; background: #f7fafc;">
                @if($hasLink)
                    <a href="{{ $globalAnnouncement['link'] }}" target="_blank" style="background: {{ $bgColor }}; color: {{ $textColor }}; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Kunjungi Tautan
                    </a>
                @endif
                <button onclick="closeAnnouncementModal(event)" style="background: #4a5568; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; transition: background 0.2s;" onmouseover="this.style.background='#2d3748'" onmouseout="this.style.background='#4a5568'">Tutup</button>
            </div>
        </div>
    </div>

    <style>
        @keyframes announcementPop {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .announcement-content p {
            margin-bottom: 12px;
        }
        .announcement-content ul, .announcement-content ol {
            padding-left: 20px;
            margin-bottom: 12px;
        }
        .announcement-content ul {
            list-style-type: disc !important;
        }
        .announcement-content ol {
            list-style-type: decimal !important;
        }
        .announcement-content blockquote {
            border-left: 4px solid #cbd5e1;
            padding-left: 12px;
            color: #64748b;
            font-style: italic;
            margin-bottom: 12px;
        }
        .announcement-content a {
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>

    <script>
        function openAnnouncementModal() {
            var modal = document.getElementById('announcementModal');
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeAnnouncementModal(e) {
            if (e) {
                e.stopPropagation();
            }
            var modal = document.getElementById('announcementModal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        // Close on overlay click
        window.addEventListener('click', function(e) {
            var modal = document.getElementById('announcementModal');
            if (e.target === modal) {
                closeAnnouncementModal();
            }
        });

        // Auto popup handling
        function initAnnouncementPopup() {
            // Slight delay for better UX
            setTimeout(function() {
                openAnnouncementModal();
            }, 800);
        }

        if (document.readyState === "complete" || document.readyState === "interactive") {
            initAnnouncementPopup();
        } else {
            document.addEventListener("DOMContentLoaded", initAnnouncementPopup);
        }
    </script>
@endif
