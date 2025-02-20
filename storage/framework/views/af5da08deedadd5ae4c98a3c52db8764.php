<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <!-- Roles -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Roles</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bx bx-edit-alt me-1"></i> Create Role
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="Role-Submit">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="name">Role Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="name" name="name" value="<?php echo e(old('name')); ?>"
                                                            type="text" required class="form-control"
                                                            placeholder="Role Name">
                                                        <span class="text-danger" id="roleNameError"></span>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>SL</th>
                                                                    <th>Permission Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="Permission-Table-Model">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="Role-Submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Role Edit Modal -->
                            <div class="modal fade" id="RoleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="Role-Edit">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eit Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="Rolename">Role Name</label>
                                                        <input id="Rolename" name="Rolename"
                                                            value="<?php echo e(old('Rolename')); ?>" type="text" required
                                                            class="form-control" placeholder="Role Name">
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>SL</th>
                                                                    <th>Permission Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="Permission-Edit-Data">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="Role-Edit" class="btn btn-primary">Update
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">

                <table id="datatable2" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Role-Table">

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Roles -->
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Permissions</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#Permission">
                                <i class="bx bx-edit-alt me-1"></i> Create Permission
                            </button>

                            <!-- Parmission Modal -->
                            <div class="modal fade" id="Permission" tabindex="-1" aria-labelledby="PermissionLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="Permission-Submit">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="PermissionLabel">Create Permission</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="name">Permission Name <span
                                                                class="text-danger">*</span> </label>
                                                        <input id="Permissionname" name="Permissionname" type="text"
                                                            required class="form-control" placeholder="Permission Name">
                                                        <span class="text-danger" id="permissionNameError"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="Permission-Submit"
                                                    class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Parmission Modal -->
                            <div class="modal fade" id="Edit-Permission" tabindex="-1" aria-labelledby="PermissionLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="Edit-Permission-Submit">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Edit-PermissionLabel">Edit Permission
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="name">Permission Name</label>
                                                        <input id="EditPermissionname" name="EditPermissionname"
                                                            type="text" required class="form-control"
                                                            placeholder="Permission Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="Edit-Permission-Submit"
                                                    class="btn btn-primary">Update changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Permission Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Permission-Table">


                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Users</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#User">
                                <i class="bx bx-edit-alt me-1"></i> Create User
                            </button>

                            <!--User Modal -->
                            <div class="modal fade" id="User" tabindex="-1" aria-labelledby="UserLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="User-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UserLabel">Create User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="Username">Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="Username" name="Username" type="text"
                                                            class="form-control" placeholder="Enter Your Name">
                                                        <span class="text-danger" id="userNameError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Email Address <span
                                                                class="text-danger">*</span> </label>
                                                        <input id="email" name="email" type="text" class="form-control"
                                                            placeholder="Enter Your Email Address">
                                                        <span class="text-danger" id="userEmailError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="password">Password <span
                                                                class="text-danger">*</span> </label>
                                                        <input id="password" name="password" type="password"
                                                            class="form-control" placeholder="Enter Your Password">
                                                        <span class="text-danger" id="userPasswordError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="re-password">Confirm Password <span
                                                                class="text-danger">*</span> </label>
                                                        <input id="re-password" name="re-password" type="password"
                                                            class="form-control" placeholder="Re-Type Password">
                                                        <span class="text-danger" id="userRePasswordError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Role <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="Role-DropDown" name="Role-DropDown"
                                                            class="form-control">
                                                        </select>
                                                        <span class="text-danger" id="userRoleError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Designation <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="Designation"
                                                            id="Designation-DropDown"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Department <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="Department"
                                                            id="Department-DropDown"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Authorized Person <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="auth"
                                                            id="auth-DropDown"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="photo">Photo</label>
                                                        <input id="photo" name="photo" type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="photo">Upload Signature <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input id="signature" name="signature" type="file" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="User-Submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit User Modal -->
                            <div class="modal fade" id="Edit-User" tabindex="-1" aria-labelledby="UserLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="Edit-User-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UserLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="Username">Name</label>
                                                        <input id="EditUsername" name="EditUsername" type="text"
                                                            required class="form-control" placeholder="Enter Your Name">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Email Address</label>
                                                        <input id="Editemail" name="Editemail" type="text" required
                                                            class="form-control" placeholder="Enter Your Email Address">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Role</label>
                                                        <select id="EditRole-DropDown" name="EditRole-DropDown" required
                                                            class="form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Designation <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="Designation"
                                                            id="Editdesignation"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Department <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="Department"
                                                            id="Editdepartment-DropDown"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="email">Authorized Person <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="auth"
                                                            id="editAuth-DropDown"></select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="photo">Photo</label>
                                                        <input id="Editphoto" name="Editphoto" type="file"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12" id="EditUserImage">

                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="photo">Upload Signature <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input id="Editsignature" name="Editsignature" type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12" id="EditUserSignature">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="Edit-User-Submit"
                                                    class="btn btn-primary">Update
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable1" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="User-Table">
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js"
    integrity="sha512-ZHzbWDQKpcZxIT9l5KhcnwQTidZFzwK/c7gpUUsFvGjEsxPusdUCyFxjjpc7e/Wj7vLhfMujNx7COwOmzbn+2w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script>
