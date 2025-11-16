document.addEventListener('DOMContentLoaded', function() {
    const scrollLinks = document.querySelectorAll('.scroll-link');

    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            // Pastikan elemen target ada
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                // Scroll halus ke elemen target
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Opsional: Logika untuk membuat header berubah/lebih jelas saat di-scroll
    const header = document.getElementById('main-header');
    const heroSectionHeight = document.getElementById('home').offsetHeight;

    window.addEventListener('scroll', () => {
        if (window.scrollY > heroSectionHeight - header.offsetHeight) {
            // Misalnya: Tambahkan kelas bayangan yang lebih tebal saat di scroll
            header.classList.add('scrolled'); 
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Tambahkan style untuk class 'scrolled' di CSS jika ingin ada perubahan visual
});