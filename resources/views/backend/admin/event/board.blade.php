@extends('templates.backend.master')

@section('page-title', 'Event Board')
@section('page-link', route('admin.event-board.index'))

@push('css')
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
    
    <style>
        /* Modern Glassmorphic style card for visibility settings */
        .settings-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 243, 249, 0.9));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* Tabs customization */
        .board-tabs .nav-link {
            border: none;
            color: #718096;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 20px;
            margin-right: 10px;
            transition: all 0.25s ease;
        }

        .board-tabs .nav-link.active {
            background-color: #5d87ff;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(93, 135, 255, 0.3);
        }

        /* FullCalendar Customization */
        #calendar {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }

        .fc-event {
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            font-size: 0.85rem;
            padding: 2px 5px;
            border-radius: 6px;
        }

        .fc-event:hover {
            transform: scale(1.02);
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        /* Kanban Layout */
        .kanban-wrapper {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px 0 20px 0;
            min-height: 600px;
            scrollbar-width: thin;
        }

        .kanban-column {
            flex: 0 0 300px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 15px;
            display: flex;
            flex-direction: column;
            max-height: 700px;
            transition: all 0.3s ease;
        }

        .kanban-column.drag-over {
            background: #edf2f7;
            border-color: #5d87ff;
            transform: scale(1.01);
        }

        .kanban-column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .kanban-cards-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            overflow-y: auto;
            flex-grow: 1;
            padding-right: 4px;
            scrollbar-width: thin;
            min-height: 100px;
        }

        /* Kanban Cards */
        .kanban-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            cursor: grab;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            user-select: none;
        }

        .kanban-card:active {
            cursor: grabbing;
        }

        .kanban-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.08);
            border-color: #cbd5e0;
        }

        /* Custom scrollbar */
        .kanban-cards-container::-webkit-scrollbar,
        .kanban-wrapper::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .kanban-cards-container::-webkit-scrollbar-thumb,
        .kanban-wrapper::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 3px;
        }
    </style>
@endpush

