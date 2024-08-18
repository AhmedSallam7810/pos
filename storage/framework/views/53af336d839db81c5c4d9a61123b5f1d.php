<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.users'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.users'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><?php echo app('translator')->get('site.users'); ?> <small><?php echo e($users->total()); ?></small></h3>

                    <form action="<?php echo e(route('dashboard.users.index')); ?>" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('site.search'); ?>" value="<?php echo e(request()->search); ?>">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo app('translator')->get('site.search'); ?></button>
                                <?php if(auth()->user()->hasPermission('create_users')): ?>
                                    <a href="<?php echo e(route('dashboard.users.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    <?php if($users->count() > 0): ?>

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->get('site.first_name'); ?></th>
                                <th><?php echo app('translator')->get('site.last_name'); ?></th>
                                <th><?php echo app('translator')->get('site.email'); ?></th>
                                <th><?php echo app('translator')->get('site.image'); ?></th>
                                <th><?php echo app('translator')->get('site.action'); ?></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($user->first_name); ?></td>
                                    <td><?php echo e($user->last_name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><img src="<?php echo e(asset('uploads/user_images/'.$user->image)); ?>" style="width: 100px;" class="img-thumbnail" alt=""></td>
                                    <td>
                                        <?php if(auth()->user()->hasPermission('update_users')): ?>
                                            <a href="<?php echo e(route('dashboard.users.edit', $user->id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermission('delete_users')): ?>
                                            <form action="<?php echo e(route('dashboard.users.destroy', $user->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></button>
                                            </form><!-- end of form -->
                                        <?php else: ?>
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table><!-- end of table -->
                        
                        <?php echo e($users->appends(request()->query())->links()); ?>

                        
                    <?php else: ?>
                        
                        <h2>'site.no_data_found'</h2>
                        
                    <?php endif; ?>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos-master\resources\views/dashboard/users/index.blade.php ENDPATH**/ ?>