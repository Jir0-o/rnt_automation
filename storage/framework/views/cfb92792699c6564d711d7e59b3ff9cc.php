

<?php $__env->startSection('title', 'Profile Management'); ?>

<?php $__env->startSection('head'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .profile-card { background: #fff; border-radius: 12px; padding: 1.75rem; box-shadow: 0 12px 30px -10px rgba(0,0,0,0.08); }
    .avatar-wrapper { width:110px; height:110px; margin-bottom:.5rem; }
    .avatar-wrapper img { width:100%; height:100%; object-fit:cover; border-radius:50%; border:3px solid #6366f1; }
    .btn-upload { font-size:.75rem; padding:6px 12px; }
    .tab-buttons .btn { border-radius:999px; padding:.5rem 1rem; font-size:.85rem; font-weight:600; margin-right:.5rem; cursor:pointer; border:1px solid #d1d9e6; background:#fff; text-decoration:none; display:inline-block; }
    .tab-buttons .btn.active { background:#6366f1; color:#fff; border:none; }
    .form-label { display:block; font-weight:600; font-size:.75rem; text-transform:uppercase; margin-bottom:4px; }
    .input-custom { width:100%; padding:.75rem 1rem; border:1px solid #d1d9e6; border-radius:.5rem; background:#f9f9fc; font-size:.9rem; }
    .input-custom:focus { outline:none; border-color:#6366f1; background:#fff; }
    .input-with-toggle { padding-right:2.5rem; }
    .error-text { color:#dc2626; font-size:.75rem; margin-top:4px; min-height:1em; }
    .card-footer { text-align:right; margin-top:1rem; }
    .small-muted { font-size:.75rem; color:#6b7280; }
    .divider { height:1px; background:#e5e7eb; margin:1.5rem 0; }
    .password-wrapper { position: relative; }
    .toggle-password-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 2px;
        line-height: 0;
    }
    .d-none { display: none !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $activeTab = request('tab', 'profile');
    if ($errors->hasAny(['old_password','password','password_confirmation'])) {
        $activeTab = 'password';
    }
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="profile-card">

                
                <?php if(session('success')): ?>
                    <div class="mb-3">
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-3">
                        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between flex-wrap mb-4">
                    <div>
                        <h2 class="mb-1">Profile Management</h2>
                        <div class="small-muted">Update your info, email, photo and password.</div>
                    </div>
                    <div class="tab-buttons" role="tablist" aria-label="Profile tabs">
                        <a href="<?php echo e(route('user.profile', ['tab' => 'profile'])); ?>"
                           class="btn <?php echo e($activeTab === 'profile' ? 'active' : ''); ?>"
                           role="tab"
                           aria-selected="<?php echo e($activeTab === 'profile' ? 'true' : 'false'); ?>"
                           aria-controls="pane-profile">
                            Profile Info
                        </a>
                        <a href="<?php echo e(route('user.profile', ['tab' => 'password'])); ?>"
                           class="btn <?php echo e($activeTab === 'password' ? 'active' : ''); ?>"
                           role="tab"
                           aria-selected="<?php echo e($activeTab === 'password' ? 'true' : 'false'); ?>"
                           aria-controls="pane-password">
                            Change Password
                        </a>
                    </div>
                </div>

                
                <div class="pane <?php echo e($activeTab !== 'profile' ? 'd-none' : ''); ?>" id="pane-profile" role="tabpanel" aria-labelledby="tab-profile">
                    <form id="profile-form" action="<?php echo e(route('user.update')); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row gy-4">
                            <div class="col-md-4 text-center">
                                <div class="avatar-wrapper mx-auto">
                                    <img src="<?php echo e($user->profile_photo_url); ?>" alt="Avatar" id="avatar-preview">
                                </div>
                                <div class="mb-2">
                                    <label class="btn btn-sm btn-primary btn-upload">
                                        Change Photo
                                        <input type="file" name="photo" id="photo" accept="image/*" hidden>
                                    </label>
                                </div>
                                <div class="small-muted">Allowed: jpg, jpeg, png, webp (max 1MB)</div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" name="name" class="input-custom" value="<?php echo e(old('name', $user->name)); ?>">
                                    <div class="error-text" id="error-name">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="input-custom" value="<?php echo e(old('email', $user->email)); ?>">
                                    <div class="error-text" id="error-email">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="current_password_for_email">
                                        Current Password <small class="small-muted">(required if changing email)</small>
                                    </label>
                                    <div class="password-wrapper">
                                        <input type="password" id="current_password_for_email" name="current_password_for_email" class="input-custom input-with-toggle" placeholder="Current password to change email" autocomplete="current-password">
                                        <button type="button" class="toggle-password-btn" aria-label="Show password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="eye" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="eye-slash d-none" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 104.24 4.24"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.65 5.65c1.28-.3 2.64-.35 3.9-.14M6.18 6.18C4.4 7.45 3 9.61 3 12c1.274 4.057 5.064 7 9.542 7 1.42 0 2.77-.28 4.02-.78"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="error-text" id="error-current_password_for_email">
                                        <?php $__errorArgs = ['current_password_for_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="save-profile" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="divider"></div>

                
                <div class="pane <?php echo e($activeTab !== 'password' ? 'd-none' : ''); ?>" id="pane-password" role="tabpanel" aria-labelledby="tab-password">
                    <form id="password-form" action="<?php echo e(route('user.password')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <label class="form-label" for="current_password">Current Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="current_password" name="old_password" class="input-custom input-with-toggle" autocomplete="current-password">
                                    <button type="button" class="toggle-password-btn" aria-label="Show password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-slash d-none" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 104.24 4.24"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.65 5.65c1.28-.3 2.64-.35 3.9-.14M6.18 6.18C4.4 7.45 3 9.61 3 12c1.274 4.057 5.064 7 9.542 7 1.42 0 2.77-.28 4.02-.78"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="error-text" id="error-current_password">
                                    <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="password">New Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" class="input-custom input-with-toggle" autocomplete="new-password">
                                    <button type="button" class="toggle-password-btn" aria-label="Show password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-slash d-none" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 104.24 4.24"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.65 5.65c1.28-.3 2.64-.35 3.9-.14M6.18 6.18C4.4 7.45 3 9.61 3 12c1.274 4.057 5.064 7 9.542 7 1.42 0 2.77-.28 4.02-.78"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="error-text" id="error-password">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-custom input-with-toggle" autocomplete="new-password">
                                    <button type="button" class="toggle-password-btn" aria-label="Show password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-slash d-none" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 104.24 4.24"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.65 5.65c1.28-.3 2.64-.35 3.9-.14M6.18 6.18C4.4 7.45 3 9.61 3 12c1.274 4.057 5.064 7 9.542 7 1.42 0 2.77-.28 4.02-.78"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="error-text" id="error-password_confirmation">
                                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="save-password" class="btn btn-success px-4">Change Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- full jQuery, not slim -->


<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.toggle-password-btn');
    if (!btn) return;
    e.preventDefault();

    const wrapper = btn.closest('.password-wrapper');
    if (!wrapper) return;

    const input = wrapper.querySelector('input');
    if (!input) return;

    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';

    // swap icons (matching the original jQuery logic)
    const eye = btn.querySelector('.eye');
    const eyeSlash = btn.querySelector('.eye-slash');
    if (eye) eye.classList.toggle('d-none', !isHidden);
    if (eyeSlash) eyeSlash.classList.toggle('d-none', isHidden);

    // update aria-label
    btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
});
</script>

<script>
$(function() {
    // Show success alert after reload if profile was updated
    if (localStorage.getItem('profile_updated') === '1') {
        localStorage.removeItem('profile_updated');
        Swal.fire({
            icon: 'success',
            title: 'Profile updated',
            text: 'Your profile has been saved.',
            timer: 2500,
            showConfirmButton: false,
        });
    }

    // CSRF for AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Image preview
    $('#photo').on('change', function() {
        const file = this.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        const url = URL.createObjectURL(file);
        $('#avatar-preview').attr('src', url).on('load', function() {
            URL.revokeObjectURL(url);
        });
    });

    // AJAX profile update
    $('#profile-form').on('submit', function(e) {
        e.preventDefault();
        $('#error-name').text('');
        $('#error-email').text('');
        $('#error-current_password_for_email').text('');

        const formData = new FormData(this);
        $('#save-profile').prop('disabled', true).text('Saving...');

        $.ajax({
            url: "<?php echo e(route('user.update')); ?>",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
        })
        .done(function(res) {
            if (res.logout) {
                Swal.fire({
                    icon: 'info',
                    title: 'Email changed',
                    text: 'You need to log in again.',
                    timer: 2200,
                    showConfirmButton: false,
                });
                setTimeout(() => {
                    window.location.href = res.redirect || "<?php echo e(route('login')); ?>";
                }, 1000);
                return;
            }
            localStorage.setItem('profile_updated', '1');
            location.reload();
        })
        .fail(function(xhr) {
            if (xhr.responseJSON?.errors) {
                const errs = xhr.responseJSON.errors;
                if (errs.name) { $('#error-name').text(errs.name[0]); }
                if (errs.email) { $('#error-email').text(errs.email[0]); }
                if (errs.current_password_for_email) { $('#error-current_password_for_email').text(errs.current_password_for_email[0]); }
            } else {
                Toastify({
                    text: xhr.responseJSON?.message || 'Failed to update profile',
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "red"
                }).showToast();
            }
        })
        .always(function() {
            $('#save-profile').prop('disabled', false).text('Save Changes');
        });
    });

    // AJAX password change
    $('#password-form').on('submit', function(e) {
        e.preventDefault();
        $('#error-current_password').text('');
        $('#error-password').text('');
        $('#error-password_confirmation').text('');

        const payload = {
            old_password: $('#current_password').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val()
        };

        $('#save-password').prop('disabled', true).text('Updating...');

        $.ajax({
            url: "<?php echo e(route('user.password')); ?>",
            method: 'POST',
            data: payload,
            dataType: 'json',
        })
        .done(function(res) {
            if (res.logout) {
                Swal.fire({
                    icon: 'success',
                    title: 'Password changed',
                    text: 'Please log in again.',
                    timer: 2200,
                    showConfirmButton: false,
                });
                setTimeout(() => {
                    window.location.href = res.redirect || "<?php echo e(route('login')); ?>";
                }, 1000);
                return;
            }

            Toastify({
                text: res.message || 'Password changed successfully',
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "#10b981"
            }).showToast();
            $('#password-form')[0].reset();
        })
        .fail(function(xhr) {
            if (xhr.status === 422 && xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    const errs = xhr.responseJSON.errors;
                    if (errs.old_password) { $('#error-current_password').text(errs.old_password[0]); }
                    if (errs.password) { $('#error-password').text(errs.password[0]); }
                    if (errs.password_confirmation) { $('#error-password_confirmation').text(errs.password_confirmation[0]); }
                } else if (xhr.responseJSON.message) {
                    Toastify({
                        text: xhr.responseJSON.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "orange"
                    }).showToast();
                }
            } else {
                Toastify({
                    text: xhr.responseJSON?.message || 'Failed to change password',
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "red"
                }).showToast();
            }
        })
        .always(function() {
            $('#save-password').prop('disabled', false).text('Change Password');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/profile/profile_management.blade.php ENDPATH**/ ?>