<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.users'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li><a href="<?php echo e(route('dashboard.users.index')); ?>"> <?php echo app('translator')->get('site.users'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.edit'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?php echo app('translator')->get('site.edit'); ?></h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <?php echo $__env->make('partials._errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="<?php echo e(route('dashboard.users.update', $user->id)); ?>" method="post" enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.first_name'); ?></label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo e($user->first_name); ?>">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.last_name'); ?></label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo e($user->last_name); ?>">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.email'); ?></label>
                            <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.image'); ?></label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="<?php echo e(asset('uploads/user_images/'.$user->image)); ?>" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.permissions'); ?></label>
                            <div class="nav-tabs-custom">

                                <?php
                                    $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                ?>

                                <ul class="nav nav-tabs">
                                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e($index == 0 ? 'active' : ''); ?>"><a href="#<?php echo e($model); ?>" data-toggle="tab"><?php echo app('translator')->get('site.' . $model); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                                <div class="tab-content">

                                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="tab-pane <?php echo e($index == 0 ? 'active' : ''); ?>" id="<?php echo e($model); ?>">

                                            <?php $__currentLoopData = $maps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $map): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <label><input type="checkbox" name="permissions[]" <?php echo e($user->hasPermission($map . '_' . $model) ? 'checked' : ''); ?> value="<?php echo e($map . '_' . $model); ?>"> <?php echo app('translator')->get('site.' . $map); ?></label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div><!-- end of tab content -->

                            </div><!-- end of nav tabs -->

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/users/edit.blade.php ENDPATH**/ ?>