document.addEventListener("DOMContentLoaded", function () {
    const accordions = document.querySelectorAll('.mobile-accordion');

    function slideUp(element) {
        const height = element.offsetHeight;
        const step = height / 10; // Adjust speed of sliding
        let currentHeight = height;

        function animate() {
            currentHeight -= step;
            if (currentHeight <= 0) {
                element.style.height = '';
                element.style.display = 'none';
                element.style.overflow = '';
            } else {
                element.style.height = currentHeight + 'px';
                requestAnimationFrame(animate);
            }
        }
        animate();
    }

    function slideDown(element) {
        element.style.display = 'block';
        element.style.overflow = 'hidden';
        const height = element.scrollHeight;
        let currentHeight = 0;
        const step = height / 10; // Adjust speed of sliding

        function animate() {
            currentHeight += step;
            if (currentHeight >= height) {
                element.style.height = '';
                element.style.overflow = '';
            } else {
                element.style.height = currentHeight + 'px';
                requestAnimationFrame(animate);
            }
        }
        animate();
    }

    accordions.forEach(function (accordion) {
        accordion.addEventListener('click', function () {
            accordions.forEach(function (otherAccordion) {
                if (otherAccordion !== accordion) {
                    otherAccordion.classList.remove('active');
                    const content = otherAccordion.nextElementSibling;
                    if (content.style.display === 'block') {
                        slideUp(content);
                    }
                }
            });

            const content = this.nextElementSibling;
            this.classList.toggle('active');
            if (content.style.display === 'block') {
                slideUp(content);
            } else {
                slideDown(content);
            }
        });
    });
});
