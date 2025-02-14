<form action="{{$action}}" method="POST" onsubmit="return false;">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">Hoya</span>
            <input type="text" class="form-control" name="name" value="{{isset($data) ? $data['name'] : ''}}" {{--required --}}>
        </div>
    </div>
    <div class="mb-3">
        <label for="etymology" class="form-label">Etimologi</label>
        <input type="text" class="form-control" name="etymology" value="{{isset($data) ? $data['etymology'] : ''}}" {{--required --}}>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="origin" class="form-label">Daerah Pertama Ditemukan</label>
                <input type="text" class="form-control" name="origin" value="{{isset($data) ? $data['origin'] : ''}}" {{--required --}}>
            </div>
            <div class="col">
                <label for="local_name" class="form-label">Nama Lokal</label>
                <input type="text" class="form-control" name="local_name" value="{{isset($data) ? $data['local_name'] : ''}}" {{--required --}}>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" name="author" value="{{isset($data) ? $data['author'] : ''}}" {{--required --}}>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="publication" class="form-label">Publikasi</label>
                <input type="text" class="form-control" name="publication" value="{{isset($data) ? $data['publication'] : ''}}" {{--required --}}>
            </div>
            <div class="col">
                <label for="publication_link" class="form-label">Link Publikasi</label>
                <input type="url" class="form-control" name="publication_link" value="{{isset($data) ? $data['publication_link'] : ''}}" {{--required --}}>                
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="type_information" class="form-label">Informasi Tipe</label>
        <input type="text" class="form-control" name="type_information" value="{{isset($data) ? $data['type_information'] : ''}}" {{--required --}}>
    </div>
    <div class="mb-3">
        <label for="benefit" class="form-label">Manfaat</label>
        <select class="form-control" name="benefit[]" id="benefit" multiple="multiple" {{--required --}}>
            @php $selectedBenefits = isset($data) ? explode(",", $data["benefit"]) : []; @endphp
            @foreach ($benefits as $item)
                <option value="{{$item->value}}" {{(isset($data) && in_array($item->value, $selectedBenefits)) ? "selected" : ""}}>{{$item->value}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <h4 class="border-bottom border-4 border-primary pb-2 mb-4 mt-4">Morfologi</h4>
        <div class="row">
            @php $index = 0; @endphp
            @foreach ($morfologies as $key => $group)
                <div class="col-12">
                    <h5 class="border-bottom border-2 border-primary pb-2 mb-2">{{$key}}</h5>
                </div>
                @foreach ($group as $rowIndex => $morfology)
                    <div class="col-sm-12 mb-3 {{(count($group) === 1 || (count($group) % 2 === 1 && count($group) - 1 === $rowIndex)) ? "col-md-12" : "col-md-6"}}">
                        <label class="form-label d-block">{{$morfology->name}}</label>
                        <input type="hidden" name="morfology[{{$index}}][id]" value="{{$morfology->id}}">
                        <select name="morfology[{{$index}}][value]" class="form-select">
                            <option value="" selected></option>
                            @foreach ($morfology->options as $option)
                                <option value="{{$option->value}}" {{(isset($data) && $data->hoyaMorfologies()->where("morfology_id", $morfology->id)->first()?->value === $option->value) ? "selected" : ""}}>{{$option->value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @php $index += 1; @endphp
                @endforeach
            @endforeach
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
                        <th style="white-space: nowrap;">Fotografer</th>
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
                                    <input type="text" class="form-control" name="hoya_images[{{$index}}][description]" value="{{$hoyaImage->description}}" {{--required --}}>
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_images[{{$index}}][photographer]" value="{{$hoyaImage->photographer}}" {{--required --}}>
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
                                <input type="file" class="form-control" name="hoya_images[0][file]" accept="image/*" {{!isset($data) ? "{{--required --}}" : ""}}>
                            </td>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_images[0][description]" {{--required --}}>
                            </td>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="hoya_images[0][photographer]" {{--required --}}>
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
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][description]" value="{{$hoyaSpread->description}}" {{--required --}}>
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][latitude]" value="{{$hoyaSpread->latitude}}" {{--required --}}>
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" name="hoya_spreads[{{$index}}][longitude]" value="{{$hoyaSpread->longitude}}" {{--required --}}>
                                </td>
                                <td class="align-middle" style="white-space: nowrap;">
                                    <button type="button" class="btn btn-primary btn-sm" data-pick-from-map="{{$index}}">
                                        <i class="bx bx-map align-middle"></i> Pilih Lewat Peta
                                    </button>
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
                            <td class="align-middle" style="white-space: nowrap;">
                                <button type="button" class="btn btn-primary btn-sm" data-pick-from-map="0">
                                    <i class="bx bx-map align-middle"></i> Pilih Lewat Peta
                                </button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-3">
        <div class="d-flex justify-content-between border-bottom border-4 border-primary pb-2 mb-4 mt-4">
            <h4>Sekuens DNA</h4>
            <button type="button" class="btn btn-primary btn-sm" data-btn-add-sequences>
                <i class="bx bx-plus align-middle"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="white-space: nowrap;">Tipe</th>
                        <th style="white-space: nowrap;">Sekuens</th>
                        <th style="white-space: nowrap;">Link</th>
                        <th style="white-space: nowrap;"></th>
                    </tr>
                </thead>
                <tbody data-sequence-inputs>
                    @if (isset($data))
                        @foreach ($data->hoyaSequences as $index => $hoyaSequence)
                            <tr data-index="{{$index}}">
                                <input type="hidden"  name="hoya_sequences[{{$index}}][id]" value="{{$hoyaSequence->id}}">
                                <td class="align-middle">
                                    <select name="hoya_sequences[{{$index}}][dna_type]" class="form-select">
                                        <option value=""></option>
                                        @foreach ($dnaTypes as $type)
                                            <option value="{{$type->value}}" {{$hoyaSequence->dna_type === $type->value ? "selected" : ""}}>{{$type->value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="align-middle">
                                    <textarea class="form-control" name="hoya_sequences[{{$index}}][dna_sequence]" {{--required --}}>{{$hoyaSequence->dna_sequence}}</textarea>
                                </td>
                                <td class="align-middle">
                                    <input type="url" class="form-control" name="hoya_sequences[{{$index}}][link]" value="{{$hoyaSequence->link}}" {{--required --}}>
                                </td>
                                <td class="align-middle" style="white-space: nowrap;">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="$(`[data-spread-inputs] > [data-index='{{$index}}']`).remove()">
                                        <i class="bx bx-trash align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr data-index="0">
                            <td class="align-middle">
                                <select name="hoya_sequences[0][dna_type]" class="form-select">
                                    <option value=""></option>
                                    @foreach ($dnaTypes as $type)
                                        <option value="{{$type->value}}">{{$type->value}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="align-middle">
                                <textarea class="form-control" name="hoya_sequences[0][dna_sequence]"></textarea>
                            </td>
                            <td class="align-middle">
                                <input type="url" class="form-control" name="hoya_sequences[0][link]">
                            </td>
                            <td class="align-middle" style="white-space: nowrap;"></td>
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
<script defer>
    $(document).ready(function() {
        $("#benefit").select2({
            tags: true,
            theme: 'classic',
            tokenSeparators: [','],
            dropdownParent: $('[data-modal] .modal-content')
        })
    })
</script>