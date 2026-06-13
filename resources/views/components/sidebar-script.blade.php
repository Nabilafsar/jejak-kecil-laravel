<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const STORAGE_KEY = 'jejakkecil_sidebar_state';

        // Restore state dari localStorage
        const savedState = localStorage.getItem(STORAGE_KEY);
        if (savedState === 'collapsed') {
            sidebar.classList.remove('sidebar--expanded');
            sidebar.classList.add('sidebar--collapsed');
        }

        toggleBtn.addEventListener('click', function () {
            const isExpanded = sidebar.classList.contains('sidebar--expanded');

            if (isExpanded) {
                sidebar.classList.remove('sidebar--expanded');
                sidebar.classList.add('sidebar--collapsed');
                localStorage.setItem(STORAGE_KEY, 'collapsed');
            } else {
                sidebar.classList.remove('sidebar--collapsed');
                sidebar.classList.add('sidebar--expanded');
                localStorage.setItem(STORAGE_KEY, 'expanded');
            }
        });
    });
</script>