//// Fetch ALl Data////
$(document).ready(function() {
    // Fetch data using AJAX
    $.ajax({
        url: "<?php echo e(route('roles.index')); ?>",
        type: 'GET',
        dataType: 'json',
        success: function(data) {

            // Populate the table with fetched data
            populateTable(data);
        },
        error: function(error) {

            console.error('Error fetching data:', error);
        }
    });
});

function populateTable(data) {
    // Get the table body
    var roleTableBody = $('#Role-Table');
    var permissionTableBody = $('#Permission-Table');
    var permissionTableModelBody = $('#Permission-Table-Model');
    var userTableBody = $('#User-Table');
    var roleDropDown = $('#Role-DropDown');
    var editRoleDropDown = $('#EditRole-DropDown');
    var designations = $('#Designation-DropDown');
    var editDesignations = $('#Editdesignation');
    var authDropDown = $('#auth-DropDown');
    var editAuthDropDown = $('#editAuth-DropDown');
    var departmentDropDown = $('#Department-DropDown');
    var editDepartmentDropDown = $('#Editdepartment-DropDown');


    // Clear existing table rows
    roleTableBody.empty();
    permissionTableBody.empty();
    permissionTableModelBody.empty();
    userTableBody.empty();
    roleDropDown.empty();
    editRoleDropDown.empty();
    designations.empty();
    editDesignations.empty();
    authDropDown.empty();
    editAuthDropDown.empty();
    departmentDropDown.empty();
    editDepartmentDropDown.empty();

    var roleDropDownHtml = '<option value="" disabled selected>Select a Role</option>';
    roleDropDown.append(roleDropDownHtml);

    var editRoleDropDownHtml = '<option value="" disabled selected>Select a Role</option>';
    editRoleDropDown.append(editRoleDropDownHtml);

    var designationsHTML = '<option value="" disabled selected>Select a Designation</option>';
    designations.append(designationsHTML);

    var editDesignationsHTML = '<option value="" disabled selected>Select a Designation</option>';
    editDesignations.append(editDesignationsHTML);

    var departmentDropDownHtml = '<option value="" disabled selected>Select a Department</option>';
    departmentDropDown.append(departmentDropDownHtml);

    var editDepartmentDropDownHtml = '<option value="" disabled selected>Select a Department</option>';
    editDepartmentDropDown.append(editDepartmentDropDownHtml);

    // Loop through the data and append rows to the table
    $.each(data.data, function(index, role) {
        var permissionsHTML = '';

        // Build the HTML for permissions based on your structure
        $.each(role.permissions, function(i, permission) {
            permissionsHTML +=
                '<div class="bg-green-500 text-dark p-1 rounded font-bold">' +
                permission.name + '</div>';
        });

        var serialno = index + 1;

        // Build the HTML for the "Active" badge and dropdown menu
        var actionHTML = '<td><span class="badge bg-label-primary me-1">Active</span></td>' +
            '<td>' +
            '<div class="dropdown">' +
            '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
            '<i class="bx bx-dots-vertical-rounded"></i>' +
            '</button>' +
            '<div class="dropdown-menu">' +
            '<button type="button" class="dropdown-item editRoleBtn" data-editrole-id="' + role
            .id + '">' +
            '<i class="bx bx-edit-alt me-1"></i> Edit' +
            '</button>' +
            '<button type="button" class="dropdown-item deleteRoleBtn" data-role-id="' + role
            .id + '">' +
            '<i class="bx bx-trash me-1"></i> Delete' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</td>';

        // Create the table row and append it to the table body
        var row = $('<tr>')
            .append('<td>' + serialno + '</td>')
            .append('<td>' + role.name + '</td>')
            .append('<td>' + permissionsHTML + '</td>')
            .append(actionHTML);

        roleTableBody.append(row);


        roleDropDownHtml = '<option value="' + role.name + '">' + role.name + '</option>';
        roleDropDown.append(roleDropDownHtml);

        editRoleDropDownHtml = '<option value="' + role.name + '">' + role.name + '</option>';
        editRoleDropDown.append(editRoleDropDownHtml);
    });

    // Iterate over designations and build rows
    $.each(data.designations, function(index, designation) {
        var designationHtml = '<option value="' + designation.id + '">' + designation.designation + '</option>';

        // Append the row to the tbody
        designations.append(designationHtml);
        editDesignations.append(designationHtml);
    });

    // Iterate over departments and build rows
    $.each(data.departments, function(index, department) {
        var departmentHtml = '<option value="' + department.id + '">' + department.name + '</option>';

        // Append the row to the tbody
        departmentDropDown.append(departmentHtml);
        editDepartmentDropDown.append(departmentHtml);
    });

    $.each(data.permissions, function(index, permission) {
        var serialNo = index + 1;

        var actionHTML = '<td><span class="badge bg-label-primary me-1">Active</span></td>' +
            '<td>' +
            '<div class="dropdown">' +
            '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
            '<i class="bx bx-dots-vertical-rounded"></i>' +
            '</button>' +
            '<div class="dropdown-menu">' +
            '<button type="button" class="dropdown-item editpermissionBtn" data-editpermission-id="' +
            permission
            .id + '">' +
            '<i class="bx bx-edit-alt me-1"></i> Edit' +
            '</button>' +
            '<button type="button" class="dropdown-item deletepermissionBtn" data-permission-id="' +
            permission
            .id + '">' +
            '<i class="bx bx-trash me-1"></i> Delete' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</td>';

        // Build HTML for each row
        var rowHtml = '<tr>' +
            '<td>' + serialNo + '</td>' +
            '<td>' + permission.name + '</td>' +
            actionHTML +
            '</tr>';

        // Append the row to the tbody
        permissionTableBody.append(rowHtml);

        var permissionModelRowHtml = '<tr>' +
            '<td>' + serialNo + '</td>' +
            '<td>' + permission.name + '</td>' +
            '<td><input value="' + permission.id +
            '" type="checkbox" name="permission[]" class="permission-checkbox"></td>' +
            '</tr>';

        // Append the row to the tbody
        permissionTableModelBody.append(permissionModelRowHtml);
    });

    $('auth-DropDown').empty();
        var authDropDownHtml = '<option value="" disabled selected>Select a Authorized Person</option>';
        $('#auth-DropDown').append(authDropDownHtml);

        $('editAuth-DropDown').empty();
        var authDropDownHtml = '<option value="" disabled selected>Select a Authorized Person</option>';
        $('#editAuth-DropDown').append(authDropDownHtml);
    // Iterate over users and build rows
    $.each(data.users, function(index, user) {
        var rolesHtml = '';
        $.each(user.roles, function(roleIndex, role) {
            rolesHtml += role.name + ' ';
        });

        //load users in the dropdown
        var userHtml = '<option value="' + user.id + '">' + user.name + '</option>';
            $('#auth-DropDown').append(userHtml);
        
        //end of load users in the dropdown

        //start of edit auhtorized person dropdown
        var userHtml = '<option value="' + user.id + '">' + user.name + '</option>';
            $('#editAuth-DropDown').append(userHtml);

        //end of edit auhtorized person dropdown

        // Check if the user has a profile photo
        var imageHtml = '';
        if (user.profile_photo_path) {
            imageHtml = '<div class="user-avatar"><img src="/global_assets/user_images/' + user
                .profile_photo_path + '" alt="User Avatar" class="avatar-sm rounded-circle me-2"></div>';
        } else {
            imageHtml =
                '<div class="user-avatar"><img src="/global_assets/user_images/default.png" alt="User Avatar" class="avatar-sm rounded-circle me-2"></div>';
        }

        // Initialize rowHtml
        var rowHtml = '';

        // Initialize rowHtml
        var rowHtml = '';

        // Build HTML for each row
        var rowHtml = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td>' + imageHtml + '</td>' +
            '<td>' + user.name + '</td>' +
            '<td>' + user.email + '</td>' +
            '<td>' + (user.department && user.department.name ? user.department.name : 'N/A') + '</td>' +
            '<td>' + (user.designation && user.designation.designation ? user.designation.designation : 'N/A') + '</td>' +
            '<td>' + rolesHtml + '</td>' +
            '<td><span class="badge bg-label-primary me-1">Active</span></td>' +
            '<td>' +
            '<div class="dropdown">' +
            '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
            '<i class="bx bx-dots-vertical-rounded"></i>' +
            '</button>' +
            '<div class="dropdown-menu">' +
            '<button type="button" class="dropdown-item edituserBtn" data-edituser-id="' + user.id + '">' +
            '<i class="bx bx-edit-alt me-1"></i> Edit' +
            '</button>' +
            '<button type="button" class="dropdown-item deleteuserBtn" data-user-id="' + user.id + '">' +
            '<i class="bx bx-trash me-1"></i> Delete' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '</tr>';

        // Append the row to the tbody
        userTableBody.append(rowHtml);
    });
}

