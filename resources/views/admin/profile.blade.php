
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
         <h3>View User</h3>
         <p class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a></p>
         <h5 class="card-title">User Information</h5>
         <br>
         <form>
            <!-- Add your form fields for user data editing -->
            <input type="hidden" class="form-control" name="id" value="1">
            <div class="row">
               <div class="col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Name:</label>
                     {{ $user->name }}
                  </div>

                  <div class="mb-3">
                     <label class="form-label">Email:</label>
                     {{ $user->email }}
                  </div>

         </form>

         @include('admin.include.footer')

