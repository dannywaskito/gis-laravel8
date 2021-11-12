@extends('layouts.frontend')
@section('content')



<div id="map" style="width: 100%; height: 400px;"></div>




<script>
	var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

	var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/satellite-v9'
	});


	var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

	var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/dark-v10'
	});

	@foreach($kecamatan as $data)
	var data{{$data->id_kecamatan}} = L.layerGroup();
	@endforeach
	
	var map = L.map('map', {
		center: [-6.196089733168616, 106.7723254288071],
		zoom: 9,
		layers: [peta2, 
		@foreach($kecamatan as $data)
		data{{$data->id_kecamatan}},
		@endforeach
]
	});
	var baseMaps = {
		"Grayscale": peta1,
		"Satellite": peta2,
		"Streets": peta3,
		"Dark": peta4,
	};
	var overlayer = {
		@foreach($kecamatan as $data)
		"{{$data->kecamatan}}" : data{{$data->id_kecamatan}},
		@endforeach
	}
	L.control.layers(baseMaps, overlayer).addTo(map);

	@foreach($kecamatan as $data)
	L.geoJson(<?=$data->geojson ?>,{
		style:{
			color:'white',
			fillColor: '{{$data->warna}}',
			fillOpacity:1.0,
		}
	}).addTo(data{{$data->id_kecamatan}}).bindPopup("{{$data->kecamatan}}");
	@endforeach

@foreach($kegiatan as $data)
L.marker([<?=$data->posisi ?>])
.addTo(map).bindPopup(
		'<table><tr><th>Nama Kegiatan<td>{{$data->nama_kegiatan}}</tr></td><tr><th>Waktu Kegiatan<td>{{date('d F Y', strtotime($data->waktu))}}</tr></td><tr><th>Tanggal Posting Kegiatan<td>{{date('d F Y', strtotime($data->created_at))}}</tr></td></th></table><a href="/detailkegiatan/{{$data->id_kegiatan}}" class="btn btn-sm btn-default">Info Detail</a>');
@endforeach
</script>
@endsection