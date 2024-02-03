<style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            right: -250px; /* Start off-screen */
            top: 0;
            z-index: 100;
            background-color: #f8f9fa;
            padding: 20px;
            transition: left 0.3s; /* Smooth transition for toggling */
        }
        .sidebar-link {
            padding: 10px 15px;
            font-size: 16px;
            color: #333;
            display: block;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .fixed-top-right {
            position: fixed;
            top: 10px; /* Adjust the value as needed */
            right: 10px; /* Adjust the value as needed */
            z-index: 1050; /* Ensure it's above most other elements */
        }
</style>


<button class="btn btn-primary fixed-top-right" id="toggleSidebar">Menu</button>


<div class="sidebar" id="sidebar">
    <h4>Menu</h4>
    <a href="add_product.php" class="sidebar-link">Tambahkan Produk</a>
    <a href="list_product.php" class="sidebar-link">Daftar Produk</a>
    <a href="list_customer.php" class="sidebar-link">Daftar Pelanggan</a>
    <a href="list_transaction.php" class="sidebar-link">Daftar Transaksi</a>
    <a href="logout.php" class="sidebar-link">Log Out</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMneT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
document.getElementById('toggleSidebar').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    if (sidebar.style.right === '-250px') {
        sidebar.style.right = '0';
    } else {
        sidebar.style.right = '-250px';
    }
});
</script>
