<?php $__env->startSection('contenido'); ?>

        <h1>Baja de un producto</h1>

        <article class="card border-danger py-3 col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <img src="/imagenes/productos/<?php echo e($producto->prdImagen); ?>" class="img-thumbnail">
                </div>
                <div class="col text-danger">
                    <h2><?php echo e($producto->prdNombre); ?></h2>
                    <?php echo e($producto->getMarca->mkNombre); ?> |
                    <?php echo e($producto->getCategoria->catNombre); ?>

                    <br>
                    $<?php echo e($producto->prdPrecio); ?>

                    <br>

                    <form action="/producto/destroy" method="post">
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>
                        <input type="hidden" name="idProducto"
                               value="<?php echo e($producto->idProducto); ?>">
                        <input type="hidden" name="prdNombre"
                               value="<?php echo e($producto->prdNombre); ?>">
                        <button class="btn btn-danger btn-block my-3">
                            Confirmar baja
                        </button>
                        <a href="/productos" class="btn btn-outline-secondary btn-block">
                            Volver a panel
                        </a>

                    </form>

                </div>
            </div>
        </article>

        <script>
           /* Swal.fire(
                'Advertencia',
                'Si pulsa el botón "Confirmar baja", se eliminará el producto.',
                'warning'
            )*/
        </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/marcos/Documents/Cursos/Laravel/laravel-62842/catalogo/resources/views/productoDelete.blade.php ENDPATH**/ ?>