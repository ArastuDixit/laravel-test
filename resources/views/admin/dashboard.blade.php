@include('admin.include.header')
@include('admin.include.sidebar')

<div class="dashboard-content-one">
                    <div class="card mt-5">
                    @if(session('login-success'))
                        <div class="alert alert-success">
                            {{ session('login-success') }}
                        </div>
                    @endif

                    @if(session('login-error'))
                        <div class="alert alert-danger">
                            {{ session('login-error') }}
                        </div>
                    @endif

                    <div class="card-body p-0">
                    <div class="col-xl-12 col-sm-6 col-12 mt-3 ">
                      <div class="row">
                          <div class="col-lg-10">
                            <h4 class="mb-0">ABCCD Profile</h4>
                            <p>last open on 23 November 2023, 5:30PM</p>
                          </div>
                          <div class="col-lg-2 text-right">
                            <a href=""> <img src="{{ asset('admin/images/iconsms.png') }}" style="width:32px; margin-top:15px;"/></a>
                            <a href=""> <img src="{{ asset('admin/images/icontimes.png') }}"  style="width:32px; margin-top:15px;"/></a>
                          </div>
                      </div>
                    </div>
                   </div>
                </div>

@include('admin.include.footer')