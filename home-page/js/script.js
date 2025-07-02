function shuffleArray(array) {
  for (let i = array.length -1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}

window.addEventListener('DOMContentLoaded', () => {
  const carouselInner = document.getElementById('carousel-inner');
  const items = Array.from(carouselInner.children);

  shuffleArray(items);

  items.forEach(item => item.classList.remove('active'));
  if(items.length > 0) items[0].classList.add('active');

  carouselInner.innerHTML = '';
  items.forEach(item => carouselInner.appendChild(item));
});