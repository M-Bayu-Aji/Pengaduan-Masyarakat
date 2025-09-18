<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title><?php echo e($title); ?></title>
</head>

<body class="bg-orange-500">
    <main class="flex flex-col items-center justify-center min-h-screen md:flex-row">
        <!-- Left Content Section -->
        <?php echo $__env->yieldContent('content'); ?>

        <!-- Right Image Section -->
        <?php if(!Route::is('report.create')): ?>
            <div class="relative w-full h-screen overflow-hidden bg-white shadow-2xl">
                <img class="object-cover w-full h-full transition-opacity duration-300 opacity-50 hover:opacity-40"
                    src="https://storage.googleapis.com/a1aa/image/skXnOaDgJjaqNF4LFgCdrTqP6XM9xoIpldFy9g2qfSwu9f5TA.jpg"
                    alt="Aerial view of a city street" />
        <?php endif; ?>
        <?php if(Route::is('proses.login')): ?>
            <div class="absolute inset-0 flex items-center justify-center backdrop-blur-sm">
                <h1 class="px-10 py-6 text-4xl font-bold text-orange-500 shadow-2xl bg-white/80 rounded-xl">
                    Please Login First!
                </h1>
            </div>
        <?php elseif(Route::is('proses.register')): ?>
            <div class="absolute inset-0 flex items-center justify-center backdrop-blur-sm">
                <h1 class="px-10 py-6 text-4xl font-bold text-orange-500 shadow-2xl bg-white/80 rounded-xl">
                    Form Register
                </h1>
            </div>
        <?php endif; ?>
        </div>
    </main>
    <?php echo $__env->yieldPushContent('script'); ?>
</body>

</html>
<?php /**PATH C:\Laravel\Project\pengaduan-masyarakat\resources\views/templates/app.blade.php ENDPATH**/ ?>