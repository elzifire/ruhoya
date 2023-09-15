@extends("layouts.FE.master")
@section("title", $data->name)
@section("content")
<section class="page-title p_relative pt_150 pb_180 centred" style="background-image: url({{isset($hoya->hoyaImages[0]) ? url('uploads/' . $data->hoyaImages[0]->image) : asset("FE/images/not_found.jpg")}}); background-repeat: no-repeat; background-size: cover;">
    <div class="auto-container">
        <div class="content-box">
            <h1 class="d_block fs_70 lh_70 mb_20 color_white">{{$data->name}}</h1>
            <p class="d_block fs_20 lh_30 color_white">{{$data->local_name}}</p>
        </div>
    </div>
</section>
<section class="service-details pt_140 pb_140">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="service-sidebar p_relative d_block mr_20">
                    <div class="category-widget p_relative d_block pt_30 pr_40 pb_12 pl_40 b_radius_5 mb_50">
                        <h2 class="d_block fs_30 lh_40 mb_3">Morfologi</h2>
                        <ul class="category-list clearfix">
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Batang</h6>
                                <p>{{$data->stem}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Daun</h6>
                                <p>{{$data->leaves}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Bentuk Bunga</h6>
                                <p>{{$data->flowers}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Kuncup Bunga</h6>
                                <p>{{$data->flower_buds}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Ukuran Bunga</h6>
                                <p>{{$data->flower_size}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Warna Bunga</h6>
                                <p>{{$data->flower_colors}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Akar</h6>
                                <p>{{$data->roots}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Tunas</h6>
                                <p>{{$data->shoots}}</p>
                            </li>
                            <li class="p_relative d_block pt_20 pb_20 fs_16 lh_26">
                                <h6 class="p_relative d_iblock" style="font-weight: bold">Sistem Reproduksi</h6>
                                <p>{{$data->reproduction_system}}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="download-widget p_relative d_block">
                        <ul class="download-list clearfix">
                            <li class="p_relative d_block mb_10">
                                <a href="{{$data->publication_link}}" class="p_relative d_block pl_85 pt_18 pr_60 pb_18" target="_black">
                                    <i class="fal fa-file-pdf"></i>
                                    <h6 class="fs_15 lh_18 fw_medium">{{$data->publication}}</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="service-details-content p_relative d_block">
                    <div class="content-one p_relative d_block mb_90">
                        <h2 class="d_block fs_30 lh_40 fw_medium mb_25">Deskripsi</h2>
                        <p class="fs_15 lh_26 mb_25">{{$data->etymology}}</p>
                    </div>
                    <figure class="image-box p_relative d_block b_radius_5 mb_90">
                        <img src="assets/images/hoya/Campanulata.JPG" alt="" />
                    </figure>
                    <div class="content-two d_block p_relative mb_90">
                        <h2 class="d_block fs_30 lh_40 fw_medium mb_25">Manfaat</h2>
                        <ul class="list clearfix p_relative d_block mb_40">
                            <li class="p_relative d_block fs_15 lh_26 mb_8 pl_20 fw_medium">Pengobatan Tradisional</li>
                            <li class="p_relative d_block fs_15 lh_26 mb_8 pl_20 fw_medium">Bahan Pangan</li>
                        </ul>
                    </div>
                    <div class="content-two d_block p_relative mb_90">
                        <h2 class="d_block fs_30 lh_40 fw_medium mb_25">Asosiasi Serangga</h2>
                        <ul class="list clearfix p_relative d_block mb_40">
                            @foreach (\App\Models\InsectAssociation::all() as $insect)
                                <li class="p_relative d_block fs_15 lh_26 mb_8 pl_20 fw_medium">{{$insect->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="content-two d_block p_relative mb_90">
                        <h2 class="d_block fs_30 lh_40 fw_medium mb_25">Hama</h2>
                        <ul class="list clearfix p_relative d_block mb_40">
                            @foreach (\App\Models\Pest::all() as $pest)
                                <li class="p_relative d_block fs_15 lh_26 mb_8 pl_20 fw_medium">{{$pest->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('css')
    <link href="{{asset('FE/css/font-awesome-all.css')}}" rel="stylesheet" />
@endpush
@endsection