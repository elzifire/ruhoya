<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="group" class="form-label">Grup</label>
        <input type="text" class="form-control" name="group" value="{{isset($data) ? $data['group'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="key" class="form-label">Kunci</label>
        <input type="text" class="form-control" name="key" value="{{isset($data) ? $data['key'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="value" class="form-label">Nilai</label>
        <input type="text" class="form-control" name="value" value="{{isset($data) ? $data['value'] : ''}}" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>