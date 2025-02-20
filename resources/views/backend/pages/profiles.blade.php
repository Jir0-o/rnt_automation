@extends('layouts.master')

@section('content')

<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="md:grid md:grid-cols-3 md:gap-6">

            <div class="md:col-span-1 flex justify-between">

                <div class="px-4 sm:px-0">

                    <!-- show user image -->

                    <div>

                        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>

                        <p class="mt-1 text-sm text-gray-600">

                            Update your account's profile information.

                        </p>

                    </div>

                    <div class="mt-5">

                        <div class="flex-shrink-0">

                            <img class="show-image" id="full-user-image" src="" alt="User Image">

                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">

                <form id="Edit-User-Submit" enctype="multipart/form-data">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="{{ __('NAME') }}" />
                                <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    wire:model="state.name" required autocomplete="name" />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="email" value="{{ __('EMAIL') }}" />
                                <x-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    wire:model="state.email" required autocomplete="username" />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <!-- Profile Photo -->
                            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                                <x-label for="photo" value="{{ __('UPLOAD PHOTO') }}" />
                                <input type="file" id="photo" name="photo" class="form-control"
                                    x-on:change="photoPreview = URL.createObjectURL($event.target.files[0])" />
                                <x-label for="photo" x-show="!photoPreview" value="{{ __('Existing Photo') }}" />
                                <x-label for="photo" x-show="photoPreview" value="{{ __('Photo') }}" />
                                <!-- Current Profile Photo -->
                                <div class="mt-2" x-show="!photoPreview" id="current-user-image"></div>
                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                                </div>
                                <x-input-error for="photo" class="mt-2" />
                            </div>
                        </div>

                        <button type="submit" style="float: right;"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            id="Edit-User-Submit-Button">Save</button>
                    </div>
                </form>
            </div>
            <x-section-border />
        </div>

        <div class="mt-10 sm:mt-0">

            @livewire('profile.update-password-form')

            <x-section-border />

        </div>



        <div class="mt-10 sm:mt-0">

            @livewire('profile.logout-other-browser-sessions-form')

        </div>

    </div>

</x-app-layout>



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
$(document).ready(function() {

    // Update system profile function
    function updateSystemProfile(formData) {
        $.ajax({
            type: 'POST', // Use POST for file upload
            url: "{{ route('settings.update', ':id') }}".replace(':id', systemId),
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            data: formData,
            contentType: false, // Important: Needed for FormData
            processData: false, // Important: Needed for FormData
            success: function(data) {
                if (data.status == false) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#FF0000",
                        stopOnFocus: true,
                    }).showToast();
                } else {
                    Toastify({
                        text: 'System Profile Updated Successfully',
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();

                    // Update the system profile image
                    getSystem();
                }
            },
            error: function(xhr) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    }

    // Handle form submission
    $('#Edit-System-Submit-Button').on('submit', function(e) {
        e.preventDefault();

        console.log('Form submitted!');
        var formData = new FormData();
        formData.append('applicable_session_id', $('#as').val());
        if ($('#logo')[0].files[0]) {
            formData.append('logo', $('#logo')[0].files[0]);
        }

        console.log('id:', $('#as').val());
        console.log('logo:', $('#logo')[0].files[0]);

        updateSystemProfile(formData);
    });

    var currentEditUserId = null;

    function getUser() {

        $.ajax({
            url: "{{ route('profile.show') }}",
            type: "GET",
            success: function(response) {
                $('#user-name').text(response.data.name);

                // update image

                if (response.data.profile_photo_path) {
                    // If profile photo exists, set the image source

                    $('#user-image').attr('src', '/global_assets/user_images/' + response
                        .data.profile_photo_path);

                    $('#dropdown-user-image').attr('src', '/global_assets/user_images/' +
                        response.data.profile_photo_path);

                    $('#full-user-image').attr('src', '/global_assets/user_images/' +
                        response.data.profile_photo_path);

                } else {

                    // If no profile photo exists, set a default image source

                    $('#user-image').attr('src', '/global_assets/user_images/default.png');

                    $('#dropdown-user-image').attr('src',
                        '/global_assets/user_images/default.png');

                }

                // Check if the user has a profile photo

                var imageHtml = '';

                if (response.data.profile_photo_path) {
                    imageHtml = '<img src="/global_assets/user_images/' + response.data
                        .profile_photo_path +
                        '" alt="Preview Image" class="rounded-full h-20 w-20 object-cover">';
                } else {

                    imageHtml =
                        '<div class="user-avatar"><img src="/global_assets/user_images/default.png" alt="User Avatar" class="w-35px rounded-circle"></div>';
                }

                $('#current-user-image').html(imageHtml);

                // set existing value to all input fields
                $('#name').val(response.data.name);

                $('#email').val(response.data.email);

                currentEditUserId = response.data.id;
            }

        });

    }
    getUser();


    // Update user profile function
    function updateUserProfile(formData, EditUserId) {
        $.ajax({
            type: 'POST', // Use POST for file upload
            url: "{{ route('user-records.update.profile', ':id') }}".replace(':id', EditUserId),
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            data: formData,
            contentType: false, // Important: Needed for FormData
            processData: false, // Important: Needed for FormData
            success: function(data) {
                if (data.status == false) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#FF0000",
                        stopOnFocus: true,
                    }).showToast();
                } else {
                    Toastify({
                        text: 'User Profile Updated Successfully',
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();

                    // Update the user profile image
                    getUser();
                }
            },
            error: function(xhr) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    }

    // Handle form submission
    $('#Edit-User-Submit').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        if ($('#photo')[0].files[0]) {
            formData.append('photo', $('#photo')[0].files[0]);
        }

        updateUserProfile(formData, currentEditUserId);
    });

});
</script>

<style>
/* hight wided for show-image */

.show-image {

    height: 200px;

    width: 200px;

    border-radius: 5px;

    object-fit: cover;

}
</style>

@endsection