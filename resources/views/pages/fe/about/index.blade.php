@extends("layouts.FE.master")
@section("title", "Tentang")
@section("content")
<section class="page-title p_relative pt_150 pb_180 centred" style="background-image: url({{asset('FE/images/background/page-title.jpg')}})">
    <div class="pattern-layer p_absolute" style="background-image: url({{url('FE/images/shape/shape-2.png')}})"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1 class="d_block fs_70 lh_70 mb_20 color_white">Tentang</h1>
            <p class="d_block fs_20 lh_30 color_white">Perjalanan Pengetahuan Hoya</p>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- about-style-two -->
<section class="about-style-two p_relative pt_100 pb_140">
    <div class="pattern-layer p_absolute" style="background-image: url({{asset('FE/images/shape/shape-33.png')}})"></div>
    <div class="auto-container">
        <div class="row align-items-center clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_1">
                    <div class="image-box p_relative d_block pr_90 pb_40">
                        <div class="shape-1 theme_bg p_absolute b_radius_50"></div>
                        <div class="shape-2 p_absolute" style="background-image: url({{asset('FE/images/shape/shape-19.png')}})"></div>
                        <figure class="image p_relative d_block clearfix">
                            <img src="{{asset('FE/images/resource/about-1.png')}}" alt="" />
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_1">
                    <div class="content-box p_relative d_block ml_30">
                        <div class="sec-title mb_35">
                            <span class="sub-title">Tentang</span>
                            <h2>Mempersembahkan Kecantikan Hoya</h2>
                        </div>
                        <div class="text p_relative d_block mb_40">
                            <p>
                                Hoya merupakan salah satu kelompok tumbuhan epifi t dari suku Apocynaceae anak suku
                                Asclepiadoideae. Kebanyakan jenisnya merupakan tumbuhan merambat. Persebaran alami dari
                                jenis-jenis Hoya terdapat di daerah Asia dan sebagian Australia tropis, dengan keanekaragaman
                                tertinggi di Indonesia
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <section class="team-section p_relative sec-pad">
                    <div class="auto-container">
                        <div class="sec-title centred mb_45">
                            {{-- <span class="sub-title">Kontributor</span> --}}
                            <h2>Kontributor</h2>
                        </div>
                        <div class="row clearfix">
                            @foreach (\App\Models\Collaborator::orderBy("sequence", "ASC")->get() as $team)
                                <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                                    <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box p_relative d_block pl_30 pt_30 pr_30 pb_25 b_shadow_7 b_radius_5">
                                            <figure class="image-box p_relative d_block b_radius_5">
                                                <a href="{{url('tim-ahli')}}"><img src="{{url('uploads/' . $team->image)}}" alt="" /></a>
                                            </figure>
                                            <div class="lower-content p_relative d_block pt_30">
                                                <h3 class="p_relative d_block fs_22 fw_bold mb_5">
                                                    <a href="{{url('tim-ahli')}}" class="d_iblock hov_color">{{$team->name}}</a>
                                                </h3>
                                                <span class="designation p_relative d_block fs_15 fw_medium">{{$team->institute}}</span>
                                                <span class="designation p_relative d_block fs_15">{{$team->contribution}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection