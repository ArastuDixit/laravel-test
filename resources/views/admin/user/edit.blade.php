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
                    <h3>Update User <span class="breadcrumb-item" style="float:right"><a href="{{ route('admin.user') }}" class="btn btn-primary">Back</a></span></h3>

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
                        <h5 class="card-title">Update User</h5>

                        <!-- Form for adding a new user -->
                        <form method="POST" action="{{ route('admin.user.updateuser', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <!-- Add your form fields for new user data -->
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">User Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>

                            <div class="col-lg-6 col-lg-6 mb-3">
                                <label for="email" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                            </div>



<?php
/*

                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <div class="form-group">
                                    <label class="primary_label2">Gender<span class="text-danger">*</span></label>
                                    <select class="form-control" name="gender">

                                        <option value="1" {{ $guardian->gender == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ $guardian->gender == 2 ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>

*/
?>


                            <!-- End of additional fields -->

                            <div class="col-lg-6 mb-3">
                                <label for="image" class="form-label">Profile Image:</label>
                                <input type="file" class="form-control" id="image" name="image" style="height:50%;">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Existing Image:</label>
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



                            <div class="col-lg-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update User</button>
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
