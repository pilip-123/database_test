<?php
// Use correct path - models folder (plural)
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    
    public function index() {
        $product = new Product();
        $products = $product->read();
        require_once __DIR__ . '/../views/products/index.php';
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = new Product();
            
            $product->name = $_POST['name'] ?? '';
            $product->price = $_POST['price'] ?? 0;
            $product->stock = $_POST['stock'] ?? 0;

            if($product->create()) {
                header("Location: index.php?controller=product&action=index");
                exit();
            } else {
                echo "Error creating product.";
            }
        } else {
            require_once __DIR__ . '/../views/products/create.php';
        }
    }

    public function edit() {
        $product = new Product();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product->id = $_POST['id'] ?? 0;
            $product->name = $_POST['name'] ?? '';
            $product->price = $_POST['price'] ?? 0;
            $product->stock = $_POST['stock'] ?? 0;

            if($product->update()) {
                header("Location: index.php?controller=product&action=index");
                exit();
            } else {
                echo "Error updating product.";
            }
        } else {
            $id = $_GET['id'] ?? 0;
            if($id > 0) {
                $product->id = $id;
                $product->readOne();
                require_once __DIR__ . '/../views/products/edit.php';
            } else {
                header("Location: index.php?controller=product&action=index");
                exit();
            }
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if($id > 0) {
            $product = new Product();
            $product->id = $id;
            
            if($product->delete()) {
                header("Location: index.php?controller=product&action=index");
                exit();
            } else {
                echo "Error deleting product.";
            }
        }
    }
}
?>