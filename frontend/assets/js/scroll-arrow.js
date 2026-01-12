(function(){
    const arrow = document.getElementById('scrollArrow');
    if(!arrow) return;

    const showAfter = 200; // px scrolled before showing

    function checkScroll(){
        const y = window.scrollY || window.pageYOffset;
        if(y > showAfter){
            arrow.classList.add('show');
        } else {
            arrow.classList.remove('show');
        }
    }

    window.addEventListener('scroll', checkScroll, {passive:true});
    window.addEventListener('resize', checkScroll);
    document.addEventListener('DOMContentLoaded', checkScroll);

    // Sólo sube cuando el usuario hace click en la flecha
    arrow.addEventListener('click', function(){
        window.scrollTo({top:0, behavior:'smooth'});
    });
})();