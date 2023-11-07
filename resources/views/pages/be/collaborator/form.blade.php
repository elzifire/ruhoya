<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="institute" class="form-label">Instansi</label>
        <input type="text" class="form-control" name="institute" value="{{isset($data) ? $data['institute'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="contribution" class="form-label">Kontribusi</label>
        <input type="text" class="form-control" name="contribution" value="{{isset($data) ? $data['contribution'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="sequence" class="form-label">Urutan</label>
        <input type="number" class="form-control" name="sequence" value="{{isset($data) ? $data['sequence'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" name="image" accept="image/*" {{!isset($data) ? "required" : ""}}>
        @if (isset($data['image']))
            <img src="{{url('uploads/' . $data['image'])}}" alt="Image" class="img-fluid mt-2">
        @endif
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>