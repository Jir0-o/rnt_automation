<?php $__env->startSection('content'); ?>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                                    class="img-fluid" alt="Sample image">

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <?php if(session('status')): ?>
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    <?php echo e(session('status')); ?>

                                </div>
                                <?php endif; ?>

                                <?php if(Session::has('success')): ?>
                                <p class="alert alert-success"><?php echo e(Session::get('success')); ?></p>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <div class="divider d-flex align-items-center my-4">
                                        <h5 class="text-center fw-bold mx-3 mb-0">Login</h5>
                                    </div>

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
                                        <input id="password" class="block mt-1 w-full" type="password" name="password"
                                            required autocomplete="current-password"
                                            placeholder="Enter a your password" />
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Checkbox -->
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
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="<?php echo e(route('forgot-password.create')); ?>">
                                                Forgot your password?
                                            </a>
                                        </div>
                                    </div>
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
        </div>
    </div>
    <?php echo $__env->make('backend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\Procurement_final\resources\views/auth/login.blade.php ENDPATH**/ ?>