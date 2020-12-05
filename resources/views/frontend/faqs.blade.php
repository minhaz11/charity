@extends('layouts.frontend')
@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5 mt-2"  data-aos="fade">
        <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Frequently Ask Question</h2>
          </div>
        </div>


        <div class="row justify-content-center">
          <div class="col-8">
            @foreach($faqs as $faq)
            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-{{ $faq->id }}" role="button" aria-expanded="false" aria-controls="collapse-1" class="accordion-item h5 d-block mb-0 collapsed">{{ $faq->title }}</a>

              <div class="collapse" id="collapse-{{ $faq->id }}">
                <div class="pt-2">
                  <p class="mb-0">{!! $faq->content !!}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          
        </div>
        
      </div>
      </div>
    </div>
  </div>
</div>
@endsection