//// Role Create////
$(document).ready(function() {
    $('#Role-Submit').on('submit', function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var permissions = $('.permission-checkbox:checked').map(function() {
            return this.value;
        }).get();

        // Use the Fetch API for AJAX request
        fetch("<?php echo e(route('settings.store')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                body: JSON.stringify({
                    name: name,
                    permission: permissions,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            })
            .then(data => {
                // Data saved successfully
                $('#exampleModal').modal('hide');
                // Use SweetAlert for success
                Toastify({
                    text: "Role Created Successfully!",
                    duration: 3000,
                    close: true,
                    gravity: "top", // Add this to change position
                    position: "right", // Add this to change position
                    backgroundColor: "green", // Set a different background color
                    stopOnFocus: true, // Stop timeout when the window gets focus
                }).showToast();

                // Fetch data again to refresh the table
                $.ajax({
                    url: "<?php echo e(route('roles.index')); ?>", // Replace with your actual route
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        // Populate the table with fetched data
                        populateTable(data);
                    },
                    error: function(error) {

                        console.error('Error fetching data:', error);
                    }
                });

                // Reset the form
                $('#Role-Submit').trigger('reset');
            })
            .catch(error => {
                //clear the error message
                $('#roleNameError').text('');
                $('#roleNameError').removeClass('text-danger');

                //set the error message
                $('#roleNameError').text(error.responseJSON.errors.name[0]);
            });
    });
});

