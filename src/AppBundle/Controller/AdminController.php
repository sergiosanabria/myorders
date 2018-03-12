<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 08/03/18
 * Time: 15:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Producto;
use AppBundle\Entity\ProductoPrecio;
use AppBundle\Entity\ProductoStock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    public function persistProductoEntity(Producto $producto)
    {

        if ($producto->getId()){
            parent::persistEntity();
            return;
        }

        $precioVenta = new ProductoPrecio();

        $precioVenta->setPrecio($producto->getPrecioVenta());
        $precioVenta->setPrecioTipo(ProductoPrecio::$tipoPrecioVenta);
        $precioVenta->setProducto($producto);

        $precioCosto = new ProductoPrecio();

        $precioCosto->setPrecio($producto->getPrecioVenta());
        $precioCosto->setPrecioTipo(ProductoPrecio::$tipoPrecioCosto);
        $precioCosto->setProducto($producto);

        $cantidad = new ProductoStock();

        $cantidad->setCantidad($producto->getCantidad());
        $cantidad->setProducto($producto);

        $producto->addPrecio($precioVenta);
        $producto->addPrecio($precioCosto);
        $producto->addStock($cantidad);

        parent::persistEntity($producto);
    }

    public function persistProductoPrecioEntity(ProductoPrecio $productoPrecio)
    {


        if ($productoPrecio->getPrecioTipo() == ProductoPrecio::$tipoPrecioCosto){
            $productoPrecio->getProducto()->setPrecioCosto($productoPrecio->getPrecio());
        }

        if ($productoPrecio->getPrecioTipo() == ProductoPrecio::$tipoPrecioVenta){
            $productoPrecio->getProducto()->setPrecioVenta($productoPrecio->getPrecio());
        }

        parent::persistEntity($productoPrecio);
    }

    public function persistProductoStockEntity(ProductoStock $productoStock)
    {

        $productoStock->getProducto()->setCantidad($productoStock->getCantidad());

        parent::persistEntity($productoStock);
    }
}