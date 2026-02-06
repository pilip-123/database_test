<!DOCTYPE html>
<html>

<head>
    <title>Edit Product - Shop Control</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
    }

    h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit {
        background: #28a745;
        color: white;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        text-decoration: none;
        display: inline-block;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" action="index.php?controller=product&action=edit">
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $product->name; ?>" required>
            </div>
            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="price" step="0.01" value="<?php echo $product->price; ?>" required>
            </div>
            <div class="form-group">
                <label>Stock:</label> <!-- Changed from Quantity to Stock -->
                <input type="number" name="stock" value="<?php echo $product->stock; ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-submit">Update Product</button>
                <a href="index.php?controller=product&action=index" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>