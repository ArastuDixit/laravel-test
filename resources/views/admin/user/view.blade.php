@include('admin.include.header')
@include('admin.include.sidebar')
<style>
    .breadcrumb-item {
    margin-left: auto;
}

.breadcrumb-item a {
    float: right;
}
</style>

 <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>User Profile<span class="breadcrumb-item" style="float:right"><a href="{{ route('admin.user') }}" class="btn btn-primary">Back</a></span></h3>

    </div>
    <!--</div>-->
    @if ($errors->any())
                   <div class="alert alert-danger" role="alert">
                      <ul>
                         @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                         @endforeach
                      </ul>
                   </div>
                @endif

                @if (session('success'))
                   <div class="alert alert-success" role="alert">
                      {{ session('success') }}
                   </div>
                @endif

                @if(session('error'))
                   <div class="alert alert-danger" role="alert">
                      {{ session('error') }}
                   </div>
                @endif
    <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Profile</h5>

                        <!-- Form for adding a new user -->
                        <form>

                            <div class="row">
                            <!-- Add your form fields for new user data -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">User Name:</label>
                                {{ $user->name }}
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">User Email:</label>
                                {{ $user->email }}
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">User Password:</label>
                                {{ $user->password }}
                            </div>
                            <!-- End of additional fields -->


                            <div class="col-lg-6 mb-3">
                                <label>User Image:</label>
                                @if (!empty($user->image))
                                    <div>
                                        <img src="{{ asset('uploads/user/' . $user->image) }}" alt="Profile Image" style="max-width: 30%; height: auto;">
                                    </div>
                                @else
                                    <div>
                                        <img src="{{ asset('admin/images/admin.jpg') }}" alt="Default Image" style="max-width: 100%; height: auto;">
                                    </div>
                                @endif
                            </div>





                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--</main>-->
<!-- End #main -->
@include('admin.include.footer')
