@extends('layouts.user.contentLayoutMaster')
@section('title','Enquire')
@section('content')
<div class="my-trip pt-lg-5 pt-4">
  <div class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="section-content">
            <ul class="nav nav-tabs tabbable tab-light" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="city2-tab" data-toggle="tab" href="#city2" role="tab"
                  aria-controls="city2" aria-selected="true">Enquire tour</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="city2" role="tabpanel" aria-labelledby="city2-tab">

                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="icon-heading">
                        <h3 class="mb-0">Want to personalize it?</h3>
                        <p class="mb-2">
                          We can customize the entire trip basd on your
                          budget.
                        </p>
                      </div>
                    </div>
                  </div>
                  <form action="{{route('user.enquire.store')}}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" value="{{ old('range_1') }}" name="range_1"
                            class="{{$errors->has('range_1') ? "form-control is-invalid" : "form-control"}}"
                            aria-describedby="" placeholder="Less than $1500" />
                          @error('range_1')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" value="{{ old('range_2') }}" name="range_2"
                            class="{{$errors->has('range_2') ? "form-control is-invalid" : "form-control"}}"
                            placeholder="$1500 - $3000" />
                          @error('range_2')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" name="range_3" value="{{ old('range_3') }}"
                            class="{{$errors->has('range_3') ? "form-control is-invalid" : "form-control"}}"
                            aria-describedby="" placeholder="$3000 - $5000" />
                          @error('range_3')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" name="range_4" value="{{ old('range_4') }}"
                            class="{{$errors->has('range_4') ? "form-control is-invalid" : "form-control"}}" id="Phone"
                            placeholder="More than $5000" />
                          @error('range_4')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="icon-heading">
                          <h3 class="mb-0">* Number of passengers</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <select name="adult" value="{{ old('adult') }}"
                            class="{{$errors->has('adult') ? "form-control is-invalid" : "form-control"}}">
                            <option selected disabled>Select Audlt</option>
                            @foreach ($adultArr as $key=>$label)
                            <option value="{{$key}}">{{$label}}</option>
                            @endforeach
                          </select>
                          @error('child')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <select name="child" value="{{ old('child') }}"
                            class="{{$errors->has('child') ? "form-control is-invalid" : "form-control"}}">
                            <option selected disabled>Select Kid</option>
                            <@foreach ($childArr as $key=>$label)
                              <option value="{{$key}}">{{$label}}</option>
                              @endforeach
                          </select>
                          @error('child')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="icon-heading">
                          <h3 class="mb-0">More details about your trip</h3>
                          <p class="mb-2">
                            Are you in a honeymoon? Do you have special
                            interests?
                          </p>
                        </div>
                        <div class="form-group">
                          <textarea name="description" value="{{ old('description') }}"
                            class="{{$errors->has('description') ? "form-control is-invalid" : "form-control"}}"
                            rows="10"></textarea>
                          @error('description')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="icon-heading">
                          <h3 class="mb-0">*Personal information</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" value="{{ old('first_name') }}" name="first_name"
                            class="{{$errors->has('first_name') ? "form-control is-invalid" : "form-control"}}"
                            aria-describedby="" placeholder="First Name" />
                          @error('first_name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="email" value="{{ old('email') }}" name="email"
                            class="{{$errors->has('email') ? "form-control is-invalid" : "form-control"}}"
                            placeholder="Email" />
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="icon-heading">
                          <h3 class="mb-0">Do you want us to call you?</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" value="{{ old('phone_no') }}" name="phone_no"
                            class="{{$errors->has('phone_no') ? "form-control is-invalid" : "form-control"}}"
                            aria-describedby="" placeholder="Phone Number" />
                          @error('phone_no')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <button class="btn-primary btn mr-2" href="#">
                          Inquire Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="drag-content mt-0 p-3 bg-white">
            <h5 class="">Place Name</h5>
            <div class="header-price">
              <p class="lead-text"><span>50$</span> per person</p>
              <p class="head-date">20 May 21 - 22 May 2021</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
