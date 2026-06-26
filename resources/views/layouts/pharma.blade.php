<!DOCTYPE html>
<html>

<head>
    <title>PharmaSmart</title>
</head>

<body>

    <div style="display:flex;">

        <!-- Sidebar -->
        <div style="width:200px; background:#eee; height:100vh;">
            <h3>PharmaSmart</h3>
            <ul>
                <li>Dashboard</li>
                <li>Categories</li>
                <li>Products</li>
                <li>Sales</li>
                <li>Purchases</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div style="flex:1; padding:20px;">

            @yield('content')

        </div>

    </div>

</body>

</html>
