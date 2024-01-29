@extends("layouts.FE.master")
@section("title", "Identifikasi")
@section("content")
<section class="service-section alternat-2 p_relative centred pt_40 pb_150">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="search-widget sidebar-widget p_relative d_block mb_50 pt_30 pb_40 b_radius_5">
                    <div class="widget-title p_relative d_block mb_70">
                        <h3 class="fs_30 lh_40">Identifikasi</h3>
                        <p>Masukan ciri-ciri Hoya yang Anda cari dan kami akan menampilkan daftar Hoya yang sesuai dengan kriteria yang Anda berikan</p>
                    </div>
                    <div class="search-inner">
                        <form action="{{url('identifikasi')}}" method="get" class="default-form">
                            <table class="table">
                                @foreach ($morfologies as $key => $group)
                                    <tr>
                                        <th colspan="2">
                                            <h5 class="text-left font-weight-bold">{{$key}}</h5>
                                        </th>
                                    </tr>
                                    @foreach ($group as $rowIndex => $morfology)
                                        <tr>
                                            <td><p class="text-left font-weight-bold" style="color: #000">{{$morfology->name}}</p></td>
                                            <td>
                                                @foreach ($morfology->options as $optIndex => $option)
                                                    <label for="{{$morfology->slug}}-{{$optIndex}}" class="d-block text-left" style="color: #000">
                                                        <input type="radio" name="{{$morfology->slug}}" id="{{$morfology->slug}}-{{$optIndex}}" class="form-radio" value="{{$option->value}}" {{request($morfology->slug) && request($morfology->slug) === $option->value ? "checked" : ""}}>
                                                        {{$option->value}}
                                                    </label>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                            <div class="row">
                                <div class="col-lg-12 mb-4 text-left">
                                    <button class="d-inline-block theme_bg color_white centred b_radius_5 fs_16 theme-btn btn-one">
                                        <i class="fas fa-search mr-2"></i> Identifikasi
                                    </button>
                                    <a href="{{url('identifikasi')}}" class="d-inline-block centred b_radius_5 fs_16 theme-btn btn-two">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (isset($results))    
            <div class="col-lg-12 col-md-12 col-sm-12" data-search-results>
                <div class="our-shop">
                    <div class="auto-container">
                        <div class="row clearfix">
                            @forelse ($results as $result)
                                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                                    <div
                                        class="service-block-one wow fadeInUp animated"
                                        data-wow-delay="00ms"
                                        data-wow-duration="1500ms"
                                    >
                                        <div class="inner-box p_relative d_block bg_white b_radius_5 b_shadow_6 tran_5 mb_30">
                                            <div class="image-box p_relative d_block mb_45">
                                                <figure class="image p_relative d_block img_hover_1">
                                                    @if (isset($result->hoyaImages[0]))
                                                        <img src="{{url('uploads/' . $result->hoyaImages[0]->image)}}" />
                                                        @if (!empty($result->hoyaImages[0]->photographer))
                                                            <small class="text-muted"><i class="fas fa-camera"></i> {{$result->hoyaImages[0]->photographer}}</small>
                                                        @endif
                                                    @else
                                                        <img src="{{asset("FE/images/not_found.jpg")}}" />
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="lower-content p_relative d_block pl_20 pr_20 pb_40">
                                                <h3 class="p_relative d_block fs_22 fw_medium mb_17">
                                                    <a href="{{url('database/' . $result->id)}}" target="_blank" class="d_iblock">Hoya {{$result->name}}</a>
                                                </h3>
                                                <p class="mb_17 lh_26">{{$result->origin}}</p>
                                                <p class="mb_17 lh_26">Kemiripan: <span class="font-weight-bold text-primary">{{$result->similarity * 100}}%</span></p>
                                                <div class="link-box p_relative">
                                                    <a href="{{url('database/' . $result->id)}}" target="_blank" class="link-btn d_iblock"
                                                        ><i class="far fa-long-arrow-right fs_20"></i
                                                    ></a>
                                                    <a href="{{url('database/' . $result->id)}}" target="_blank" class="overlay-btn fs_16 p_absolute fw_medium d_iblock"
                                                        >Detail<i class="far fa-long-arrow-right p_absolute fs_20"></i
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h6 class="text-center">Tidak ditemukan data Hoya</h6>
                            @endforelse
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@push('css')
    <link href="{{asset('FE/css/font-awesome-all.css')}}" rel="stylesheet" />
    <link href="{{asset('FE/css/jquery-ui.css')}}" rel="stylesheet" />
    <link href="{{asset('FE/css/nice-select.css')}}" rel="stylesheet" />
    <style>
        .pagination li a {
            padding: 0 0.75rem !important;
            width: 100%;
            min-width: 50px;
        }

        .page-item.active .page-link {
            background-color: #2f7955 !important;
        }

        .search-btn {
            top: 0px;
            right: 0px;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }
    </style>
@endpush
@push('script')
    <script src="{{asset('FE/js/product-filter.js')}}"></script>
    @if (isset($results))
    <script>
        $(document).ready(function() {
            document.querySelector("[data-search-results]").scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });
        })
    </script>
    @endif
@endpush
@endsection