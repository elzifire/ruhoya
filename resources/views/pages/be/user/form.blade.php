<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" value="{{isset($data) ? $data['email'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" {{!isset($data) ? "required" : ""}}>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>