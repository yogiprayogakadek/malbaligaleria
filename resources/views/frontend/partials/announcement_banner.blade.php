@if(isset($globalAnnouncements) && count($globalAnnouncements) > 0)
    <!-- Announcement Carousel Modal -->
    <div id="announcementModal" class="announcement-modal-overlay" data-lenis-prevent onclick="closeAnnouncementModal(event)" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', Montserrat, sans-serif; padding: 20px; box-sizing: border-box; backdrop-filter: blur(4px); transition: all 0.3s ease-in-out;">
        <div class="announcement-modal-wrapper" onclick="event.stopPropagation()" style="position: relative; width: 100%; max-width: 600px; display: flex; align-items: center; justify-content: center;">
            
            <!-- Navigation Outer Left Arrow -->
            <button id="annPrevBtn" onclick="annSlidePrev(event)" style="display: none; position: absolute; left: -50px; background: rgba(255,255,255,0.25); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.4); color: #fff; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; font-weight: 700; cursor: pointer; align-items: center; justify-content: center; transition: all 0.2s; z-index: 10100;" onmouseover="this.style.background='rgba(255,255,255,0.4)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1)';">&#10094;</button>

            <!-- Modal Content Container -->
            <div class="announcement-modal-content" style="background: #fff; width: 100%; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; flex-direction: column; max-height: 90vh; animation: announcementPop 0.3s cubic-bezier(0.16, 1, 0.3, 1); position: relative;">
                
                <!-- Slides Track -->
                <div id="annSlidesTrack" style="display: flex; transition: transform 0.3s cubic-bezier(0.25, 1, 0.5, 1); width: 100%;">
                    <!-- Dynamically populated in JavaScript -->
                </div>

                <!-- Page Indicator Dots Row -->
                <div id="annDotsRow" style="display: none; justify-content: center; gap: 8px; padding: 10px 0; background: #fff; border-top: 1px solid #edf2f7; z-index: 10050;">
                    <!-- Dots will be populated dynamically -->
                </div>
            </div>

            <!-- Navigation Outer Right Arrow -->
            <button id="annNextBtn" onclick="annSlideNext(event)" style="display: none; position: absolute; right: -50px; background: rgba(255,255,255,0.25); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.4); color: #fff; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; font-weight: 700; cursor: pointer; align-items: center; justify-content: center; transition: all 0.2s; z-index: 10100;" onmouseover="this.style.background='rgba(255,255,255,0.4)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1)';">&#10095;</button>

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
        
        @media (max-width: 768px) {
            #annPrevBtn {
                left: 10px !important;
                background: rgba(0,0,0,0.5) !important;
                border: none !important;
            }
            #annNextBtn {
                right: 10px !important;
                background: rgba(0,0,0,0.5) !important;
                border: none !important;
            }
        }
    </style>

    <script>
        (function() {
            var rawAnnouncements = @json($globalAnnouncements);
            var activeAnnouncements = [];
            var currentSlideIndex = 0;
            var nowTime = new Date().getTime();
            var innerImageIndices = {};

            // Client-side filtering based on localStorage dismissal states
            rawAnnouncements.forEach(function(ann) {
                var announcementId = ann.id;
                
                // 1. Check permanent dismissal
                if (localStorage.getItem('announcement_dismissed_forever_' + announcementId) === 'true') {
                    return;
                }

                // 2. Check frequency
                var frequency = ann.frequency || 'always';
                var shouldShow = false;

                if (frequency === 'always') {
                    shouldShow = true;
                } else if (frequency === 'once_session') {
                    var sessionKey = "announcement_seen_session_" + announcementId;
                    if (!sessionStorage.getItem(sessionKey)) {
                        shouldShow = true;
                    }
                } else if (frequency === 'once_day') {
                    var dayKey = "announcement_seen_day_" + announcementId;
                    var lastSeenDay = localStorage.getItem(dayKey);
                    if (!lastSeenDay || (nowTime - parseInt(lastSeenDay)) > (24 * 60 * 60 * 1000)) {
                        shouldShow = true;
                    }
                } else if (frequency === 'once_week') {
                    var weekKey = "announcement_seen_week_" + announcementId;
                    var lastSeenWeek = localStorage.getItem(weekKey);
                    if (!lastSeenWeek || (nowTime - parseInt(lastSeenWeek)) > (7 * 24 * 60 * 60 * 1000)) {
                        shouldShow = true;
                    }
                }

                if (shouldShow) {
                    activeAnnouncements.push(ann);
                }
            });

            if (activeAnnouncements.length === 0) {
                return;
            }

            // Populate the slides dynamically
            var track = document.getElementById('annSlidesTrack');
            var dotsRow = document.getElementById('annDotsRow');
            
            track.style.width = (activeAnnouncements.length * 100) + '%';

            var bgColors = {
                'danger': '#dc3545',
                'warning': '#ffc107',
                'success': '#198754',
                'primary': '#c9a96e',
                'info': '#0d6efd'
            };

            activeAnnouncements.forEach(function(ann) {
                var slide = document.createElement('div');
                slide.className = 'announcement-slide';
                slide.style.width = (100 / activeAnnouncements.length) + '%';
                slide.style.flexShrink = '0';
                slide.style.display = 'flex';
                slide.style.flexDirection = 'column';

                var bgColor = bgColors[ann.type] || '#0d6efd';
                var textColor = ann.type === 'warning' ? '#212529' : '#ffffff';
                var hasLink = ann.link ? true : false;

                var headerHtml = `
                    <div style="background: ${bgColor}; color: ${textColor}; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="margin: 0; font-size: 18px; font-weight: 700;">${ann.title}</h5>
                        <button onclick="closeAnnouncementModal(event)" style="background: transparent; border: none; color: ${textColor}; font-size: 28px; cursor: pointer; line-height: 1; padding: 0 10px; opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">&times;</button>
                    </div>
                `;

                // Handle single image vs multiple images
                var imagesHtml = '';
                if (ann.images && ann.images.length > 0) {
                    if (ann.images.length === 1) {
                        imagesHtml = `
                            <div style="margin-bottom: 20px; text-align: center; border-radius: 8px; overflow: hidden;">
                                <img src="/storage/${ann.images[0]}" alt="Announcement" style="max-width: 100%; height: auto; display: block; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            </div>
                        `;
                    } else {
                        // Multi-image inner carousel
                        var trackWidth = ann.images.length * 100;
                        var slideWidth = 100 / ann.images.length;
                        var slideImages = ann.images.map(function(img) {
                            return `
                                <div style="width: ${slideWidth}%; flex-shrink: 0;">
                                    <img src="/storage/${img}" alt="Announcement" style="max-width: 100%; height: auto; display: block; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                </div>
                            `;
                        }).join('');

                        imagesHtml = `
                            <div class="announcement-inner-carousel" style="position: relative; margin-bottom: 20px; border-radius: 8px; overflow: hidden; width: 100%;">
                                <div class="ann-inner-track-${ann.id}" style="display: flex; transition: transform 0.3s ease-in-out; width: ${trackWidth}%;">
                                    ${slideImages}
                                </div>
                                <button onclick="annInnerPrev(event, ${ann.id}, ${ann.images.length})" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: #fff; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; font-weight: bold;">&#10094;</button>
                                <button onclick="annInnerNext(event, ${ann.id}, ${ann.images.length})" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: #fff; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; font-weight: bold;">&#10095;</button>
                            </div>
                        `;
                    }
                }

                var messageHtml = ann.message ? `
                    <div class="announcement-content" style="font-size: 15px; line-height: 1.6; color: #4a5568;">
                        ${ann.message}
                    </div>
                ` : '';

                var bodyHtml = `
                    <div style="padding: 24px; overflow-y: auto; flex: 1;" data-lenis-prevent>
                        ${imagesHtml}
                        ${messageHtml}
                    </div>
                `;

                var ctaHtml = hasLink ? `
                    <a href="${ann.link}" target="_blank" style="background: ${bgColor}; color: ${textColor}; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Visit Link
                    </a>
                ` : '';

                var footerHtml = `
                    <div style="padding: 16px 24px; border-top: 1px solid #edf2f7; display: flex; align-items: center; justify-content: space-between; background: #f7fafc;">
                        <div style="display: flex; align-items: center;">
                            <input type="checkbox" id="annDismissForever_${ann.id}" style="width: 18px; height: 18px; cursor: pointer; margin-right: 8px;">
                            <label for="annDismissForever_${ann.id}" style="font-size: 13px; color: #4a5568; cursor: pointer; user-select: none; margin: 0; font-weight: 500;">Don't show this again</label>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            ${ctaHtml}
                            <button onclick="closeAnnouncementModal(event)" style="background: #4a5568; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; transition: background 0.2s;" onmouseover="this.style.background='#2d3748'" onmouseout="this.style.background='#4a5568'">Close</button>
                        </div>
                    </div>
                `;

                slide.innerHTML = headerHtml + bodyHtml + footerHtml;
                track.appendChild(slide);
            });

            // Configure Navigation and Indicators if multiple
            if (activeAnnouncements.length > 1) {
                document.getElementById('annPrevBtn').style.display = 'flex';
                document.getElementById('annNextBtn').style.display = 'flex';
                dotsRow.style.display = 'flex';

                for (var i = 0; i < activeAnnouncements.length; i++) {
                    var dot = document.createElement('span');
                    dot.className = 'announcement-dot';
                    dot.style.display = 'inline-block';
                    dot.style.width = '8px';
                    dot.style.height = '8px';
                    dot.style.borderRadius = '50%';
                    dot.style.background = i === 0 ? '#4a5568' : '#cbd5e1';
                    dot.style.cursor = 'pointer';
                    dot.style.transition = 'background 0.2s';
                    dot.setAttribute('onclick', 'annGotoSlide(' + i + ')');
                    dotsRow.appendChild(dot);
                }
            }

            // Outer Navigation Helpers
            window.annSlidePrev = function(e) {
                if (e) e.stopPropagation();
                var newIdx = currentSlideIndex - 1;
                if (newIdx < 0) {
                    newIdx = activeAnnouncements.length - 1;
                }
                annGotoSlide(newIdx);
            };

            window.annSlideNext = function(e) {
                if (e) e.stopPropagation();
                var newIdx = currentSlideIndex + 1;
                if (newIdx >= activeAnnouncements.length) {
                    newIdx = 0;
                }
                annGotoSlide(newIdx);
            };

            window.annGotoSlide = function(idx) {
                currentSlideIndex = idx;
                var percentage = -idx * (100 / activeAnnouncements.length);
                document.getElementById('annSlidesTrack').style.transform = 'translateX(' + percentage + '%)';
                
                var dots = document.querySelectorAll('.announcement-dot');
                dots.forEach(function(dot, dIdx) {
                    dot.style.background = dIdx === idx ? '#4a5568' : '#cbd5e1';
                });
            };

            // Inner Navigation Helpers for images
            window.annInnerPrev = function(e, annId, totalImages) {
                if (e) e.stopPropagation();
                if (typeof innerImageIndices[annId] === 'undefined') {
                    innerImageIndices[annId] = 0;
                }
                var newIdx = innerImageIndices[annId] - 1;
                if (newIdx < 0) {
                    newIdx = totalImages - 1;
                }
                annGotoInnerSlide(annId, newIdx, totalImages);
            };

            window.annInnerNext = function(e, annId, totalImages) {
                if (e) e.stopPropagation();
                if (typeof innerImageIndices[annId] === 'undefined') {
                    innerImageIndices[annId] = 0;
                }
                var newIdx = innerImageIndices[annId] + 1;
                if (newIdx >= totalImages) {
                    newIdx = 0;
                }
                annGotoInnerSlide(annId, newIdx, totalImages);
            };

            window.annGotoInnerSlide = function(annId, idx, totalImages) {
                innerImageIndices[annId] = idx;
                var percentage = -idx * (100 / totalImages);
                var track = document.querySelector('.ann-inner-track-' + annId);
                if (track) {
                    track.style.transform = 'translateX(' + percentage + '%)';
                }
            };

            // Modal Display Handlers
            window.openAnnouncementModal = function() {
                var modal = document.getElementById('announcementModal');
                if (modal) {
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    if (window.lenis) {
                        window.lenis.stop();
                    }
                }
            };

            window.closeAnnouncementModal = function(e) {
                if (e) {
                    e.stopPropagation();
                }
                saveDismissState();
                var modal = document.getElementById('announcementModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                    if (window.lenis) {
                        window.lenis.start();
                    }
                }
            };

            function saveDismissState() {
                activeAnnouncements.forEach(function(ann) {
                    var checkbox = document.getElementById('annDismissForever_' + ann.id);
                    if (checkbox && checkbox.checked) {
                        localStorage.setItem('announcement_dismissed_forever_' + ann.id, 'true');
                    } else {
                        var frequency = ann.frequency || 'always';
                        if (frequency === 'once_session') {
                            sessionStorage.setItem("announcement_seen_session_" + ann.id, "true");
                        } else if (frequency === 'once_day') {
                            localStorage.setItem("announcement_seen_day_" + ann.id, nowTime.toString());
                        } else if (frequency === 'once_week') {
                            localStorage.setItem("announcement_seen_week_" + ann.id, nowTime.toString());
                        }
                    }
                });
            }

            // Trigger modal on load
            function initAnnouncementPopup() {
                if (activeAnnouncements.length > 0) {
                    setTimeout(function() {
                        openAnnouncementModal();
                    }, 800);
                }
            }

            if (document.readyState === "complete" || document.readyState === "interactive") {
                initAnnouncementPopup();
            } else {
                document.addEventListener("DOMContentLoaded", initAnnouncementPopup);
            }
        })();
    </script>
    <script src="{{ asset('assets/backend/js/iconify-icon.min.js') }}"></script>
@endif
