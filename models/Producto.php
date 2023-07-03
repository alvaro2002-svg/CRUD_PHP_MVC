<?php

class Producto extends Conectar
{
    ## Obtener todos los productos
    public function get_producto()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_productos WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    ## Obtener el producto segun el ID
    public function get_producto_x_id($prod_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_productos WHERE prod_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $prod_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    ## Eliminar un producto
    public function delete_producto($prod_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_producto 
            SET 
                est = 0, 
                fech_elim = now()
            WHERE
                prod_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $prod_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    ## Insertar un producto
    public function insert_producto($prod_nom)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_producto (prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, now(), NULL, NULL, 1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $prod_nom);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    ## Actualizar un producto
    public function update_producto($prod_id, $prod_nom)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_producto 
            SET 
                prod_nom = ?, 
                fech_mod = now()
            WHERE
                prod_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $prod_nom);
        $sql->bindValue(2, $prod_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