//// Role Delete////
$(document).on('click', '.deleteRoleBtn', function(e) {
    e.preventDefault();
    var roleId = $(this).data('role-id');

    // Use SweetAlert for confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, send Ajax request
            $.ajax({
                type: "DELETE",
                url: "<?php echo e(url('roles')); ?>" + '/' + roleId,
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    // Handle success, e.g., remove the row from the table
                    Toastify({
                        text: "Role Delete Successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top", // Add this to change position
                        position: "right", // Add this to change position
                        backgroundColor: "red", // Set a different background color
                        stopOnFocus: true, // Stop timeout when the window gets focus
                    }).showToast();

                    // Fetch data again to refresh the table
                    $.ajax({
                        url: "<?php echo e(route('roles.index')); ?>",
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            // Populate the table with fetched data
                            populateTable(data);
                        },
                        error: function(error) {

                            console.error('Error fetching data:', error);
                        }
                    });
                },
                error: function(data) {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the role.',
                        'error'
                    );
                }
            });
        }
    });
});

// Role Edit
// Set up a global variable to store the current edit role ID
var currentEditRoleId = null;

// Handle the click event for the "Edit" button on the table
$(document).on('click', '.editRoleBtn', function() {
    var roleId = $(this).data('editrole-id');

    // Fetch edit data using Ajax
    $.ajax({
        url: "<?php echo e(url('roles')); ?>/" + roleId + "/edit",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the modal form with fetched data
            populateEditForm(data);
        },
        error: function(error) {
            console.error('Error fetching edit data:', error);
        }
    });
});

