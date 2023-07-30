<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Gelar</label>
        <input type="text" class="form-control" name="title" value="{{isset($data) ? $data['title'] : ''}}" required>
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