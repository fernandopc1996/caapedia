function startInactivityWatcher() {
    let timer;
    let hasReloaded = false;

    function resetTimer() {
        if (hasReloaded) return;
        clearTimeout(timer);
        timer = setTimeout(() => {
            hasReloaded = true;
            alert("Você ficou inativo. Precisamos recarregar para ver se está tudo certo!");
            window.location.reload();
        }, 300000); // 5 minutos
    }

    window.addEventListener('load', resetTimer);
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keydown', resetTimer);
    document.addEventListener('click', resetTimer);
    document.addEventListener('scroll', resetTimer);
    document.addEventListener('touchstart', resetTimer);
}

startInactivityWatcher();
