@foreach ($photos->all() as $photo)
<li>{{ $photo->photo_name }}</li>
@endforeach