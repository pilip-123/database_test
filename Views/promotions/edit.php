<!DOCTYPE html>
<html>

<head>
    <title>Edit Promotion - Shop Control</title>
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
    input[type="number"],
    input[type="date"],
    select {
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
        <h2>Edit Promotion</h2>
        <form method="POST" action="index.php?controller=promotion&action=edit">
            <input type="hidden" name="id" value="<?php echo $promotion->id; ?>">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo $promotion->title; ?>" required>
            </div>
            <div class="form-group">
                <label>Discount Percent:</label>
                <input type="number" name="discount_percent" value="<?php echo $promotion->discount_percent; ?>" min="0"
                    max="100" required>
            </div>
            <div class="form-group">
                <label>Start Date:</label>
                <input type="date" name="start_date" value="<?php echo $promotion->start_date; ?>" required>
            </div>
            <div class="form-group">
                <label>End Date:</label>
                <input type="date" name="end_date" value="<?php echo $promotion->end_date; ?>" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                    <option value="1" <?php echo ($promotion->status == 1) ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?php echo ($promotion->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-submit">Update Promotion</button>
                <a href="index.php?controller=promotion&action=index" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>