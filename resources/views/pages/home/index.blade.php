@extends("layouts.BE.master", ["breadcrumb" => ["Home"]])
@section("title", "Dashboard")
@section("content")
<div class="alert alert-primary alert-solid" role="alert">
    Selamat datang! <b>{{\Auth::user()->name}}</b>
</div>
<div class="row">
    <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
        <div class="card bg-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold mb-2 text-white">{{\App\Models\Hoya::count()}}</h4>
                        <p class="text-uppercase fw-medium fs-14 text-white-50 mb-0"> Spesies Hoya</p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-light rounded-circle fs-3">
                            <i class="bx bx-leaf fs-24 text-white"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
        <div class="card bg-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold mb-2 text-white">{{\App\Models\HoyaSpread::count()}}</h4>
                        <p class="text-uppercase fw-medium fs-14 text-white-50 mb-0"> Daerah Sebaran</p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-light rounded-circle fs-3">
                            <i class="bx bxs-map fs-24 text-white"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold mb-2 text-dark">{{\App\Models\InsectAssociation::count()}}</h4>
                        <p class="text-uppercase fw-medium fs-14 text-dark-50 mb-0"> Asosiasi Serangga</p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-light rounded-circle fs-3">
                            <i class="bx bxs-bug fs-24 text-dark"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold mb-2 text-white">{{\App\Models\Pest::count()}}</h4>
                        <p class="text-uppercase fw-medium fs-14 text-white-50 mb-0"> Hama</p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-light rounded-circle fs-3">
                            <i class="bx bx-spray-can fs-24 text-white"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Daerah Sebaran</h5>
    </div>
    <div class="card-body">
        <div id="map"></div>
    </div>
</div>
@endsection

@push('css')
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
     <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
     <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
     <style>
        #map { height: 512px; }
     </style>
@endpush
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script>
        $("[data-menu-url='']").addClass("active");

        var markers = L.markerClusterGroup();
        
        var map = L.map('map').setView([-2.546, 127.768], 5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 10,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        })
        .addTo(map);

        function createPopup(title, description, image) {
            var card = document.createElement("div");
            card.classList.add("card");

            var cardImg = new Image(250);
            cardImg.src = image;
            cardImg.classList.add("card-img-top", "img-fluid");

            var cardBody = document.createElement("body")
            cardBody.classList.add("card-body", "bg-white");

            var cardTitle = document.createElement("h4");
            cardTitle.classList.add("card-title", "mb-2");
            cardTitle.innerText = title;

            var cardDescription = document.createElement("p");
            cardDescription.classList.add("card-text", "text-muted");
            cardDescription.innerText = description;

            cardBody.append(cardTitle, cardDescription);
            card.append(cardImg, cardBody);

            return card;
        }

        function loadHoyaSpread() {
            $.ajax({
                url: "{{url('/admin')}}",
                type: "GET",
                data: { mode: "load-hoya" },
                dataType: "json",
                success: function(response) {
                    response.data.forEach(function(hoya) {
                        hoya.hoya_spreads.forEach(function(point) {
                            var m = new L.marker([point.latitude, point.longitude]);
                            m.bindPopup(createPopup(hoya.name, hoya.etymology, `{{url('uploads')}}/${hoya.hoya_images[0].image}`));

                            markers.addLayer(m);
                            markers.addTo(map)
                        })
                    })
                }
            })
        }

        $(document).ready(function() {
            loadHoyaSpread();
        });
    </script>
@endpush