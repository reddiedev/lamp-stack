window.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const id = entry.target.getAttribute('id');
            const controller = document.getElementById(`${id}-controller`);
            if (controller) {
                if (entry.isIntersecting)
                    controller.classList.add("active");
                else
                    controller.classList.remove("active");
            }
        });
    });

    // Track all h tags that have class 'header'
    document.querySelectorAll('.section-group').forEach((header) => {
        observer.observe(header);
    });

});