// Function to populate the modal form with edit data
function populateEditForm(data) {
    // Set role name in the input field
    $('#Rolename').val(data.role.name);

    // Clear existing rows in the permission table
    $('#Permission-Edit-Data').empty();

    $.each(data.permissions, function(index, permission) {
        var serialno = index + 1;

        // Check if the permission ID is in the data array
        var isChecked = data.data.includes(permission.id);

        // Build the HTML for the checkbox and append it to the table row
        var checkboxHTML = '<td><input value="' + permission.id +
            '" type="checkbox" name="permission[]" class="Checkedpermission" ' + (isChecked ? 'checked' :
                '') +
            '></td>';

        // Create the table row and append it to the table body
        var row = $('<tr>')
            .append('<td>' + serialno + '</td>')
            .append('<td>' + permission.name + '</td>')
            .append(checkboxHTML);

        $('#Permission-Edit-Data').append(row);
    });

    // Set role ID in a global variable
    currentEditRoleId = data.role.id;

    // Open the modal
    $('#RoleEditModal').modal('show');
}

// Handle the form submit event for the "Edit" form
$('#Role-Edit').on('submit', function(e) {
    e.preventDefault();

    // Get the values from the form
    var roleId = currentEditRoleId;
    var name = $('#Rolename').val();
    var permissions = $('.Checkedpermission:checked').map(function() {
        return this.value;
    }).get();

    // Use the Fetch API for AJAX request
    fetch("<?php echo e(url('roles')); ?>" + '/' + roleId, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            body: JSON.stringify({
                name: name,
                permissions: permissions,
            }),
        })
        .then(response => {
            if (!response.ok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        })
        .then(data => {
            // Data saved successfully
            $('#RoleEditModal').modal('hide');
            // Use SweetAlert for success
            Toastify({
                text: "Role Updated Successfully!",
                duration: 3000,
                close: true,
                gravity: "top", // Add this to change position
                position: "right", // Add this to change position
                backgroundColor: "green", // Set a different background color
                stopOnFocus: true, // Stop timeout when the window gets focus
            }).showToast();

            // Fetch data again to refresh the table
            $.ajax({
                url: "<?php echo e(route('roles.index')); ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate the table with fetched data
                    populateTable(data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            // Reset the form
            $('#Role-Edit').trigger('reset');
        })
        .catch(error => {
            // Handle errors
            $('#RoleEditModal').modal('hide');
            // Use SweetAlert for error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                showConfirmButton: false,
                timer: 1500
            });
        });
});


// Permission Create
$(document).ready(function() {
    $('#Permission-Submit').on('submit', function(e) {
        e.preventDefault();
        var name = $('#Permissionname').val();
        console.log('data', name);

        // Use the Fetch API for AJAX request
        fetch("<?php echo e(route('permissions.store')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                body: JSON.stringify({
                    name: name,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            })
            .then(data => {
                // Data saved successfully
                $('#Permission').modal('hide');
                // Use SweetAlert for success
                Toastify({
                    text: "Permission Created Successfully!",
                    duration: 3000,
                    close: true,
                    gravity: "top", // Add this to change position
                    position: "right", // Add this to change position
                    backgroundColor: "green", // Set a different background color
                    stopOnFocus: true, // Stop timeout when the window gets focus
                }).showToast();

                $('#Permission-Submit').trigger('reset');

                // Fetch data using AJAX
                $.ajax({
                    url: "<?php echo e(route('roles.index')); ?>", // Replace with your actual route
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        // Populate the table with fetched data
                        populateTable(data);
                    },
                    error: function(error) {

                        console.error('Error fetching data:', error);
                    }
                });
            })
            .catch(error => {
                //clear the error message
                $('#permissionNameError').text('');
                $('#permissionNameError').removeClass('text-danger');

                //set the error message
                $('#permissionNameError').text(error.responseJSON.errors.name[0]);
            });
    });
});

