<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.dashboard'); ?></h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo e($categories_count); ?></h3>

                            <p><?php echo app('translator')->get('site.categories'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo e(route('dashboard.categories.index')); ?>" class="small-box-footer"><?php echo app('translator')->get('site.read'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo e($products_count); ?></h3>

                            <p><?php echo app('translator')->get('site.products'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo e(route('dashboard.products.index')); ?>" class="small-box-footer"><?php echo app('translator')->get('site.read'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo e($clients_count); ?></h3>

                            <p><?php echo app('translator')->get('site.clients'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="<?php echo e(route('dashboard.clients.index')); ?>" class="small-box-footer"><?php echo app('translator')->get('site.read'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo e($users_count); ?></h3>

                            <p><?php echo app('translator')->get('site.users'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?php echo e(route('dashboard.users.index')); ?>" class="small-box-footer"><?php echo app('translator')->get('site.read'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div><!-- end of row -->

            <div class="box box-solid">

                <div class="box-header">
                    <h3 class="box-title">Sales Graph</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                <?php $__currentLoopData = $sales_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    ym: "<?php echo e($data->year); ?>-<?php echo e($data->month); ?>", sum: "<?php echo e($data->sum); ?>"
                },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['<?php echo app('translator')->get('site.total'); ?>'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10
        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/index.blade.php ENDPATH**/ ?>