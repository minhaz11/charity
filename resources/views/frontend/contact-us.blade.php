@extends('layouts.frontend')
@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-7 mb-5"  data-aos="fade">

        <form action="save-contact-message" method="post" class="p-5 bg-white mt-5" style="margin-top: -150px;">
          {{ csrf_field() }}
          
          @if(Session::has('message'))
            <h5 class="text-success">{{ Session::get('message') }}</h5>
          @endif
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="row form-group">
            
            <div class="col-md-12">
              <label class="text-black" for="email">Name</label> 
              <input type="name" name="name" class="form-control" value="{{ old('name') }}">
            </div>
          </div>

          <div class="row form-group">
            
            <div class="col-md-12">
              <label class="text-black" for="email">Email</label> 
              <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
          </div>

          <div class="row form-group">
            
            <div class="col-md-12">
              <label class="text-black" for="subject">Subject</label> 
              <input type="subject" name="subject" class="form-control" value="{{ old('subject') }}">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="message">Message</label> 
              <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..." value="{{ old('message') }}"></textarea>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
            </div>
          </div>


        </form>
      </div>
      <div class="col-md-5  mt-5"  data-aos="fade" data-aos-delay="100">
        
        <div class="p-4 mb-3 bg-white">

          @if(isset($company_address_1))
          <p class="mb-0 font-weight-bold">Address</p>
          <p class="mb-4">{{ $company_address_1 }} {{ isset($company_address_2) ? ', ' . $company_address_2 : '' }}</p>
          @endif

          @if(isset($company_phone))
          <p class="mb-0 font-weight-bold">Phone</p>
          <p class="mb-4"><a href="#">{{ $company_phone }}</a></p>
          @endif

          @if(isset($company_email))
          <p class="mb-0 font-weight-bold">Email Address</p>
          <p class="mb-0"><a href="#">{{ $company_email }}</a></p>
          @endif

        </div>
        
        @if(isset($company_description))
        <div class="p-4 mb-3 bg-white">
          <h3 class="h5 text-black mb-3">Company Info</h3>
          <p>{{ $company_description }}</p>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>
@endsection