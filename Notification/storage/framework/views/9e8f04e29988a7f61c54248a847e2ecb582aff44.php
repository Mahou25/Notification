<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
        <a href="" class="navbar-brand"><?php echo e(Str::ucfirst(Auth::user()->fname)); ?></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item px-2">
                    <a href="" class="nav-link active">Dashboard</a>
                </li>
            </ul>


            <ul class="navbar-nav mr-auto">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li class="nav-item dropdown mr-2" id="<?php echo e($key->id); ?>">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell text-white">
                            <?php if($key->unread): ?>
                            <span class="badge badge-danger pending"><?php echo e($key->unread); ?></span>
                            <?php endif; ?>
                        </i>
                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo e(route('logout')); ?>" class="nav-link"><i class="fas fa-user-times"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav> <?php /**PATH C:\laragon\www\user-auth-complete-laravel-module\resources\views/layouts/inc/nav.blade.php ENDPATH**/ ?>