// Permission Delete
$(document).on('click', '.deletepermissionBtn', function(e) {
    e.preventDefault();
    var permissionId = $(this).data('permission-id');

    // Use SweetAlert for confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, send Ajax request
            $.ajax({
                type: "DELETE",
                url: "<?php echo e(url('permissions')); ?>" + '/' + permissionId,
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    // Handle success, e.g., remove the row from the table
                    Toastify({
                        text: "Permission Delete Successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top", // Add this to change position
                        position: "right", // Add this to change position
                        backgroundColor: "red", // Set a different background color
                        stopOnFocus: true, // Stop timeout when the window gets focus
                    }).showToast();

                    // Fetch data again to refresh the table
                    $.ajax({
                        url: "<?php echo e(route('roles.index')); ?>",
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            // Populate the table with fetched data
                            populateTable(data);
                        },
                        error: function(error) {

                            console.error('Error fetching data:', error);
                        }
                    });
                },
                error: function(data) {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the permission.',
                        'error'
                    );
                }
            });
        }
    });
});

//// Permission Edit
// Set up a global variable to store the current edit permission ID
var currentEditPermissionId = null;

// Handle the click event for the "Edit" button
$(document).on('click', '.editpermissionBtn', function() {
    var permissionId = $(this).data('editpermission-id');

    // Fetch edit data using Ajax
    $.ajax({
        url: "<?php echo e(url('permissions')); ?>/" + permissionId + "/edit",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the modal form with fetched data
            populateEditPermissionForm(data);
        },
        error: function(error) {
            console.error('Error fetching edit data:', error);
        }
    });
});

// Function to populate the modal form with edit data
function populateEditPermissionForm(data) {
    // Set permission name in the input field
    $('#EditPermissionname').val(data.permissions.name);

    // Set permission ID in a global variable
    currentEditPermissionId = data.permissions.id;

    // Open the modal
    $('#Edit-Permission').modal('show');
}

