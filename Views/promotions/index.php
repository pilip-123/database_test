<?php include_once './Views/Layout/header.php'?>

<header>
    <h1>Shop Control System</h1>
</header>

<div class="container">
    <div class="menu">
        <a href="index.php?controller=product&action=index">Products</a>
        <a href="index.php?controller=promotion&action=index">Promotions</a>
    </div>

    <div class="tittle">
        <h2>Promotion List</h2>
    </div>
    <a href="index.php?controller=promotion&action=create" class="btn btn-primary">Add New Promotion</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Discount %</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php 
        $index = 0 ;
        while($row = $promotions->fetch(PDO::FETCH_ASSOC)): 
        ?>
        <tr>
            <td><?php echo $index +1 ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['discount_percent']; ?>%</td>
            <td><?php echo date('Y-m-d', strtotime($row['start_date'])); ?></td>
            <td><?php echo date('Y-m-d', strtotime($row['end_date'])); ?></td>
            <td class="<?php echo ($row['status'] == 1) ? 'status-active' : 'status-inactive'; ?>">
                <?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?>
            </td>
            <td><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
            <td class="actions">
                <a href="index.php?controller=promotion&action=edit&id=<?php echo $row['id']; ?>"
                    class="btn btn-edit">Edit</a>
                <a href="index.php?controller=promotion&action=delete&id=<?php echo $row['id']; ?>"
                    class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php $index ++ ;?>
        <?php endwhile; ?>
    </table>
</div>
<?php include_once './Views/Layout/footer.php'?>