
<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, rgb(39, 38, 38) 50%, rgb(247, 246, 246) 50%); /* Split black and white background */
        background-size: 200% 200%; /* For smooth gradient animation */
        animation: gradientAnimation 10s ease infinite; /* Apply the animation */
        color: #000; /* Black text for better contrast */
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden; /* Prevent scrollbars during animations */
    }

    @keyframes gradientAnimation {
        0% { background-position: 50% 100%; }
        50% { background-position: 0% 50%; }
        100% { background-position: 50% 100%; }
    }

    .card {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 850px; /* Increased width */
        padding: 2rem; /* Slightly reduced padding */
        margin: 20px;
        backdrop-filter: blur(10px); /* Blur effect for glassmorphism */
        animation: fadeIn 1s ease-in-out; /* Fade-in animation */
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        animation: bounce 2s infinite; /* Bounce animation for logo */
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .logo {
        max-width: 120px;
        height: 120px; /* Make it square */
        border-radius: 50%; /* Make it round */
        object-fit: cover; /* Ensure it stays properly fitted */
        margin-bottom: 1.5rem;
    }

    .login-title {
    font-size: 28px;
    font-weight: bold;
    color: #000;
    margin-bottom: 2rem;
    text-align: center;
    overflow: hidden; /* Hide overflow to create the typing effect */
    white-space: nowrap; /* Keep text on one line */
    border-right: 2px solid #000; /* Cursor effect */
    animation: typing 5s steps(40, end) infinite, blink-cursor 0.75s step-end infinite;
    }

    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    /* Typing animation */
    @keyframes typing {
        0% { width: 0; } /* Start with no width */
        50% { width: 100%; } /* Expand to full width */
        70%, 100% { width: 100%; } /* Hold at full width for 2 seconds */
    }

    /* Cursor blink animation */
    @keyframes blink-cursor {
        from, to { border-color: transparent; } /* Hide cursor */
        50% { border-color: #000; } /* Show cursor */
    }

    .form-control {
        background: #f9f9f9; /* Light gray input fields */
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px;
        padding: 12px;
        width: 100%;
        margin-bottom: 1.5rem; /* More spacing between fields */
        transition: all 0.3s ease; /* Smooth transition */
    }

    .form-control:focus {
        background: #fff; /* White on focus */
        border-color: #000; /* Black border on focus */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transform: scale(1.02); /* Slight zoom effect */
    }

    .btn-primary {
        background: #000; /* Black button */
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 16px;
        color: #fff; /* White text */
        width: 100%;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background: #333; /* Darker black on hover */
        transform: translateY(-2px); /* Lift effect */
    }

    .forgot-password-link {
        color: #000; /* Black link */
        text-decoration: none;
        transition: color 0.3s ease, transform 0.3s ease;
        display: block;
        text-align: center;
        margin-top: 1.5rem;
    }

    .forgot-password-link:hover {
        color: #555; /* Darker gray on hover */
        transform: translateX(5px); /* Slight shift on hover */
    }

    .alert {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent alerts */
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.5s ease-in-out; /* Fade-in for alerts */
    }

    .alert-danger {
        background: rgba(255, 0, 0, 0.1); /* Red background for danger alerts */
        border-color: rgba(255, 0, 0, 0.2);
    }

    .alert-success {
        background: rgba(0, 255, 0, 0.1); /* Green background for success alerts */
        border-color: rgba(0, 255, 0, 0.2);
    }
</style>
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-11">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo at the top -->
                        <div class="logo-container">
                            <img src="<?php echo e(asset('RNT-Logo.png')); ?>" alt="RNT Automation Logo" class="logo">
                        </div>

                        <!-- Login title -->
                        <h5 class="login-title">Login to RNT Automation</h5>

                        <?php if(session('status')): ?>
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <?php echo e(session('status')); ?>

                        </div>
                        <?php endif; ?>

                        <?php if(Session::has('success')): ?>
                        <p class="alert alert-success"><?php echo e(Session::get('success')); ?></p>
                        <?php endif; ?>

                        <!-- Login form -->
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>

                            <!-- Email input -->
                            <div class="mb-4">
                                <label class="form-label" for="form3Example3">Email address</label>
                                <input type="email" id="form3Example3" name="email"
                                    class="form-control form-control-lg"
                                    placeholder="Enter a valid email address" />
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" class="form-control form-control-lg" type="password" name="password"
                                    required autocomplete="current-password"
                                    placeholder="Enter your password" />
                            </div>

                            <!-- Remember me and Forgot password -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="block">
                                    <label for="remember_me" class="flex items-center">
                                        <?php if (isset($component)) { $__componentOriginal74b62b190a03153f11871f645315f4de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74b62b190a03153f11871f645315f4de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.checkbox','data' => ['id' => 'remember_me','name' => 'remember']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'remember_me','name' => 'remember']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $attributes = $__attributesOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__attributesOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $component = $__componentOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__componentOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
                                        <span class="ms-2 text-sm text-gray-600"><?php echo e(__('Remember me')); ?></span>
                                    </label>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="forgot-password-link"
                                        href="<?php echo e(route('forgot-password.create')); ?>">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>

                            <!-- Error messages -->
                            <div class="d-flex flex-row align-items-center mt-2">
                                <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Login button -->
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="btn btn-lg btn-primary btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/auth/login.blade.php ENDPATH**/ ?>