// Handle the form submit event for the "Edit" form
$('#Edit-Permission-Submit').on('submit', function(e) {
    e.preventDefault();

    // Get the values from the form
    var EditPermissionId = currentEditPermissionId;
    var name = $('#EditPermissionname').val();

    // Use the Fetch API for AJAX request
    fetch("<?php echo e(url('permissions')); ?>" + '/' + EditPermissionId, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            body: JSON.stringify({
                name: name,
            }),
        })
        .then(response => {
            if (!response.ok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        })
        .then(data => {
            // Data saved successfully
            $('#Edit-Permission').modal('hide');
            // Use SweetAlert for success
            Toastify({
                text: "Permission Updated Successfully!",
                duration: 3000,
                close: true,
                gravity: "top", // Add this to change position
                position: "right", // Add this to change position
                backgroundColor: "green", // Set a different background color
                stopOnFocus: true, // Stop timeout when the window gets focus
            }).showToast();

            // Fetch data again to refresh the table
            $.ajax({
                url: "<?php echo e(route('roles.index')); ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate the table with fetched data
                    populateTable(data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            // Reset the form
            $('#Edit-Permission-Submit').trigger('reset');
        })
        .catch(error => {
            // Handle errors
            $('#Edit-Permission').modal('hide');
            // Use SweetAlert for error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                show: false,
                timer: 1500,
                text: 'Something went wrong!',
            });
        });
});

//// User Create////
$(document).ready(function() {
    $('#User-Submit').on('submit', function(e) {
        e.preventDefault();
        var name = $('#Username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var re_password = $('#re-password').val();
        var role = $('#Role-DropDown').val();
        var photo = $('#photo')[0].files[0]; // Get the file input
        var designation = $('#Designation-DropDown').val();
        var auth = $('#auth-DropDown').val();
        var signature = $('#signature')[0].files[0]; // Get the file input
        var department = $('#Department-DropDown').val();

        var formData = new FormData();

        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('password_confirmation', re_password);
        formData.append('roles', role);
        formData.append('designation_id', designation);
        formData.append('department_id', department);
        formData.append('auth_id', auth);
        if (photo != '') {
            formData.append('photo', photo);
        }

        if (signature != '') {
            formData.append('signature', signature);
        }

        // Use the Fetch API for AJAX request
        fetch("<?php echo e(route('user-records.store')); ?>", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                body: formData,
            })
            .then(response => {
                console.log('response', response);
                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.error,
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.status == true) {
                    // Data saved successfully
                    console.log('data', data);
                    $('#User').modal('hide');
                    // Use SweetAlert for success
                    Toastify({
                        text: "User Created Successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top", // Add this to change position
                        position: "right", // Add this to change position
                        backgroundColor: "green", // Set a different background color
                        stopOnFocus: true, // Stop timeout when the window gets focus
                    }).showToast();

                    // Fetch data using AJAX
                    $.ajax({
                        url: "<?php echo e(route('roles.index')); ?>", // Replace with your actual route
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            // Populate the table with fetched data
                            populateTable(data);
                        },
                        error: function(error) {

                            console.error('Error fetching data:', error);
                        }
                    });

                    // Reset the form
                    $('#User-Submit').trigger('reset');
                } else {
                    //clear the error message
                    console.log('error', data.errors);

                    //clear the error message
                    if (data.errors.name) {
                        $('#userNameError').text('');

                        //set the error message
                        $('#userNameError').text(data.errors.name[0]);
                    }

                    //clear the error message
                    if (data.errors.email) {
                        $('#userEmailError').text('');

                        //set the error message
                        $('#userEmailError').text(data.errors.email[0]);
                    }

                    //clear the error message
                    if (data.errors.password) {
                        $('#userPasswordError').text('');

                        //set the error message
                        $('#userPasswordError').text(data.errors.password[0]);
                    }

                    //clear the error message
                    if (data.errors.password_confirmation) {
                        $('#userRePasswordError').text('');

                        //set the error message
                        $('#userRePasswordError').text(data.errors.password_confirmation[0]);
                    }

                    //clear the error message
                    if (data.errors.roles) {
                        $('#userRoleError').text('');

                        //set the error message
                        $('#userRoleError').text(data.errors.roles[0]);
                    }
                }
            })
            .catch(error => {
                //clear the error message
                console.log('error', error);
                $('#userNameError').text('');
                $('#userNameError').removeClass('text-danger');

                //set the error message
                $('#userNameError').text(error.responseJSON.errors.name[0]);

                //clear the error message
                $('#userEmailError').text('');
                $('#userEmailError').removeClass('text-danger');

                //set the error message
                $('#userEmailError').text(error.responseJSON.errors.email[0]);

                //clear the error message
                $('#userPasswordError').text('');
                $('#userPasswordError').removeClass('text-danger');

                //set the error message
                $('#userPasswordError').text(error.responseJSON.errors.password[0]);

                //clear the error message
                $('#userRoleError').text('');
                $('#userRoleError').removeClass('text-danger');

                //set the error message
                $('#userRoleError').text(error.responseJSON.errors.roles[0]);
            });
    });
});

//// User Delete////
$(document).on('click', '.deleteuserBtn', function(e) {
    e.preventDefault();
    var userId = $(this).data('user-id');

    // Use SweetAlert for confirmation
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
            // If user confirms, send Ajax request
            $.ajax({
                type: "DELETE",
                url: "<?php echo e(url('user-records')); ?>" + '/' + userId,
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    // Check if the deletion was successful
                    console.log('data', data);
                    if (data.status == 200) {
                        Toastify({
                            text: "User Deleted Successfully!",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                            stopOnFocus: true,
                        }).showToast();
                    } else {
                        console.error('Error deleting data:', data.message);
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                },
                error: function(error) {
                    console.error('Error deleting data:', error);
                    Swal.fire(
                        'Error!',
                        error.response.data.message,
                        'error'
                    );
                },
                complete: function() {
                    // Fetch data again to refresh the table, regardless of the outcome
                    $.ajax({
                        url: "<?php echo e(route('roles.index')); ?>",
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Populate the table with fetched data
                            populateTable(data);
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            });
        }
    });
});

//// User Edit
// Set up a global variable to store the current edit user ID
var currentEditUserId = null;

// Handle the click event for the "Edit" button
$(document).on('click', '.edituserBtn', function() {
    var userId = $(this).data('edituser-id');

    // Fetch edit data using Ajax
    $.ajax({
        url: "<?php echo e(url('user-records')); ?>/" + userId + "/edit",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the modal form with fetched data
            console.log('data', data);
            populateEditUserForm(data);
        },
        error: function(error) {
            console.error('Error fetching edit data:', error);
        }
    });
});

