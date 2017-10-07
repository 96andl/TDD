<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo e($thread->title); ?></div>

                    <div class="panel-body">
                        <h4><a href=""><?php echo e($thread->creator_name); ?></a></h4>
                        <article>
                            <?php echo e($thread->body); ?>

                        </article>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <?php $__currentLoopData = $thread->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="panel-body">
                            <div class="panel-heading"><?php echo e($reply->owner->name); ?>

                                said <?php echo e($reply->created_at->diffForHumans()); ?></div>
                            <article>
                                <?php echo e($reply->body); ?>

                            </article>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php if(auth()->check()): ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="<?php echo e($thread->path .'/replies'); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <textarea name="body" id="body" placeholder="Have something to say?" class="form-control"></textarea>
                        </div>
                        <button>Post</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Please <a href="<?php echo e(route('login')); ?>">signIn</a> to participate in this discussion</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>