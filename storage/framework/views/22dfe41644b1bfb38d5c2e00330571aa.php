<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.clients'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li><a href="<?php echo e(route('dashboard.clients.index')); ?>"> <?php echo app('translator')->get('site.clients'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.add'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?php echo app('translator')->get('site.add'); ?></h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <?php echo $__env->make('partials._errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="<?php echo e(route('dashboard.clients.store')); ?>" method="post" enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('post'); ?>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.name'); ?></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                        </div>


                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.phone'); ?></label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" required>
                        </div>


                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.address'); ?></label>
                            <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>" required>
                        </div>


                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/clients/create.blade.php ENDPATH**/ ?>