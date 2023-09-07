<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="file" class="form-label">File</label>
        <input type="file" class="form-control" name="file" required>
    </div>
    <div class="d-flex justify-content-between">
        <a href="{{asset('format/import-hoya.xlsx')}}" class="btn btn-success" download>Download Format</a>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>