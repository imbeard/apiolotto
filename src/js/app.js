import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import { animate,stagger,timeline } from "motion"
import smoothscroll from 'smoothscroll-polyfill';
import {Curtains, Plane} from 'curtainsjs'; 
import Swiper, { Navigation, Pagination,EffectFade } from 'swiper';
Swiper.use([Navigation, Pagination,EffectFade]);
 
import 'swiper/swiper-bundle.css';


window.Alpine = Alpine
window.swiper = Swiper
window.animate = animate
window.stagger = stagger
window.timeline = timeline
window.Curtains = Curtains
window.Plane = Plane

Alpine.start()
Alpine.plugin(collapse)
smoothscroll.polyfill();

document.addEventListener('DOMContentLoaded', function (event) {
  const cursor = document.querySelector('.custom-cursor')
  const links = document.querySelectorAll('a')
  let initCursor = false

  for (let i = 0; i < links.length; i++) {
    const selfLink = links[i]

    selfLink.addEventListener('mouseover', function () {
      cursor.classList.add('custom-cursor--link')
    })
    selfLink.addEventListener('mouseout', function () {
      cursor.classList.remove('custom-cursor--link')
    })
  }

  window.onmousemove = function (e) {
    const mouseX = e.clientX
    const mouseY = e.clientY

    if (!initCursor) {
      animate(cursor,{ opacity: 1 })
      initCursor = true
    }

    animate(cursor,{ top: mouseY + 'px',left:mouseX + 'px' },{ duration: 0 })
  }

  window.onmouseout = function (e) {
    animate(cursor,{ opacity: 0 },{ duration: 0.3 })
    initCursor = false
  }

    if(window.location.hash){
          var hash = window.location.hash.substring( 1 );
          if ( !hash )
              return;

          var element = document.getElementById('archives');
          var headerOffset = document.querySelector('header').clientHeight;
          var elementPosition = element.getBoundingClientRect().top;
          var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        
          window.scrollTo({
               top: offsetPosition,
               behavior: "smooth"
          });    
       }

})


//svg conversion
const convertImages = (query, callback) => {
  const images = document.querySelectorAll(query);
  if (images){
   images.forEach(image => {
    fetch(image.src)
    .then(res => res.text())
    .then(data => {
      const parser = new DOMParser();
      const svg = parser.parseFromString(data, 'image/svg+xml').querySelector('svg');

      if (image.id) svg.id = image.id;
      if (image.className) svg.classList = image.classList;

      image.parentNode.replaceChild(svg, image);
    })
    .then(callback)
    .catch(error => console.error(error))
  });   
  }

}

convertImages('img.svg');