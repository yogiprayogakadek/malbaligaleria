@extends('templates.backend.master')
@section('page-title', 'Event Board')
@section('page-link', route('admin.event-board.index'))

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
<style>
.board-tabs .nav-link { border:none; color:#718096; font-weight:600; padding:10px 20px; border-radius:20px; margin-right:8px; transition:all .25s; }
.board-tabs .nav-link.active { background:#5d87ff; color:#fff!important; box-shadow:0 4px 10px rgba(93,135,255,.3); }
#fc-board { background:#fff; border-radius:12px; border:1px solid #e2e8f0; padding:15px; }
.fc-event { cursor:pointer; border-radius:6px; font-size:.82rem; padding:2px 5px; transition:transform .15s; }
.fc-event:hover { transform:scale(1.02); }
.kanban-wrap { display:flex; gap:14px; overflow-x:auto; min-height:580px; padding-bottom:20px; }
.k-col { flex:0 0 270px; background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0; padding:14px; display:flex; flex-direction:column; }
.k-col.drag-over { background:#edf2f7; border-color:#5d87ff; }
.k-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; font-weight:700; }
.k-cards { display:flex; flex-direction:column; gap:10px; overflow-y:auto; flex-grow:1; min-height:80px; }
.k-card { background:#fff; border-radius:10px; border:1px solid #e2e8f0; padding:12px; cursor:grab; transition:transform .2s,box-shadow .2s; user-select:none; position:relative; }
.k-card:hover { transform:translateY(-3px); box-shadow:0 5px 12px rgba(0,0,0,.08); }
.k-card .color-bar { position:absolute; left:0; top:0; bottom:0; width:4px; border-radius:10px 0 0 10px; }
.k-card-inner { padding-left:10px; }
.vis-chip { display:inline-flex; align-items:center; gap:6px; background:#edf2f7; border-radius:20px; padding:4px 10px; font-size:.82rem; }
.vis-chip button { background:none; border:none; padding:0; line-height:1; color:#718096; cursor:pointer; }
.color-swatch { width:24px; height:24px; border-radius:50%; cursor:pointer; border:3px solid transparent; transition:border-color .2s; }
.color-swatch.selected { border-color:#1a202c; }
.section-divider { border:none; border-top:1px dashed #e2e8f0; margin:16px 0; }
</style>
@endpush

@section('content')
<div class="container-fluid">

{{-- VISIBILITY SETTINGS (Superuser only) --}}
@if($isSuperUser)
<div class="card mb-4 border-0 shadow-sm" style="border-radius:14px; background:linear-gradient(135deg,#fff 0%,#f0f4ff 100%);">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-start mb-3">
      <div>
        <h5 class="fw-bold mb-1"><i class="ti ti-eye me-1 text-primary"></i> Pengaturan Visibilitas Event Board</h5>
        <p class="text-muted small mb-0">Pilih siapa yang bisa melihat menu <strong>Event Board</strong> di sidebar mereka.</p>
      </div>
      <button id="btn-save-vis" class="btn btn-primary px-4"><i class="ti ti-device-floppy me-1"></i>Simpan</button>
    </div>

    <div class="form-check form-switch mb-3">
      <input class="form-check-input" type="checkbox" id="chk-all-roles" {{ $allRoles ? 'checked' : '' }}>
      <label class="form-check-label fw-semibold" for="chk-all-roles">Tampilkan ke <strong>semua role</strong></label>
    </div>

    <div id="vis-detail" class="{{ $allRoles ? 'd-none' : '' }}">
      <p class="text-muted small fw-semibold mb-2">Berdasarkan Role:</p>
      <div class="d-flex flex-wrap gap-3 mb-3">
        @foreach($allRolesList as $role)
        <div class="form-check">
          <input class="form-check-input role-chk" type="checkbox" id="role-{{ $role }}" value="{{ $role }}" {{ in_array($role, $allowedRoles) ? 'checked' : '' }}>
          <label class="form-check-label text-capitalize fw-semibold" for="role-{{ $role }}">{{ ucfirst($role) }}</label>
        </div>
        @endforeach
      </div>
      <hr class="section-divider">
      <p class="text-muted small fw-semibold mb-2">Berdasarkan User Spesifik:</p>
      <div class="d-flex gap-2 mb-2">
        <input type="text" id="user-search-input" class="form-control form-control-sm" placeholder="Cari nama atau email user..." style="max-width:320px;">
      </div>
      <div id="user-search-results" class="list-group mb-3" style="max-width:320px; display:none;"></div>
      <div id="selected-users-wrap" class="d-flex flex-wrap gap-2">
        @foreach($selectedUsers as $su)
        <span class="vis-chip" data-uid="{{ $su->id }}">
          <i class="ti ti-user" style="font-size:12px;"></i> {{ $su->name }}
          <button type="button" onclick="removeUser({{ $su->id }})"><i class="ti ti-x" style="font-size:11px;"></i></button>
        </span>
        @endforeach
      </div>
      <input type="hidden" id="selected-user-ids" value="{{ implode(',', $allowedUserIds) }}">
    </div>
  </div>
</div>
@endif

{{-- TOOLBAR --}}
<div class="row align-items-center mb-3 g-2">
  <div class="col-md-5">
    <ul class="nav nav-pills board-tabs" id="boardTab">
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-cal" id="tab-cal"><i class="ti ti-calendar me-1"></i>Kalender</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-kb" id="tab-kb"><i class="ti ti-layout-kanban me-1"></i>Kanban</button></li>
    </ul>
  </div>
  <div class="col-md-7 d-flex gap-2 justify-content-md-end">
    <input id="s-search" type="text" class="form-control border-light bg-white shadow-sm" placeholder="Cari jadwal..." style="max-width:200px;">
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#scheduleModal" onclick="openAddModal()">
      <i class="ti ti-plus me-1"></i>Tambah Jadwal
    </button>
  </div>
</div>

{{-- TAB CONTENT --}}
<div class="tab-content">
  <div class="tab-pane fade show active" id="pane-cal"><div id="fc-board"></div></div>
  <div class="tab-pane fade" id="pane-kb">
    <div class="kanban-wrap">
      @foreach([['draft','Draft','text-secondary','ti-file'], ['todo','To Do','text-primary','ti-circle-check'], ['in_progress','In Progress','text-warning','ti-loader'], ['done','Done','text-success','ti-circle-check-filled']] as [$col,$label,$cls,$icon])
      <div class="k-col" id="col-{{$col}}" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event,'{{$col}}')">
        <div class="k-head">
          <span class="{{$cls}}"><i class="ti {{$icon}} me-1"></i>{{$label}}</span>
          <span class="badge bg-light text-dark rounded-pill" id="badge-{{$col}}">0</span>
        </div>
        <div class="k-cards" id="cards-{{$col}}"></div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- ADD/EDIT MODAL --}}
<div class="modal fade" id="scheduleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="modal-title">Tambah Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body px-4">
        <input type="hidden" id="form-uuid">
        <div class="mb-3">
          <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
          <input type="text" id="form-title" class="form-control" placeholder="Nama jadwal kegiatan">
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Deskripsi</label>
          <textarea id="form-desc" class="form-control" rows="3" placeholder="Keterangan / perihal kegiatan"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Lokasi</label>
          <input type="text" id="form-location" class="form-control" placeholder="Lokasi kegiatan">
        </div>
        <div class="row g-2 mb-3">
          <div class="col-6">
            <label class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
            <input type="date" id="form-start-date" class="form-control">
          </div>
          <div class="col-6">
            <label class="form-label fw-semibold">Tanggal Selesai</label>
            <input type="date" id="form-end-date" class="form-control">
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-6">
            <label class="form-label fw-semibold">Jam Mulai</label>
            <input type="time" id="form-start-time" class="form-control">
          </div>
          <div class="col-6">
            <label class="form-label fw-semibold">Jam Selesai</label>
            <input type="time" id="form-end-time" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Kolom Status</label>
          <select id="form-column" class="form-select">
            <option value="draft">Draft</option>
            <option value="todo" selected>To Do</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Warna</label>
          <div class="d-flex gap-2 flex-wrap" id="color-swatches">
            @foreach(['#5d87ff','#13deb9','#fa896b','#ffae1f','#39afd1','#7460ee'] as $c)
            <div class="color-swatch {{ $c === '#5d87ff' ? 'selected' : '' }}" style="background:{{$c}};" data-color="{{$c}}" onclick="selectColor('{{$c}}')"></div>
            @endforeach
          </div>
          <input type="hidden" id="form-color" value="#5d87ff">
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger me-auto d-none" id="btn-delete-schedule" onclick="deleteSchedule()"><i class="ti ti-trash me-1"></i>Hapus</button>
        <button type="button" class="btn btn-primary px-4" onclick="saveSchedule()"><i class="ti ti-device-floppy me-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
let calendar, cachedSchedules = [], searchTerm = '';

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

document.addEventListener('DOMContentLoaded', function () {
    // FullCalendar init
    calendar = new FullCalendar.Calendar(document.getElementById('fc-board'), {
        initialView: 'dayGridMonth',
        headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay' },
        editable: true,
        events: fetchEvents,
        eventDrop: info => updateDate(info.event, info.revert),
        eventResize: info => updateDate(info.event, info.revert),
        eventClick: info => openEditModal(info.event.extendedProps.uuid),
    });
    calendar.render();

    // Tab switch
    document.getElementById('tab-kb').addEventListener('click', () => {
        setTimeout(() => renderKanban(cachedSchedules), 50);
    });
    document.getElementById('tab-cal').addEventListener('click', () => setTimeout(() => calendar.updateSize(), 50));

    // Search filter
    $('#s-search').on('input', function () {
        searchTerm = this.value.toLowerCase();
        calendar.refetchEvents();
        if (document.getElementById('pane-kb').classList.contains('show')) renderKanban(cachedSchedules);
    });

    // Visibility: all roles toggle
    $('#chk-all-roles').on('change', function () {
        $('#vis-detail').toggleClass('d-none', this.checked);
    });

    // User search autocomplete
    let searchTimer;
    $('#user-search-input').on('input', function () {
        clearTimeout(searchTimer);
        const q = this.value.trim();
        if (q.length < 2) { $('#user-search-results').hide(); return; }
        searchTimer = setTimeout(() => {
            $.get("{{ route('admin.event-board.search-users') }}", { q }, function (users) {
                const $r = $('#user-search-results').empty().show();
                users.forEach(u => {
                    const ids = getSelectedUserIds();
                    if (ids.includes(u.id)) return;
                    $r.append(`<button class="list-group-item list-group-item-action py-1 small" onclick="addUser(${u.id},'${u.name}')" type="button">${u.name} <span class="text-muted">(${u.email})</span></button>`);
                });
                if (!$r.children().length) $r.append('<span class="list-group-item small text-muted">Tidak ditemukan</span>');
            });
        }, 300);
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#user-search-input, #user-search-results').length) $('#user-search-results').hide();
    });

    // Save visibility
    $('#btn-save-vis').on('click', function () {
        const allRoles = $('#chk-all-roles').is(':checked');
        const roles = $('.role-chk:checked').map((_, el) => el.value).get();
        const users = getSelectedUserIds();
        $.post("{{ route('admin.event-board.save-settings') }}", { all_roles: allRoles ? 1 : 0, roles, users }, res => {
            toastr.success(res.message);
        }).fail(() => toastr.error('Gagal menyimpan pengaturan.'));
    });
});

// ── Fetch ──────────────────────────────────────────────────────────────────
function fetchEvents(info, success, failure) {
    $.get("{{ route('admin.event-board.api.list') }}", { start: info.startStr, end: info.endStr }, function (data) {
        cachedSchedules = data;
        success(applyFilter(data));
    }).fail(failure);
}

function applyFilter(data) {
    if (!searchTerm) return data;
    return data.filter(e => e.title.toLowerCase().includes(searchTerm));
}

// ── Calendar DnD ──────────────────────────────────────────────────────────
function updateDate(fcEvent, revert) {
    $.post(`/dashboard/event-board/api/update-date/${fcEvent.id}`, {
        start_date: fcEvent.startStr, end_date: fcEvent.endStr || fcEvent.startStr
    }, () => { toastr.success('Jadwal diperbarui!'); refetchAll(); }).fail(() => { revert(); toastr.error('Gagal memperbarui tanggal.'); });
}

// ── Kanban ────────────────────────────────────────────────────────────────
function renderKanban(data) {
    const filtered = applyFilter(data);
    ['draft','todo','in_progress','done'].forEach(col => { $(`#cards-${col}`).empty(); $(`#badge-${col}`).text(0); });
    const counts = {};
    filtered.forEach(e => {
        const col = e.extendedProps.column || 'todo';
        counts[col] = (counts[col] || 0) + 1;
        const html = `<div class="k-card" draggable="true" data-uuid="${e.extendedProps.uuid}" id="kcard-${e.extendedProps.uuid}">
            <div class="color-bar" style="background:${e.extendedProps.color}"></div>
            <div class="k-card-inner">
                <div class="d-flex justify-content-between align-items-start">
                    <h6 class="fw-bold mb-1 text-truncate" style="max-width:180px;">${e.title}</h6>
                    <button class="btn btn-sm p-0 ms-1 text-muted" onclick="openEditModal('${e.extendedProps.uuid}')"><i class="ti ti-pencil" style="font-size:13px;"></i></button>
                </div>
                <p class="text-muted small mb-1 text-truncate">${e.extendedProps.location || '<span class="fst-italic">Lokasi belum diisi</span>'}</p>
                <span class="badge bg-light text-dark small"><i class="ti ti-calendar me-1"></i>${formatDateRange(e.extendedProps.actual_start_date, e.extendedProps.actual_end_date)}</span>
            </div></div>`;
        $(`#cards-${col}`).append(html);
    });
    Object.entries(counts).forEach(([col, n]) => $(`#badge-${col}`).text(n));
    document.querySelectorAll('.k-card').forEach(card => {
        card.addEventListener('dragstart', e => { e.dataTransfer.setData('text/plain', card.dataset.uuid); card.style.opacity = '.4'; });
        card.addEventListener('dragend', () => card.style.opacity = '1');
    });
}

function allowDrop(e) { e.preventDefault(); e.currentTarget.classList.add('drag-over'); }
function dragLeave(e) { e.currentTarget.classList.remove('drag-over'); }
function drop(e, col) {
    e.preventDefault(); e.currentTarget.classList.remove('drag-over');
    const uuid = e.dataTransfer.getData('text/plain');
    if (!uuid) return;
    $.post(`/dashboard/event-board/api/update-kanban/${uuid}`, { column: col }, () => {
        toastr.success('Status diperbarui!'); refetchAll();
    }).fail(() => toastr.error('Gagal memindahkan jadwal.'));
}

function refetchAll() {
    $.get("{{ route('admin.event-board.api.list') }}", data => {
        cachedSchedules = data;
        calendar.refetchEvents();
        if (document.getElementById('pane-kb').classList.contains('show')) renderKanban(data);
    });
}

// ── Modal Add/Edit ─────────────────────────────────────────────────────────
function openAddModal() {
    $('#modal-title').text('Tambah Jadwal');
    $('#form-uuid,#form-title,#form-desc,#form-location,#form-start-time,#form-end-time').val('');
    $('#form-start-date').val(localDateStr(new Date()));  // local date, not UTC
    $('#form-end-date').val('');
    $('#form-column').val('todo');
    selectColor('#5d87ff');
    $('#btn-delete-schedule').addClass('d-none');
}

function openEditModal(uuid) {
    const s = cachedSchedules.find(e => e.id === uuid || e.extendedProps?.uuid === uuid);
    if (!s) return;
    const p = s.extendedProps;
    $('#modal-title').text('Edit Jadwal');
    $('#form-uuid').val(p.uuid);
    $('#form-title').val(s.title);
    $('#form-desc').val(p.description || '');
    $('#form-location').val(p.location || '');
    // Use actual (inclusive) dates stored in extendedProps — plain YYYY-MM-DD, no timezone issues
    $('#form-start-date').val(p.actual_start_date || (s.start ? s.start.slice(0, 10) : ''));
    $('#form-end-date').val(p.actual_end_date || '');
    $('#form-start-time').val(p.start_time || '');
    $('#form-end-time').val(p.end_time || '');
    $('#form-column').val(p.column || 'todo');
    selectColor(p.color || '#5d87ff');
    $('#btn-delete-schedule').removeClass('d-none');
    new bootstrap.Modal(document.getElementById('scheduleModal')).show();
}

function saveSchedule() {
    const uuid = $('#form-uuid').val();
    const data = {
        title: $('#form-title').val(), description: $('#form-desc').val(),
        location: $('#form-location').val(), start_date: $('#form-start-date').val(),
        end_date: $('#form-end-date').val(), start_time: $('#form-start-time').val(),
        end_time: $('#form-end-time').val(), column: $('#form-column').val(),
        color: $('#form-color').val(),
    };
    if (!data.title || !data.start_date) { toastr.warning('Judul dan tanggal mulai wajib diisi.'); return; }

    const req = uuid
        ? $.ajax({ url: `/dashboard/event-board/api/update/${uuid}`, type: 'PUT', data })
        : $.post('/dashboard/event-board/api/store', data);

    req.done(res => {
        toastr.success(res.message);
        bootstrap.Modal.getInstance(document.getElementById('scheduleModal'))?.hide();
        refetchAll();
    }).fail(() => toastr.error('Gagal menyimpan jadwal.'));
}

function deleteSchedule() {
    const uuid = $('#form-uuid').val();
    if (!uuid || !confirm('Yakin ingin menghapus jadwal ini?')) return;
    $.ajax({ url: `/dashboard/event-board/api/delete/${uuid}`, type: 'DELETE' })
        .done(res => {
            toastr.success(res.message);
            bootstrap.Modal.getInstance(document.getElementById('scheduleModal'))?.hide();
            refetchAll();
        }).fail(() => toastr.error('Gagal menghapus jadwal.'));
}

// ── Color Picker ───────────────────────────────────────────────────────────
function selectColor(c) {
    $('#form-color').val(c);
    document.querySelectorAll('.color-swatch').forEach(el => {
        el.classList.toggle('selected', el.dataset.color === c);
    });
}

// ── Visibility Helpers ─────────────────────────────────────────────────────
function getSelectedUserIds() {
    const val = $('#selected-user-ids').val();
    return val ? val.split(',').map(Number).filter(Boolean) : [];
}
function addUser(id, name) {
    const ids = getSelectedUserIds();
    if (ids.includes(id)) return;
    ids.push(id);
    $('#selected-user-ids').val(ids.join(','));
    $('#selected-users-wrap').append(`<span class="vis-chip" data-uid="${id}"><i class="ti ti-user" style="font-size:12px;"></i> ${name}<button type="button" onclick="removeUser(${id})"><i class="ti ti-x" style="font-size:11px;"></i></button></span>`);
    $('#user-search-results').hide();
    $('#user-search-input').val('');
}
function removeUser(id) {
    const ids = getSelectedUserIds().filter(x => x !== id);
    $('#selected-user-ids').val(ids.join(','));
    $(`#selected-users-wrap .vis-chip[data-uid="${id}"]`).remove();
}

// ── Utility ────────────────────────────────────────────────────────────────
// Returns YYYY-MM-DD using LOCAL timezone (avoids UTC offset bug with toISOString)
function localDateStr(date) {
    if (!date) return '';
    const d = (date instanceof Date) ? date : new Date(date);
    if (isNaN(d)) return '';
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${y}-${m}-${day}`;
}

// Parse YYYY-MM-DD safely in local time
function parseLocalDate(str) {
    if (!str) return null;
    const parts = str.slice(0, 10).split('-');
    return new Date(+parts[0], +parts[1] - 1, +parts[2]);
}

function formatDate(str) {
    if (!str) return '';
    // Parse YYYY-MM-DD without time to avoid UTC offset shift
    const d = parseLocalDate(str);
    if (!d) return '';
    return d.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
}

// Show "17 Jul" or "17 – 25 Jul 2026" or "17 Jul – 3 Agt 2026"
function formatDateRange(startStr, endStr) {
    if (!startStr) return '';
    const start = parseLocalDate(startStr);
    const end   = endStr ? parseLocalDate(endStr) : null;

    const opts = { day: 'numeric', month: 'short' };
    const optsYear = { day: 'numeric', month: 'short', year: 'numeric' };

    if (!end || startStr === endStr) {
        // Single day — show full date
        return start.toLocaleDateString('id-ID', optsYear);
    }

    const sameMonth = start.getMonth() === end.getMonth() && start.getFullYear() === end.getFullYear();
    const sameYear  = start.getFullYear() === end.getFullYear();

    if (sameMonth) {
        // e.g. "17 – 25 Jul 2026"
        const startDay = start.toLocaleDateString('id-ID', { day: 'numeric' });
        const endFull  = end.toLocaleDateString('id-ID', optsYear);
        return `${startDay} – ${endFull}`;
    } else if (sameYear) {
        // e.g. "17 Jul – 3 Agt 2026"
        const startShort = start.toLocaleDateString('id-ID', opts);
        const endFull    = end.toLocaleDateString('id-ID', optsYear);
        return `${startShort} – ${endFull}`;
    } else {
        // Different years
        return `${start.toLocaleDateString('id-ID', optsYear)} – ${end.toLocaleDateString('id-ID', optsYear)}`;
    }
}
</script>
@endpush
