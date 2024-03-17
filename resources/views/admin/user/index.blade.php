@include('admin.include.header')
@include('admin.include.sidebar')

<style>
.breadcrumb-item a {
    float: right;
}
.dataTables_filter {
    float: right;
    margin-top:-25px;
}

/* Define background colors for even and odd rows */
#userTable tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Light gray */
}

#userTable tbody tr:nth-child(odd) {
    background-color: #d3e6f3; /* White */
}


</style>


<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>User List <span style="float:right" class="breadcrumb-item"><a href="{{ route('admin.user.createuser') }}" class="btn btn-primary">Add User</a></span>  </h3>

                </div>

                <!-- Breadcubs Area End Here -->
                <!-- Student Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>List Name of User</h3>
                            </div>

                        </div>
                        <?php if (session()->has('success')): ?>
                        <div class="alert alert-success">
                            <?= session('success') ?>
                        </div>
                    <?php elseif (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <?php if (is_array(session('errors'))): ?>
                                <ul>
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <?= session('errors') ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                        <div class="table-responsive">
                            <table id="userTable" class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>

                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // echo '<pre>';
                                    // print_r($guardian);
                                    // echo '</pre>';

                                    $i = 1;

                                    foreach ($users as $user)  {

                                                    ?>
                    <tr>
                        <th scope="row"><?php echo $user->id; ?></th>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>

                        <td>
                            @if (!empty($user['image']))
                                <img style="width: 32px; background: #ddd;padding: 2px;border-radius: 100%;" src="{{ asset('uploads/user/' . $user['image']) }}" alt="User Image">
                            @else
                                <img style="width: 32px; background: #ddd;padding: 2px;border-radius: 100%;" src="{{ asset('admin/images/admin.jpg') }}" alt="Default Image">
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.user.viewuser', ['id' => $user->id]) }}" class="text-warning" style="margin-right:12px; font-size:20px;"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.user.edituser', ['id' => $user->id]) }}" class="text-primary" style="margin-right:12px; font-size:20px;"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn-sm btn-danger delete-user" data-user-id="<?= $user['id']; ?>" style="margin-right:12px; font-size:20px;"><i class="fa fa-trash"></i></a>


                        </td>

                    </tr>

                <?php
                $i++;
                } ?>
            </tbody>

                            </table>
                        </div>
                    </div>

                    {{-- <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($users->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                @if ($i == $users->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor

                            @if ($users->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </nav> --}}
                </div>


                @include('admin.include.footer')

<!-- Include jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTable on the userTable -->
<script>
    $(document).ready(function () {
        $('#userTable').DataTable();
    });
</script>

<script>
    // Use SweetAlert for category deletion confirmation
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-user').forEach(function (deleteButton) {
            deleteButton.addEventListener('click', function (event) {
                event.preventDefault();

                // Get the category ID from the data attribute
                var userId = this.getAttribute('data-user-id');

                // Show the confirmation popup
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete URL
                        window.location.href = '{{ url('admin/user') }}/' + userId;
                    }
                });
            });
        });
    });
</script>

<!-- Add this in your HTML file to include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                  <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css">
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
                  <script>
                     $(document).ready(function() {

                        $('#myTable').DataTable({

                           "order": [
                              [0, "desc"]
                           ] // order the first column by descending order

                        });

                     });
                  </script>
