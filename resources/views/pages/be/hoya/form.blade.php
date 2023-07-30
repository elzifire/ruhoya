<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="etymology" class="form-label">Etimologi</label>
        <input type="text" class="form-control" name="etymology" value="{{isset($data) ? $data['etymology'] : ''}}" required>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="origin" class="form-label">Daerah Asal</label>
                <input type="text" class="form-control" name="origin" value="{{isset($data) ? $data['origin'] : ''}}" required>
            </div>
            <div class="col">
                <label for="local_name" class="form-label">Nama Daerah</label>
                <input type="text" class="form-control" name="local_name" value="{{isset($data) ? $data['local_name'] : ''}}" required>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" name="author" value="{{isset($data) ? $data['author'] : ''}}" required>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="publication" class="form-label">Publikasi</label>
                <input type="text" class="form-control" name="publication" value="{{isset($data) ? $data['publication'] : ''}}" required>
            </div>
            <div class="col">
                <label for="publication_link" class="form-label">Link Publikasi</label>
                <input type="url" class="form-control" name="publication_link" value="{{isset($data) ? $data['publication_link'] : ''}}" required>                
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="type_information" class="form-label">Informasi Tipe</label>
        <input type="text" class="form-control" name="type_information" value="{{isset($data) ? $data['type_information'] : ''}}" required>
    </div>
    <div class="mb-3">
        <label for="benefit" class="form-label">Manfaat</label>
        <input type="text" class="form-control" name="benefit" value="{{isset($data) ? $data['benefit'] : ''}}" required>
    </div>
    <div class="mb-3">
        <h4 class="border-bottom border-4 border-primary pb-2 mb-4 mt-4">Morfologi</h4>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="stem" class="form-label">Batang</label>
                <input type="text" class="form-control" name="stem" value="{{isset($data) ? $data['stem'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="leaves" class="form-label">Daun</label>
                <input type="text" class="form-control" name="leaves" value="{{isset($data) ? $data['leaves'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="flowers" class="form-label">Bentuk Bunga</label>
                <input type="text" class="form-control" name="flowers" value="{{isset($data) ? $data['flowers'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="flower_buds" class="form-label">Kuncup Bunga</label>
                <input type="text" class="form-control" name="flower_buds" value="{{isset($data) ? $data['flower_buds'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="flower_size" class="form-label">Ukuran Bunga</label>
                <input type="text" class="form-control" name="flower_size" value="{{isset($data) ? $data['flower_size'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="flower_colors" class="form-label">Warna Bunga</label>
                <input type="text" class="form-control" name="flower_colors" value="{{isset($data) ? $data['flower_colors'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="roots" class="form-label">Akar</label>
                <input type="text" class="form-control" name="roots" value="{{isset($data) ? $data['roots'] : ''}}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="shoots" class="form-label">Tunas</label>
                <input type="text" class="form-control" name="shoots" value="{{isset($data) ? $data['shoots'] : ''}}">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="reproduction_system" class="form-label">Sistem Reproduksi</label>
                <input type="text" class="form-control" name="reproduction_system" value="{{isset($data) ? $data['reproduction_system'] : ''}}">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="d-flex justify-content-between border-bottom border-4 border-primary pb-2 mb-4 mt-4">
            <h4>Foto</h4>
            <button type="button" class="btn btn-primary btn-sm" data-btn-add-images>
                <i class="bx bx-plus align-middle"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="white-space: nowrap;">File</th>
                        <th style="white-space: nowrap;">Deskripsi</th>
                        <th style="white-space: nowrap;"></th>
                    </tr>
                </thead>
                <tbody data-image-inputs>
                    @if (isset($data))
                        @foreach ($data->hoyaImages as $index => $hoyaImage)
                            <tr data-index="{{$index}}">
                                <input type="hidden"  name="hoya_images[{{$index}}][id]" value="{{$hoyaImage->id}}">
                                <td class="align-middle">
                                    <input type="file" class="form-control" name="hoya_images[{{$index}}][file]" accept="image/*">
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_images[{{$index}}][description]" value="{{$hoyaImage->description}}">
                                </td>
                                <td class="d-flex gap-1 align-middle">
                                    <a href="{{url('uploads/' . $hoyaImage->image)}}" class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">
                                        <i class="bx bxs-detail align-middle"></i>Preview
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="$(`[data-image-inputs] > [data-index='{{$index}}']`).remove()">
                                        <i class="bx bx-trash align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr data-index="0">
                            <td class="align-middle">
                                <input type="file" class="form-control" name="hoya_images[0][file]" accept="image/*" {{!isset($data) ? "required" : ""}}>
                            </td>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_images[0][description]" required>
                            </td>
                            <td class="align-middle"></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-3">
        <div class="d-flex justify-content-between border-bottom border-4 border-primary pb-2 mb-4 mt-4">
            <h4>Sebaran</h4>
            <button type="button" class="btn btn-primary btn-sm" data-btn-add-spreads>
                <i class="bx bx-plus align-middle"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="white-space: nowrap;">Deskripsi</th>
                        <th style="white-space: nowrap;">Latitude</th>
                        <th style="white-space: nowrap;">Longitude</th>
                        <th style="white-space: nowrap;"></th>
                    </tr>
                </thead>
                <tbody data-spread-inputs>
                    @if (isset($data))
                        @foreach ($data->hoyaSpreads as $index => $hoyaSpread)
                            <tr data-index="{{$index}}">
                                <input type="hidden"  name="hoya_spreads[{{$index}}][id]" value="{{$hoyaSpread->id}}">
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][description]" value="{{$hoyaSpread->description}}" required>
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][latitude]" value="{{$hoyaSpread->latitude}}" required>
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][longitude]" value="{{$hoyaSpread->longitude}}" required>
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="$(`[data-spread-inputs] > [data-index='{{$index}}']`).remove()">
                                        <i class="bx bx-trash align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr data-index="0">
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_spreads[0][description]">
                            </td>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_spreads[0][latitude]">
                            </td>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_spreads[0][longitude]">
                            </td>
                            <td class="align-middle"></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>