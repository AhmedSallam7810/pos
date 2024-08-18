<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/ionicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/skin-blue.min.css')); ?>">

    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/font-awesome-rtl.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/AdminLTE-rtl.min.css')); ?>">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/bootstrap-rtl.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/rtl.css')); ?>">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    <?php else: ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/css/AdminLTE.min.css')); ?>">
    <?php endif; ?>

    <style>
        .mr-2{
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
    
    <script src="<?php echo e(asset('dashboard_files/js/jquery.min.js')); ?>"></script>

    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('dashboard_files/plugins/noty/noty.min.js')); ?>"></script>

    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/plugins/morris/morris.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard_files/plugins/icheck/all.css')); ?>">

    
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
   
<div class="wrapper">
 
    <header class="main-header">
      

        
        <a href="<?php echo e(asset('dashboard')); ?>/index2.html" class="logo">
            
            <span class="logo-mini"><b>A</b>LT</span>
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    
                    

                    
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                
                                <ul class="menu">
                                    <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a rel="alternate" hreflang="<?php echo e($localeCode); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                                                <?php echo e($properties['native']); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo e(asset('uploads/user_images/'.auth()->user()->image)); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></span>
                        </a>
                        <ul class="dropdown-menu">

                            
                            <li class="user-header">
                                <img src="<?php echo e(asset('uploads/user_images/'.auth()->user()->image)); ?>" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                                    <small>Member since 2 days</small>
                                </p>
                            </li>

                            
                            <li class="user-footer">


                                <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><?php echo app('translator')->get('site.logout'); ?></a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    <?php echo $__env->make('layouts.dashboard._aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('partials._session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016
            <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

</div><!-- end of wrapper -->


<script src="<?php echo e(asset('dashboard_files/js/bootstrap.min.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/plugins/icheck/icheck.min.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/js/fastclick.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/js/adminlte.min.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/plugins/ckeditor/ckeditor.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/js/jquery.number.min.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/js/printThis.js')); ?>"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo e(asset('dashboard_files/plugins/morris/morris.min.js')); ?>"></script>


<script src="<?php echo e(asset('dashboard_files/js/custom/image_preview.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard_files/js/custom/order.js')); ?>"></script>

<script>
    $(document).ready(function () {

        $('.sidebar-menu').tree();

        //icheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //delete
        $('.delete').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "<?php echo app('translator')->get('site.confirm_delete'); ?>",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("<?php echo app('translator')->get('site.yes'); ?>", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("<?php echo app('translator')->get('site.no'); ?>", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

        // // image preview
        // $(".image").change(function () {
        //
        //     if (this.files && this.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function (e) {
        //             $('.image-preview').attr('src', e.target.result);
        //         }
        //
        //         reader.readAsDataURL(this.files[0]);
        //     }
        //
        // });

        CKEDITOR.config.language =  "<?php echo e(app()->getLocale()); ?>";

    });//end of ready
    
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\DELL\Desktop\pos-master\resources\views/layouts/dashboard/app.blade.php ENDPATH**/ ?>