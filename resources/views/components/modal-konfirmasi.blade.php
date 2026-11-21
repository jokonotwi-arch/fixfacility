@props([
    'id' => 'modal-konfirmasi-hapus',
    'titleId' => 'modal-hapus-title',
    'descId' => 'modal-hapus-desc',
    'formId' => 'modal-hapus-form',
    'title' => 'Hapus laporan ini?',
    'desc' => 'Laporan akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.',
    'cancelText' => 'Batal',
    'confirmText' => 'Ya, Hapus',
    'action' => '#',
])

<div class="mask" id="{{ $id }}">
    <div class="mod">
        <div class="x">!</div>
        <h2 id="{{ $titleId }}">{{ $title }}</h2>
        <p id="{{ $descId }}">{{ $desc }}</p>
        <form id="{{ $formId }}" method="POST" action="{{ $action }}">
            @csrf
            @method('DELETE')
            <div class="acts">
                <button type="button" class="btn gr" onclick="tutupModalHapus()">{{ $cancelText }}</button>
                <button type="submit" class="btn red">{{ $confirmText }}</button>
            </div>
        </form>
    </div>
</div>
