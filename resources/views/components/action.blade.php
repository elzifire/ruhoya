<div class="d-flex gap-1">
    @if (isset($detail))
        <a href="javascript:void(0);" class="btn btn-success btn-label btn-sm" onclick="openForm('{{ $detail }}', 'detail', 'lg')">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="bx bxs-detail label-icon align-middle fs-16 me-2"></i>
                </div>
                <div class="flex-grow-1">
                    Detail
                </div>
            </div>
        </a>
    @endif

    @if (isset($edit))
        <a href="javascript:void(0);" class="btn btn-primary btn-label btn-sm" onclick="openForm('{{ $edit }}', 'edit', 'lg')">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="bx bx-pencil label-icon align-middle fs-16 me-2"></i>
                </div>
                <div class="flex-grow-1">
                    Edit
                </div>
            </div>
        </a>
    @endif

    @if (isset($delete))
        <a href="javascript:void(0);" class="btn btn-danger btn-label btn-sm" onclick="deleteAlert('{{ $delete }}')">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="bx bx-trash label-icon align-middle fs-16 me-2"></i>
                </div>
                <div class="flex-grow-1">
                    Hapus
                </div>
            </div>
        </a>
    @endif
</div>