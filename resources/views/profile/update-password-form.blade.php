<div class="md:grid md:grid-cols-3 md:gap-6">
    <x-section-title>
        <x-slot name="title">{{ __('Update Password') }}</x-slot>
        <x-slot name="description">{{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form id="Change-Password-Submit">
            <div class="px-4 py-5 bg-white sm:p-6 shadow">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="current_password" value="{{ __('CURRENT PASSWORD') }}" />
                        <x-input id="current_password" type="password" class="mt-1 block w-full"
                            wire:model="state.current_password" autocomplete="current-password" />
                        <x-input-error for="current_password" id="current_passwordError" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="password" value="{{ __('NEW PASSWORD') }}" />
                        <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password"
                            autocomplete="new-password" />
                        <x-input-error for="password" id="passwordError" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="password_confirmation" value="{{ __('CONFIRM PASSWORD') }}" />
                        <x-input id="password_confirmation" type="password" class="mt-1 block w-full"
                            wire:model="state.password_confirmation" autocomplete="new-password" />
                        <x-input-error for="password_confirmation" id="password_confirmationError" class="mt-2" />
                    </div>
                </div>
                <button type="submit" style="float: right;"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    id="Edit-User-Submit">Save</button>
            </div>
        </form>
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
$(document).ready(function() {
    $('#Change-Password-Submit').on('submit', function(e) {
        e.preventDefault();
        var current_password = $('#current_password').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        var PasswordformData = new FormData();

        PasswordformData.append('old_password', current_password);
        PasswordformData.append('password', password);
        PasswordformData.append('password_confirmation', password_confirmation);

        if (current_password == '' || password == '' || password_confirmation == '') {
            Toastify({
                text: "All fields are required",
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "red",
                stopOnFocus: true,
            }).showToast();
            return false;
        } else {
            $.ajax({
                method: "POST",
                url: "{{ route('profile.password') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                data: {
                    old_password: current_password,
                    password: password,
                    password_confirmation: password_confirmation,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();

                        $('#Change-Password-Submit')[0].reset();
                        location.reload();
                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "red",
                            stopOnFocus: true,
                        }).showToast();
                    }
                },
                error: function(error) {
                    console.log(error);
                    Toastify({
                        text: error.responseJSON.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "red",
                        stopOnFocus: true,
                    }).showToast();
                }
            });
        }
    });
});
</script>