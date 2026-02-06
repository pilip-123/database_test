<?php
// Use correct path - models folder (plural)
require_once __DIR__ . '/../models/Promotion.php';

class PromotionController {
    
    public function index() {
        $promotion = new Promotion();
        $promotions = $promotion->read();
        require_once __DIR__ . '/../views/promotions/index.php';
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $promotion = new Promotion();
            
            $promotion->title = $_POST['title'] ?? '';
            $promotion->discount_percent = $_POST['discount_percent'] ?? 0;
            $promotion->start_date = $_POST['start_date'] ?? '';
            $promotion->end_date = $_POST['end_date'] ?? '';
            $promotion->status = $_POST['status'] ?? 0;

            if($promotion->create()) {
                header("Location: index.php?controller=promotion&action=index");
                exit();
            } else {
                echo "Error creating promotion.";
            }
        } else {
            require_once __DIR__ . '/../views/promotions/create.php';
        }
    }

    public function edit() {
        $promotion = new Promotion();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $promotion->id = $_POST['id'] ?? 0;
            $promotion->title = $_POST['title'] ?? '';
            $promotion->discount_percent = $_POST['discount_percent'] ?? 0;
            $promotion->start_date = $_POST['start_date'] ?? '';
            $promotion->end_date = $_POST['end_date'] ?? '';
            $promotion->status = $_POST['status'] ?? 0;

            if($promotion->update()) {
                header("Location: index.php?controller=promotion&action=index");
                exit();
            } else {
                echo "Error updating promotion.";
            }
        } else {
            $id = $_GET['id'] ?? 0;
            if($id > 0) {
                $promotion->id = $id;
                $promotion->readOne();
                require_once __DIR__ . '/../views/promotions/edit.php';
            } else {
                header("Location: index.php?controller=promotion&action=index");
                exit();
            }
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if($id > 0) {
            $promotion = new Promotion();
            $promotion->id = $id;
            
            if($promotion->delete()) {
                header("Location: index.php?controller=promotion&action=index");
                exit();
            } else {
                echo "Error deleting promotion.";
            }
        }
    }
}
?>