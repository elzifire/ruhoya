@extends("layouts.FE.master")
@section("title", "Home")
@section("content")
<!-- banner-section -->
    <section class="banner-section centred p_relative">
        <div class="pattern-layer" style="background-image: url({{asset('FE/images/shape/shape-2.png')}})"></div>
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @foreach (\App\Models\Slider::all() as $slider)
                <div class="slide-item p_relative pt_130 pb_190">
                    <div class="image-layer p_absolute" style="background-image: url({{url('uploads/' . $slider->image)}})"></div>
                    <div class="auto-container">
                        <div class="content-box p_relative d_block z_5">
                            <h1 class="color_white d_block fs_90 lh_90 mb_25">{{$slider->title}}</h1>
                            <p class="color_white fs_20 lh_32 mb_45">{{$slider->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- banner-section end -->

    <!-- about-section -->
    <section class="about-section p_relative pt_130 pb_100">
        <div class="auto-container">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1">
                        <div class="content-box p_relative d_block mr_70">
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
                            <div class="btn-box p_relative d_block">
                                <a href="{{url('tentang')}}" class="theme-btn btn-one">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                    <div class="inner-content centred p_relative">
                        <div class="pattern-layer">
                            <div class="pattern-1 p_absolute"></div>
                            <div
                                class="pattern-2 p_absolute wow slideInRight animated"
                                data-wow-delay="00ms"
                                data-wow-duration="1500ms"
                                style="background-image: url({{asset('FE/images/shape/shape-3.png')}})"
                            ></div>
                            <div
                                class="pattern-3 p_absolute wow slideInLeft animated"
                                data-wow-delay="00ms"
                                data-wow-duration="1500ms"
                                style="background-image: url({{asset('FE/images/shape/shape-4.png')}})"
                            ></div>
                        </div>
                        <div class="row align-items-center clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                <div
                                    class="feature-block-one wow fadeInUp animated"
                                    data-wow-delay="00ms"
                                    data-wow-duration="1500ms"
                                >
                                    <div
                                        class="inner-box p_relative d_block bg_white b_radius_5 b_shadow_6 pt_70 pb_60 tran_5 mb_30 pl_15 pr_15"
                                    >
                                        <div class="icon-box p_relative d_iblock b_radius_10 fs_35 mb_30 z_1 tran_5">
                                            <i class="fas fa-spa"></i>
                                        </div>
                                        <h3 class="fs_22 lh_30 fw_medium">Efek Relaksasi</h3>
                                    </div>
                                </div>
                                <div
                                    class="feature-block-one wow fadeInUp animated"
                                    data-wow-delay="200ms"
                                    data-wow-duration="1500ms"
                                >
                                    <div
                                        class="inner-box p_relative d_block bg_white b_radius_5 b_shadow_6 pt_70 pb_60 tran_5 mb_30 pl_15 pr_15"
                                    >
                                        <div class="icon-box p_relative d_iblock b_radius_10 fs_35 mb_30 z_1 tran_5">
                                            <i class="fas fa-capsules"></i>
                                        </div>
                                        <h3 class="fs_22 lh_30 fw_medium">Bahan Obat</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                <div
                                    class="feature-block-one wow fadeInUp animated"
                                    data-wow-delay="400ms"
                                    data-wow-duration="1500ms"
                                >
                                    <div
                                        class="inner-box p_relative d_block bg_white b_radius_5 b_shadow_6 pt_70 pb_60 tran_5 mb_30 pl_15 pr_15"
                                    >
                                        <div class="icon-box p_relative d_iblock b_radius_10 fs_35 mb_30 z_1 tran_5">
                                            <i class="fas fa-umbrella-beach"></i>
                                        </div>
                                        <h3 class="fs_22 lh_30 fw_medium">Penghilang Stres</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- cta-section -->
    <section class="cta-section p_relative pt_140 pb_140" style="background-image: url({{asset('FE/images/hoya/Ocultata.JPG')}})">
        <div class="auto-container">
            <div class="inner-box p_relative d_block clearfix">
                <div class="sec-title light pull-left">
                    <span class="sub-title">Identifikasi Hoya</span>
                    <h2>
                        Menguak Keunikan <br />
                        dan Ciri Khas Setiap Spesiesnya
                    </h2>
                </div>
                <div class="btn-box pull-right mt_50">
                    <a href="{{url('identifikasi')}}" class="theme-btn btn-one">Identifikasi<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->

    <!-- project-section -->
    <section class="project-section p_relative pt_140 pb_130">
        <div class="auto-container">
            <div class="">
                <div class="upper-box mb_45 clearfix">
                    <div class="sec-title pull-left">
                        <span class="sub-title">Galeri</span>
                        <h2>Pesona Hoya dalam Lensa</h2>
                    </div>
                </div>
                <div class="items-container row clearfix">
                    @foreach (\App\Models\Hoya::all() as $hoya)    
                    @foreach ($hoya->hoyaImages as $hoyaImage)
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all product urban maintanance">
                            <div class="project-block-one">
                                <div class="inner-box p_relative d_block centred mb_30">
                                    <figure class="image-box p_relative d_block b_radius_5">
                                        <img src="{{url('uploads/' . $hoyaImage->image)}}" alt="" />
                                    </figure>
                                    <div class="content-box p_absolute d_flex tran_5">
                                        <div class="inner p_relative">
                                            <div class="icon-box p_relative d_iblock fs_35 mb_20 b_radius_10 bg_white tran_5">
                                                <i class="fas fa-seedling"></i>
                                            </div>
                                            <h3 class="fs_22 color_white fw_medium mb_11 d_block tran_5">
                                                <a href="project-details.html" class="d_iblock color_white">{{$hoya->name}}</a>
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
        </div>
    </section>
    <!-- project-section end -->

    <!-- funfact-section -->
    <section
        class="funfact-section p_relative pt_140 pb_140"
        style="background-image: url({{asset('FE/images/background/funfact-bg.jpg')}})"
    >
        <div class="auto-container">
            <div class="sec-title light centred mb_65">
                <span class="sub-title">Fun Facts</span>
                <h2>Eksplorasi Fakta Unik <br />Bunga Hoya</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pl_95">
                            <div class="icon-box p_absolute d_iblock fs_40 bg_white b_radius_50 theme_color">
                                <i class="icon-13"></i>
                            </div>
                            <div class="count-outer count-box p_relative d_block fs_70 lh_70 color_white">
                                <span class="count-text" data-speed="1500" data-stop="500">0</span>
                            </div>
                            <h6 class="p_relative d_block fs_16 lh_20 fw_medium color_white">Spesies</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pl_95">
                            <div class="icon-box p_absolute d_iblock fs_40 bg_white b_radius_50 theme_color">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="count-outer count-box p_relative d_block fs_70 lh_70 color_white">
                                <span class="count-text" data-speed="1500" data-stop="10">0</span>
                            </div>
                            <h6 class="p_relative d_block fs_16 lh_20 fw_medium color_white">Negara Persebaran</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pl_95">
                            <div class="icon-box p_absolute d_iblock fs_40 bg_white b_radius_50 theme_color">
                                <i class="fas fa-spa"></i>
                            </div>
                            <div class="count-outer count-box p_relative d_block fs_70 lh_70 color_white">
                                <span class="count-text" data-speed="1500" data-stop="5">0</span>
                            </div>
                            <h6 class="p_relative d_block fs_16 lh_20 fw_medium color_white">Kelopak Bunga</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pl_95">
                            <div class="icon-box p_absolute d_iblock fs_40 bg_white b_radius_50 theme_color">
                                <i class="fas fa-apple-alt"></i>
                            </div>
                            <div class="count-outer count-box p_relative d_block fs_70 lh_70 color_white">
                                <span class="count-text" data-speed="1500" data-stop="40">0</span>
                            </div>
                            <h6 class="p_relative d_block fs_16 lh_20 fw_medium color_white">Buah Dalam 1 Tangkai</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- funfact-section end -->

    <!-- team-section -->
    <section class="team-section p_relative sec-pad">
        <div class="auto-container">
            <div class="sec-title centred mb_45">
                <span class="sub-title">Ahli</span>
                <h2>Para Peneliti Ahli <br />Bunga Hoya</h2>
            </div>
            <div class="row clearfix">
                @foreach (\App\Models\Team::all() as $team)
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box p_relative d_block pl_30 pt_30 pr_30 pb_25 b_shadow_7 b_radius_5">
                                <figure class="image-box p_relative d_block b_radius_5">
                                    <a href="{{url('tim-ahli')}}"><img src="{{url('uploads/' . $team->image)}}" alt="" /></a>
                                </figure>
                                <div class="lower-content p_relative d_block pt_30">
                                    <h3 class="p_relative d_block fs_22 fw_medium mb_5">
                                        <a href="{{url('tim-ahli')}}" class="d_iblock hov_color">{{$team->name}}</a>
                                    </h3>
                                    <span class="designation p_relative d_block fs_15">{{$team->title}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- team-section end -->

    @push("script")
        <script>
			$(document).ready(function () {
				$(".owl-carousel").owlCarousel({
					nav: false,
					dots: false,
					loop: true,
					margin: 50,
					autoplay: true,
					smartSpeed: 2500,
					autoWidth: true,
					responsive: {
						0: {
							items: 1,
						},
						600: {
							items: 3,
						},
					},
				});
			});
		</script>
    @endpush
@endsection