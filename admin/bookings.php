<?php
session_start();
include 'connection.php';

// Handle filters
$bus_id_filter = isset($_GET['bus_id']) ? $_GET['bus_id'] : '';
$date_filter = isset($_GET['reserved_at']) ? $_GET['reserved_at'] : '';

// Fetch distinct bus IDs for filter dropdown
$busIds = $pdo->query("SELECT DISTINCT bus_id FROM customers")->fetchAll(PDO::FETCH_COLUMN);

// Prepare query with optional filters
$query = "SELECT * FROM customers WHERE 1";
$params = [];

if ($bus_id_filter !== '') {
    $query .= " AND bus_id = ?";
    $params[] = $bus_id_filter;
}

if ($date_filter !== '') {
    $query .= " AND DATE(reserved_at) = ?";
    $params[] = $date_filter;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">View Bus Booking Details</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="bus_id" class="form-label">Select Bus ID</label>
            <select id="bus_id" name="bus_id" class="form-select">
                <option value="">All Buses</option>
                <?php foreach ($busIds as $id): ?>
                    <option value="<?= htmlspecialchars($id) ?>" <?= $bus_id_filter == $id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($id) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="reserved_at" class="form-label">Reservation Date</label>
            <input type="date" id="reserved_at" name="reserved_at" class="form-control"
                   value="<?= htmlspecialchars($date_filter) ?>">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter Bookings</button>
        </div>
    </form>

    <?php if (count($bookings) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Seat ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Reserved At</th>
                    <th>Bus ID</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td><?= htmlspecialchars($booking['seat_id']) ?></td>
                        <td><?= htmlspecialchars($booking['name']) ?></td>
                        <td><?= htmlspecialchars($booking['email']) ?></td>
                        <td><?= htmlspecialchars($booking['phone']) ?></td>
                        <td><?= htmlspecialchars($booking['reserved_at']) ?></td>
                        <td><?= htmlspecialchars($booking['bus_id']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No bookings found for the selected criteria.</div>
    <?php endif; ?>
</div>
</body>
</html>