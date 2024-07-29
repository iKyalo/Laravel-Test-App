<footer class="py-4 bg-dark mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-center small">
            <div class="text-muted">Copyright &copy; <span id="year"></span>. All rights reserved.</div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
    $('.carousel').carousel({
        interval: 2000
    });
</script>
