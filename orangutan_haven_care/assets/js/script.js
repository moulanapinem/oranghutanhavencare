    window.addEventListener("load", function(){
        const loader = document.getElementById("loader");

        setTimeout(function(){
            loader.classList.add("hide");
        }, 2000);
    });

    // Loader
window.addEventListener("load", function(){
    const loader = document.getElementById("loader");
    if(loader){
        setTimeout(function(){
            loader.classList.add("hide");
        }, 2000);
    }
});
 
// Hamburger menu mobile
const hamburger = document.getElementById('hamburger');
const navLinks  = document.querySelector('.nav-links');
 
if(hamburger && navLinks){
    hamburger.addEventListener('click', function(){
        navLinks.classList.toggle('open');
    });
 
    // Tutup menu kalau klik link
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => navLinks.classList.remove('open'));
    });
 
    // Tutup menu kalau klik di luar
    document.addEventListener('click', function(e){
        if(!hamburger.contains(e.target) && !navLinks.contains(e.target)){
            navLinks.classList.remove('open');
        }
    });
}
 