let items = document.querySelectorAll('.top-rated .carousel .carousel-item');

for (var item = 0; item < items.length - 3; item++){
    const minPerSlide = 4
    let next = items[item].nextElementSibling;
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = items[0];

        }
        let cloneChild = next.cloneNode(true)
        items[item].appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
}

for (var item = items.length - 3; item < items.length; item++){
    items[item].remove();
}