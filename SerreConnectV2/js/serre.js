document.querySelectorAll('.circle').forEach((circle) => {
    const value = circle.getAttribute('data-value');
    const half = circle.querySelector('.mask.half .fill');
    if (value <= 50) {
        const rotateValue = 3.6 * value;
        half.style.transform = `rotate(${rotateValue}deg)`;
    } else {
        const full = circle.querySelector('.mask.full .fill');
        full.style.transform = `rotate(180deg)`;
        const rotateValue = 3.6 * (value - 50);
        half.style.transform = `rotate(${rotateValue}deg)`;
    }
});
