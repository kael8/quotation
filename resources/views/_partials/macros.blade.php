@php
$color = $color ?? '#0066ff';
@endphp
<span style="color:{{ $color }};">
  <img height="{{ $height }}" src="{{ asset('storage/image/logo.png') }}" alt="Image">

</span>
