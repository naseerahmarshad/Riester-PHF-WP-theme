// Accordion Script 
document.addEventListener('DOMContentLoaded', function () {
    // Find all accordion titles
    var titles = document.querySelectorAll('.phf-accordion__title');

    titles.forEach(function (title) {
        title.addEventListener('click', function () {
            var content = title.nextElementSibling;

            if (content && content.classList.contains('phf-accordion__content')) {
                // Toggle the "open" class
                content.classList.toggle('open');
            }
        });
    });
});
