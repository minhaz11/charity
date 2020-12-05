@extends('layouts.frontend')
@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5 mt-5"  data-aos="fade">
        <div class="row">
          {!! $page->content !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection