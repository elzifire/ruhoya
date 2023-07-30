@extends("layouts.FE.master")
@section("title", "Tim Ahli")
@section("content")
<section class="page-title p_relative pt_150 pb_180 centred" style="background-image: url({{asset('FE/images/background/page-title.jpg')}})">
    <div class="pattern-layer p_absolute" style="background-image: url({{url('FE/images/shape/shape-2.png')}})"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1 class="d_block fs_70 lh_70 mb_20 color_white">Tim Ahli</h1>
            <p class="d_block fs_20 lh_30 color_white">Tim Profesional Hoya</p>
        </div>
    </div>
</section>
<section class="team-section p_relative pt_140 pb_150">
    <div class="auto-container">
        <div class="row clearfix">
            @foreach (\App\Models\Team::all() as $team)    
                <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                    <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box mb_30 p_relative d_block pl_30 pt_30 pr_30 pb_25 b_shadow_7 b_radius_5">
                            <figure class="image-box p_relative d_block b_radius_5">
                                <a href="team-details.html"><img src="{{url('uploads/' . $team->image)}}" alt="" /></a>
                            </figure>
                            <div class="lower-content p_relative d_block pt_30">
                                <h3 class="p_relative d_block fs_22 fw_medium mb_5">
                                    <a href="team-details.html" class="d_iblock hov_color">{{$team->name}}</a>
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
@endsection