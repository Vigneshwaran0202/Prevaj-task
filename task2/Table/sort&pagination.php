<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define sorting and pagination parameters
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

// Fetch total number of items
$result = $conn->query("SELECT COUNT(*) AS count FROM Users");
$total_items = $result->fetch_assoc()['count'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch data with sorting and pagination
$sql = "SELECT * FROM Users ORDER BY $sort_column $sort_order LIMIT $offset, $items_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sortable and Paginated Table</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { cursor: pointer; }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th><a href="?sort=id&order=<?php echo $sort_order === 'ASC' ? 'desc' : 'asc'; ?>">ID</a></th>
            <th><a href="?sort=username&order=<?php echo $sort_order === 'ASC' ? 'desc' : 'asc'; ?>">Username</a></th>
            <th><a href="?sort=email&order=<?php echo $sort_order === 'ASC' ? 'desc' : 'asc'; ?>">Email</a></th>
            <th><a href="?sort=created_at&order=<?php echo $sort_order === 'ASC' ? 'desc' : 'asc'; ?>">Created At</a></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div>
    <?php if ($page > 1) : ?>
        <a href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort_column; ?>&order=<?php echo $sort_order; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <a href="?page=<?php echo $i; ?>&sort=<?php echo $sort_column; ?>&order=<?php echo $sort_order; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages) : ?>
        <a href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort_column; ?>&order=<?php echo $sort_order; ?>">Next</a>
    <?php endif; ?>
</div>

</body>
</html>
