<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/TBOHolidays_HotelAPI/HotelSearch') ? 'active' : ''; ?>" aria-current="page" href="/TBOHolidays_HotelAPI/HotelSearch">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/TBOHolidays_HotelAPI/confirmBookingList') ? 'active' : ''; ?>" href="/confirmBookingList">Confirmation Numbers</a>
        </li>
    </ul>
</nav>