// Function to populate the modal form with edit data
function populateEditUserForm(data) {
    // Set user name in the input field
    $('#EditUsername').val(data.name);
    $('#Editemail').val(data.email);
    $('#EditRole-DropDown').val(data.userhas_role[0].role.name);
    $('#Editdesignation').val(data.designation_id);
    $('#editAuth-DropDown').val(data.auth_by);
    $('#Editdepartment-DropDown').val(data.department_id);

    // Check if the user has a profile photo
    var imageHtml = '';
    if (data.profile_photo_path) {
        imageHtml = '<div class="user-avatar"><img src="/global_assets/user_images/' + data.profile_photo_path +
            '" alt="User Avatar" class="avatar-sm rounded-circle me-2" style="width: 200px; height: 200px;"></div>';
    } else {
        imageHtml =
            '<div class="user-avatar"><img src="/global_assets/user_images/default.png" alt="User Avatar" class="avatar-sm rounded-circle me-2" style="width: 200px; height: 200px;"></div>';
    }

    var signatureHtml = '';
    if(data.signature){
        signatureHtml = '<div class="user-avatar"><img src="/global_assets/user_images/signature/' + data.signature +
            '" alt="User Avatar" class="avatar-sm rounded-circle me-2" style="width: 200px; height: 200px;"></div>';
    }

    // Set the image HTML
    $('#EditUserImage').html(imageHtml);

    // Set the signature HTML
    $('#EditUserSignature').html(signatureHtml);

    // Set user ID in a global variable
    currentEditUserId = data.id;

    // Open the modal
    $('#Edit-User').modal('show');
}

// Handle the form submit event for the "Edit" form
$('#Edit-User-Submit').on('submit', function(e) {
    e.preventDefault();

    // Get the values from the form
    var EditUserId = currentEditUserId;

    var name = $('#EditUsername').val();
    var email = $('#Editemail').val();
    var role = $('#EditRole-DropDown').val();
    var photo = $('#Editphoto')[0].files[0]; // Get the file input
    var designation = $('#Editdesignation').val();
    var auth_by = $('#editAuth-DropDown').val();
    var editSignature = $('#Editsignature')[0].files[0];
    var department = $('#Editdepartment-DropDown').val();

    // Check if the 'name' field has a value
    if (!name) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Name field is required.',
        });
        return;
    }

    var editFormData = new FormData();

    editFormData.append('name', name);
    editFormData.append('email', email);
    editFormData.append('roles', role);
    editFormData.append('designation_id', designation);
    editFormData.append('department_id', department);
    editFormData.append('auth_id', auth_by);
    if (photo) {
        editFormData.append('photo', photo);
    }

    if (editSignature) {
        editFormData.append('signature', editSignature);
    }


    // Use the Fetch API for AJAX request
    fetch("<?php echo e(url('user-records')); ?>" + '/' + EditUserId + '/update', {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            body: editFormData,
        })
        .then(response => {
            console.log('response', response);
            if (!response.ok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.error,
                });
            }
            return response.json();
        })
        .then(data => {
            // Data saved successfully
            $('#Edit-User').modal('hide');
            // Use SweetAlert for success
            Toastify({
                text: "User Updated Successfully!",
                duration: 3000,
                close: true,
                gravity: "top", // Add this to change position
                position: "right", // Add this to change position
                backgroundColor: "green", // Set a different background color
                stopOnFocus: true, // Stop timeout when the window gets focus
            }).showToast();

            // Fetch data again to refresh the table
            $.ajax({
                url: "<?php echo e(route('roles.index')); ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate the table with fetched data
                    populateTable(data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            // Reset
            $('#Edit-User-Submit').trigger('reset');
        })
        .catch(error => {
            console.log('error', error);
            // Handle errors
            $('#Edit-User').modal('hide');
            // Use SweetAlert for error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                show: false,
                timer: 1500,
                text: error.response.data.message,
            });
        });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\RNT Automation\resources\views/backend/pages/settings.blade.php ENDPATH**/ ?>