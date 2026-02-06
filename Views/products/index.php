<?php
include_once './Views/Layout/header.php'
?>
<header>
    <h1>Shop Control System</h1>
</header>

<div class="container">
    <div class="menu">
        <a href="index.php?controller=product&action=index">Products</a>
        <a href="index.php?controller=promotion&action=index">Promotions</a>
    </div>

    <div class="tittle">
        <h2>Product List</h2>
    </div>
    <a href="index.php?controller=product&action=create" class="btn btn-primary">Add New Product</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th> <!-- Changed from Quantity to Stock -->
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php
        $index = 0 ;
        while($row = $products->fetch(PDO::FETCH_ASSOC)):
            
         ?>
        <tr>
            <td><?php echo $index +1 ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo number_format($row['price'], 2); ?></td>
            <td><?php echo $row['stock']; ?></td> <!-- Changed from quantity to stock -->
            <td><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
            <td class="actions">
                <a href="index.php?controller=product&action=edit&id=<?php echo $row['id']; ?>"
                    class="btn btn-edit">Edit</a>
                <a href="index.php?controller=product&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-delete"
                    onclick="return confirm('Are you sure to delete this card ?')">Delete</a>
            </td>
        </tr>
        <?php $index ++ ;?>
        <?php endwhile; ?>
    </table>
</div>
<?php include_once './Views/Layout/footer.php'?>