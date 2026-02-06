<!DOCTYPE html>
<html>

<head>
    <title>Products - Shop Control</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
        width: 90%;
        margin: 20px auto;
    }

    header {
        background: #333;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-info span {
        font-size: 14px;
    }

    .btn-logout {
        background: #dc3545;
        color: white;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 4px;
    }

    .tittle {
        padding-bottom: 20px;

    }

    .btn {
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-edit {
        background: #28a745;
        color: white;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #333;
        color: white;
    }

    .actions {
        display: flex;
        gap: 5px;
    }

    .menu {
        background: #555;
        padding: 10px;
        margin-bottom: 20px;
    }

    .menu a {
        color: white;
        margin: 0 10px;
        text-decoration: none;
    }
    </style>
</head>

<body>