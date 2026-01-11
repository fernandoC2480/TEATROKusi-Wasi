document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.swiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',

        coverflowEffect: {
            rotate: 45,
            stretch: 0,
            depth: 300,
            modifier: 1,
            slideShadows: true,
        },

        spaceBetween: 60,
        loop: true,

        // start with manual touch/drag disabled
        allowTouchMove: false,

        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
        },
    });

    // Allow manual change (drag) only when cursor is inside a card
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            try { swiper.allowTouchMove = true; } catch (e) {}
        });
        card.addEventListener('mouseleave', () => {
            try { swiper.allowTouchMove = false; } catch (e) {}
        });
        // also enable on focus for accessibility
        card.addEventListener('focusin', () => { try { swiper.allowTouchMove = true; } catch (e) {} });
        card.addEventListener('focusout', () => { try { swiper.allowTouchMove = false; } catch (e) {} });
    });
});
