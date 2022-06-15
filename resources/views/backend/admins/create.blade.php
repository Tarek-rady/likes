@extends('layouts.master')

 @section('title')
  Add Admin
 @endsection

 @section('style')

 @endsection


 @section('content')


 <div class="card shadow mb-4">

    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary"> Admins </h6>
        <div class="ml-auto">
            <a href="{{ route('admins.index') }}" class="btn btn-primary">
            <span><i class="fa fa-home"></i></span>
            <span> Admins </span>
        </a>
        </div>
    </div>

    <div class="card-body">

        <form action="{{ route('admins.store') }}" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" >
            @csrf

            <div class="row">
                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                           Name
                        </span>
                    </label>
                    <input type="text"  name="name" class="form-control form-control-solid" placeholder="Enter Your Name" >
                    @error('name') <span class="text-danger">{{ $message }}</span>  @enderror
                </div>

                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                           Email
                        </span>
                    </label>
                    <input type="email"  name="email" class="form-control form-control-solid" placeholder="Enter Your Email" >
                    @error('email') <span class="text-danger">{{ $message }}</span>  @enderror

                </div>

                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                           Password
                        </span>
                    </label>
                    <input type="password"  name="password" class="form-control form-control-solid" placeholder="Enter Your password" >
                    @error('password') <span class="text-danger">{{ $message }}</span>  @enderror

                </div>


            </div>









            <div class="text-center pt-15">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...</span>
                </button>
            </div>

        </form>

    </div>

</div>




 @endsection



 @section('js')

 @endsection
