@extends("layouts.FE.master")
@section("title", "Database Hoya")
@section("content")
<section class="service-section alternat-2 p_relative centred pt_40 pb_150">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="search-widget sidebar-widget p_relative d_block mb_50 pt_30 pb_40 b_radius_5">
                    <div class="widget-title p_relative d_block mb_20">
                        <h3 class="fs_30 lh_40">Database Hoya</h3>
                    </div>
                    <div class="search-inner">
                        <form action="" method="get" class="default-form">
                            <div class="form-group p_relative mr-0">
                                <input type="search" name="search" placeholder="Nama" value="{{request('search')}}" />
                                <button class="p_absolute theme_bg color_white centred b_radius_5 fs_16 search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="our-shop">
                    <div class="container-fluid">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th colspan="2" class="theme_bg color_white">Hasil Pencarian</th>
                                </tr>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Spesies</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $hoya)
                                    <tr>
                                        <td class="px-2" style="max-width: 40px">
                                            @if (isset($hoya->hoyaImages[0]))
                                                <img src="{{url('uploads/' . $hoya->hoyaImages[0]->image)}}" class="img-fluid" />
                                            @else
                                                <img src="{{asset("FE/images/not_found.jpg")}}" class="img-fluid" />
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('database/' . $hoya->id)}}">{{$hoya->name}}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Tidak ditemukan data Hoya</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('css')
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
@endsection