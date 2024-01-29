<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="group" class="form-label">Grup</label>
        <select name="group" class="form-select">
            <option value="" selected>-- Pilih --</option>
            @foreach ($groups as $group)
                <option value="{{$group->value}}" {{(isset($data) && $data->group === $group->value) ? "selected" : ""}}>{{$group->value}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" required>
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <label class="form-check-label" for="yes_no_question">Pertanyaan Ya / Tidak</label>
            <input class="form-check-input" type="checkbox" name="yes_no_question" role="switch" {{isset($data) ? ($data['yes_no_question'] == 1 ? 'checked' : '') : ''}} id="yes_no_question">
        </div>
    </div>
    <div class="mb-3 {{isset($data) ? ($data['yes_no_question'] == 1 ? 'd-none' : '') : ''}}" data-options>
        <div class="d-flex justify-content-between border-bottom border-4 border-primary pb-2 mb-4 mt-4">
            <label for="value" class="form-label">Opsi Pilihan</label>
            <button type="button" class="btn btn-primary btn-sm" data-btn-add-options>
                <i class="bx bx-plus align-middle"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="white-space: nowrap;">Value</th>
                        <th style="white-space: nowrap;"></th>
                    </tr>
                </thead>
                <tbody data-option-inputs>
                    @if (isset($data))
                        @foreach ($data->options as $index => $option)
                            <tr data-index="{{$index}}">
                                <input type="hidden"  name="options[{{$index}}][id]" value="{{$option->id}}">
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="options[{{$index}}][value]" value="{{$option->value}}" required>
                                </td>
                                <td class="align-middle" style="white-space: nowrap;">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="$(`[data-option-inputs] > [data-index='{{$index}}']`).remove()">
                                        <i class="bx bx-trash align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>