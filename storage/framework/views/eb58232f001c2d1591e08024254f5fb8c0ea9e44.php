<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <form action="/threads" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button>Post</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>