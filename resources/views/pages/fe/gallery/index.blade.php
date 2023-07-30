@extends("layouts.FE.master")
@section("title", "Galeri")
@section("content")
<!-- Page Title -->
<section
    class="page-title p_relative pt_150 pb_180 centred"
    style="background-image: url({{asset('FE/images/background/page-title.jpg')}})"
>
    <div class="pattern-layer p_absolute" style="background-image: url({{asset('FE/images/shape/shape-2.png')}})"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1 class="d_block fs_70 lh_70 mb_20 color_white">Galeri</h1>
            <p class="d_block fs_20 lh_30 color_white">Pesona Hoya dalam Lensa</p>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- project-section -->
<section class="project-section p_relative pt_140 pb_130 centred">
    <div class="auto-container">
        <div class="items-container row clearfix">
            @foreach (\App\Models\Hoya::all() as $hoya)
                @foreach ($hoya->hoyaImages as $hoyaImage)
                    <div class="col-lg-4 col-md-6 col-sm-12 project-block">
                        <div class="project-block-one">
                            <div class="inner-box p_relative d_block centred mb_30">
                                <figure class="image-box p_relative d_block b_radius_5">
                                    <img src="{{url('uploads/' . $hoyaImage->image)}}" alt="" />
                                </figure>
                                <div class="content-box p_absolute d_flex tran_5">
                                    <div class="inner p_relative">
                                        <div class="icon-box p_relative d_iblock fs_35 mb_20 b_radius_10 bg_white tran_5">
                                            <i class="fas fa-spa"></i>
                                        </div>
                                        <h3 class="fs_22 color_white fw_medium mb_11 d_block tran_5">
                                            <a href="#" class="d_iblock color_white">{{$hoya->name}}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- project-section end -->
@endsection