@section('content')
    <!-- Dashboard Visibility Settings Card (Superuser Only) -->
    @if($isSuperUser)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card settings-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold text-primary mb-1">
                                    <i class="ti ti-settings me-1"></i> Dashboard Visibility Settings
                                </h5>
                                <p class="text-muted mb-0 small">Choose which other user roles will see this Event Board in their home sidebar menu.</p>
                            </div>
                            <button type="button" id="btn-save-visibility" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i> Save Visibility
                            </button>
                        </div>
                        <div class="d-flex flex-wrap gap-4 mt-2">
                            @foreach($allRoles as $role)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input role-visibility-checkbox" type="checkbox" 
                                           id="visibility-{{ $role }}" value="{{ $role }}"
                                           {{ in_array($role, $allowedRoles) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold text-dark text-capitalize" for="visibility-{{ $role }}">
                                        {{ $role }} Dashboard
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Navigation & Search -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <!-- Tabs -->
            <ul class="nav nav-pills board-tabs" id="boardTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-pane" type="button" role="tab">
                        <i class="ti ti-calendar me-1"></i> Calendar View
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kanban-tab" data-bs-toggle="tab" data-bs-target="#kanban-pane" type="button" role="tab">
                        <i class="ti ti-layout-kanban me-1"></i> Kanban Board
                    </button>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="d-flex gap-2 justify-content-md-end">
                <input type="text" id="board-search" class="form-select border-light bg-white shadow-sm w-50" placeholder="Search events..." style="min-width: 200px;">
                <select id="board-type-filter" class="form-select border-light bg-white shadow-sm w-auto">
                    <option value="">All Types</option>
                    <option value="regular">Regular</option>
                    <option value="special">Special</option>
                    <option value="exhibition">Exhibition</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="inactive">Inactive / Draft</option>
                </select>
                <a href="{{ route('admin.event.create') }}" class="btn btn-outline-primary shadow-sm border-dashed">
                    <i class="ti ti-plus me-1"></i> New Event
                </a>
            </div>
        </div>
    </div>

    <!-- Tab Contents -->
    <div class="tab-content" id="boardTabContent">
        <!-- Calendar View Pane -->
        <div class="tab-pane fade show active" id="calendar-pane" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- Kanban Board Pane -->
        <div class="tab-pane fade" id="kanban-pane" role="tabpanel">
            <div class="kanban-wrapper">
                <!-- Draft / Inactive Column -->
                <div class="kanban-column" id="col-draft" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, 'draft')">
                    <div class="kanban-column-header">
                        <span class="text-danger"><i class="ti ti-file-text me-1"></i> Draft / Inactive</span>
                        <span class="badge bg-danger-subtle text-danger rounded-pill" id="badge-draft">0</span>
                    </div>
                    <div class="kanban-cards-container" id="cards-draft"></div>
                </div>

                <!-- Regular Column -->
                <div class="kanban-column" id="col-regular" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, 'regular')">
                    <div class="kanban-column-header">
                        <span style="color: #b78f4c;"><i class="ti ti-repeat me-1"></i> Regular</span>
                        <span class="badge rounded-pill" style="background: #fffdf0; color: #8d703d; border: 1px solid #c9a96e;" id="badge-regular">0</span>
                    </div>
                    <div class="kanban-cards-container" id="cards-regular"></div>
                </div>

                <!-- Special Column -->
                <div class="kanban-column" id="col-special" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, 'special')">
                    <div class="kanban-column-header">
                        <span class="text-warning"><i class="ti ti-star me-1"></i> Special</span>
                        <span class="badge bg-warning-subtle text-warning rounded-pill" id="badge-special">0</span>
                    </div>
                    <div class="kanban-cards-container" id="cards-special"></div>
                </div>

                <!-- Exhibition Column -->
                <div class="kanban-column" id="col-exhibition" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, 'exhibition')">
                    <div class="kanban-column-header">
                        <span class="text-primary"><i class="ti ti-building-store me-1"></i> Exhibition</span>
                        <span class="badge bg-primary-subtle text-primary rounded-pill" id="badge-exhibition">0</span>
                    </div>
                    <div class="kanban-cards-container" id="cards-exhibition"></div>
                </div>

                <!-- Upcoming Column -->
                <div class="kanban-column" id="col-upcoming" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, 'upcoming')">
                    <div class="kanban-column-header">
                        <span class="text-secondary"><i class="ti ti-clock me-1"></i> Upcoming</span>
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill" id="badge-upcoming">0</span>
                    </div>
                    <div class="kanban-cards-container" id="cards-upcoming"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Detail Modal -->
    <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalEventTitle">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <span class="badge px-3 py-2 rounded-pill mb-3" id="modalEventType"></span>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="round-40 rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-user text-muted fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <label class="form-label text-muted small fw-bold mb-0">Organizer</label>
                            <div class="fw-semibold text-dark fs-4" id="modalEventOrganizer">-</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="round-40 rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-calendar text-muted fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <label class="form-label text-muted small fw-bold mb-0">Date & Time</label>
                            <div class="text-dark" id="modalEventDate">-</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="round-40 rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-map-pin text-muted fs-5"></i>
                        </div>
                        <div class="ms-3">
                            <label class="form-label text-muted small fw-bold mb-0">Location</label>
                            <div class="text-dark" id="modalEventLocation">-</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold mb-1">Description</label>
                        <p class="text-secondary small bg-light p-3 rounded-3" id="modalEventDescription">-</p>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <a href="#" id="modalEditButton" class="btn btn-primary px-4"><i class="ti ti-pencil me-1"></i>Edit</a>
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let eventsCached = [];
            let activeFilters = {
                search: '',
                type: ''
            };

            // Setup CSFR protection for jQuery Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize FullCalendar
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                events: function(info, successCallback, failureCallback) {
                    $.ajax({
                        url: "{{ route('admin.event-board.api.list') }}",
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        success: function(events) {
                            eventsCached = events;
                            let filtered = applyClientFilters(events);
                            successCallback(filtered);
                        },
                        error: function(err) {
                            failureCallback(err);
                            toastr.error('Failed to load events.');
                        }
                    });
                },
                eventDrop: function(info) {
                    updateEventDates(info.event, info.revert);
                },
                eventResize: function(info) {
                    updateEventDates(info.event, info.revert);
                },
                eventClick: function(info) {
                    showEventDetails(info.event);
                }
            });

            calendar.render();

            // Client side filter logic
            function applyClientFilters(events) {
                return events.filter(event => {
                    const titleMatch = event.title.toLowerCase().includes(activeFilters.search.toLowerCase());
                    let typeMatch = true;

                    if (activeFilters.type) {
                        if (activeFilters.type === 'inactive') {
                            typeMatch = !event.extendedProps.is_active;
                        } else {
                            typeMatch = event.extendedProps.is_active && event.extendedProps.type === activeFilters.type;
                        }
                    }

                    return titleMatch && typeMatch;
                });
            }

            // Sync Filter Inputs
            $('#board-search').on('input', function() {
                activeFilters.search = $(this).val();
                calendar.refetchEvents();
                if ($('#kanban-tab').hasClass('active') || $('#kanban-pane').hasClass('show')) {
                    renderKanbanBoard(eventsCached);
                }
            });

            $('#board-type-filter').on('change', function() {
                activeFilters.type = $(this).val();
                calendar.refetchEvents();
                if ($('#kanban-tab').hasClass('active') || $('#kanban-pane').hasClass('show')) {
                    renderKanbanBoard(eventsCached);
                }
            });

            // Tab switch trigger to populate Kanban
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                if (e.target.id === 'kanban-tab') {
                    renderKanbanBoard(eventsCached);
                } else if (e.target.id === 'calendar-tab') {
                    calendar.updateSize();
                }
            });

            // Update dates via API
            function updateEventDates(fcEvent, revertFunc) {
                let startStr = fcEvent.startStr;
                let endStr = fcEvent.endStr || startStr;

                $.ajax({
                    url: `/dashboard/event-board/api/update-date/${fcEvent.id}`,
                    type: 'POST',
                    data: {
                        start_date: startStr,
                        end_date: endStr
                    },
                    success: function(response) {
                        toastr.success('Event dates rescheduled successfully!');
                        // Re-fetch list to sync data
                        refetchAll();
                    },
                    error: function(xhr) {
                        revertFunc();
                        toastr.error('Failed to reschedule event.');
                    }
                });
            }

            // Show details in modal
            function showEventDetails(fcEvent) {
                let props = fcEvent.extendedProps;
                $('#modalEventTitle').text(fcEvent.title);
                $('#modalEventOrganizer').text(props.organizer || '-');
                $('#modalEventLocation').text(props.location || '-');
                $('#modalEventDescription').html(props.description || '<i>No description provided.</i>');

                // Render Type Badge
                let typeBadge = $('#modalEventType');
                typeBadge.removeClass();
                typeBadge.addClass('badge px-3 py-2 rounded-pill');

                if (!props.is_active) {
                    typeBadge.addClass('bg-danger-subtle text-danger').text('Draft / Inactive');
                } else {
                    switch (props.type) {
                        case 'regular':
                            typeBadge.addClass('bg-warning-subtle text-warning').text('Regular');
                            break;
                        case 'special':
                            typeBadge.addClass('bg-warning text-white').text('Special');
                            break;
                        case 'exhibition':
                            typeBadge.addClass('bg-primary-subtle text-primary').text('Exhibition');
                            break;
                        default:
                            typeBadge.addClass('bg-secondary-subtle text-secondary').text('Upcoming');
                            break;
                    }
                }

                // Setup edit button
                $('#modalEditButton').attr('href', `/dashboard/event/edit/${props.uuid}`);

                // Format dates
                let dateStr = fcEvent.start.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
                if (fcEvent.end) {
                    // end date in fc is exclusive for all-day events, display correctly
                    let endDateAdjusted = new Date(fcEvent.end);
                    if (fcEvent.allDay) {
                        endDateAdjusted.setDate(endDateAdjusted.getDate() - 1);
                    }
                    dateStr += ' - ' + endDateAdjusted.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
                }
                
                // Add time if available
                if (!fcEvent.allDay) {
                    let timeOpt = { hour: '2-digit', minute: '2-digit' };
                    dateStr += ' (' + fcEvent.start.toLocaleTimeString([], timeOpt);
                    if (fcEvent.end) {
                        dateStr += ' - ' + fcEvent.end.toLocaleTimeString([], timeOpt);
                    }
                    dateStr += ')';
                }

                $('#modalEventDate').text(dateStr);

                let myModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                myModal.show();
            }

            // Refetch helper
            function refetchAll() {
                $.ajax({
                    url: "{{ route('admin.event-board.api.list') }}",
                    success: function(events) {
                        eventsCached = events;
                        calendar.refetchEvents();
                        if ($('#kanban-tab').hasClass('active')) {
                            renderKanbanBoard(eventsCached);
                        }
                    }
                });
            }

            // Save Settings
            $('#btn-save-visibility').on('click', function() {
                let selectedRoles = [];
                $('.role-visibility-checkbox:checked').each(function() {
                    selectedRoles.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('admin.event-board.save-settings') }}",
                    type: 'POST',
                    data: {
                        roles: selectedRoles
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error('Failed to save settings.');
                    }
                });
            });

            // Kanban Rendering
            function renderKanbanBoard(events) {
                // Clear columns
                $('.kanban-cards-container').empty();
                
                let filteredEvents = applyClientFilters(events);

                let counts = { draft: 0, regular: 0, special: 0, exhibition: 0, upcoming: 0 };

                filteredEvents.forEach(event => {
                    let props = event.extendedProps;
                    let columnId = 'draft';

                    if (props.is_active) {
                        columnId = props.type;
                    }

                    if (counts[columnId] !== undefined) {
                        counts[columnId]++;
                    }

                    // Render Card HTML
                    let badgeClass = 'bg-secondary-subtle text-secondary';
                    if (!props.is_active) {
                        badgeClass = 'bg-danger-subtle text-danger';
                    } else if (props.type === 'regular') {
                        badgeClass = 'bg-warning-subtle text-warning';
                    } else if (props.type === 'special') {
                        badgeClass = 'bg-warning text-white';
                    } else if (props.type === 'exhibition') {
                        badgeClass = 'bg-primary-subtle text-primary';
                    }

                    let cardHtml = `
                        <div class="kanban-card" draggable="true" data-uuid="${props.uuid}" id="card-${props.uuid}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge ${badgeClass} small text-capitalize">${props.is_active ? props.type : 'draft'}</span>
                                <button type="button" class="btn btn-sm p-0 text-muted quick-view-btn" data-uuid="${props.uuid}">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark text-truncate">${event.title}</h6>
                            <p class="text-muted small mb-2 text-truncate">${props.location || 'No Location'}</p>
                            <div class="d-flex align-items-center text-muted small mt-2">
                                <i class="ti ti-calendar me-1"></i>
                                <span style="font-size: 11px;">${formatDateString(event.start, event.end, event.allDay)}</span>
                            </div>
                        </div>
                    `;

                    $(`#cards-${columnId}`).append(cardHtml);
                });

                // Update Column Badges
                Object.keys(counts).forEach(col => {
                    $(`#badge-${col}`).text(counts[col]);
                });

                // Attach Card Drag Listeners
                document.querySelectorAll('.kanban-card').forEach(card => {
                    card.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', this.dataset.uuid);
                        this.style.opacity = '0.4';
                    });

                    card.addEventListener('dragend', function(e) {
                        this.style.opacity = '1';
                    });
                });

                // Attach Quick View Click Listener
                $('.quick-view-btn').on('click', function() {
                    let uuid = $(this).data('uuid');
                    let matchingEvent = eventsCached.find(e => e.id === uuid);
                    if (matchingEvent) {
                        // Recreate FullCalendar event object mock to show details
                        showEventDetails({
                            title: matchingEvent.title,
                            start: new Date(matchingEvent.start),
                            end: matchingEvent.end ? new Date(matchingEvent.end) : null,
                            allDay: matchingEvent.allDay,
                            extendedProps: matchingEvent.extendedProps
                        });
                    }
                });
            }

            // Date Format helper for Kanban card
            function formatDateString(startStr, endStr, allDay) {
                let start = new Date(startStr);
                let dateStr = start.toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
                
                if (endStr) {
                    let end = new Date(endStr);
                    if (allDay) {
                        end.setDate(end.getDate() - 1);
                    }
                    if (start.getMonth() === end.getMonth() && start.getFullYear() === end.getFullYear()) {
                        dateStr += ' - ' + end.getDate();
                    } else {
                        dateStr += ' - ' + end.toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
                    }
                }
                return dateStr;
            }
        });

        // Global drag functions
        function allowDrop(e) {
            e.preventDefault();
            let col = e.currentTarget;
            col.classList.add('drag-over');
        }

        function dragLeave(e) {
            let col = e.currentTarget;
            col.classList.remove('drag-over');
        }

        function drop(e, columnName) {
            e.preventDefault();
            let col = e.currentTarget;
            col.classList.remove('drag-over');

            let uuid = e.dataTransfer.getData('text/plain');
            if (uuid) {
                // AJAX call to save update
                $.ajax({
                    url: `/dashboard/event-board/api/update-kanban/${uuid}`,
                    type: 'POST',
                    data: {
                        column: columnName
                    },
                    success: function(response) {
                        toastr.success('Event status and type updated successfully!');
                        // Trigger reload of the list (will fetch and redraw calendar & kanban)
                        $('#calendar-tab').click();
                        setTimeout(() => {
                            $('#kanban-tab').click();
                        }, 50);
                    },
                    error: function(xhr) {
                        toastr.error('Failed to update event type.');
                    }
                });
            }
        }
    </script>
@endpush
