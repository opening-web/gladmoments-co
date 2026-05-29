
const navbar = document.getElementById('navbar');
window.addEventListener('scroll',()=>{
  if(window.scrollY>60)navbar.classList.add('scrolled');
  else navbar.classList.remove('scrolled');
});

let currentTesti=0;
function goTesti(i){
  document.querySelectorAll('.testi-card').forEach((c,idx)=>{
    c.classList.toggle('active',idx===i);
  });
  document.querySelectorAll('.testi-dot').forEach((d,idx)=>{
    d.classList.toggle('active',idx===i);
  });
  currentTesti=i;
}
setInterval(()=>{
  const total = document.querySelectorAll('.testi-card').length;
  if (total <= 1) return;
  let next=(currentTesti+1)%total;
  goTesti(next);
},5000);

function filterPortfolio(btn,cat){
  document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.portfolio-item').forEach(item=>{
    if(cat==='all'||item.dataset.cat===cat){
      item.style.opacity='1';item.style.transform='scale(1)';
    } else {
      item.style.opacity='.25';item.style.transform='scale(0.97)';
    }
  });
}

const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
const bookedDates = window.bookedDates || {
  gladtocall: {},
  gladmoments: {}
};
const now = new Date();
let calYear = { gladtocall: now.getFullYear(), gladmoments: now.getFullYear() };
let calMonth = { gladtocall: now.getMonth(), gladmoments: now.getMonth() };

function renderCalendar(service) {
  const grid = document.getElementById('calGrid-' + service);
  const label = document.getElementById('calMonth-' + service);
  if (!grid || !label) return;

  label.textContent = months[calMonth[service]] + ' ' + calYear[service];
  grid.innerHTML = '';
  const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
  days.forEach(d => {
    const el = document.createElement('div');
    el.className = 'cal-day-label'; el.textContent = d;
    grid.appendChild(el);
  });
  const firstDay = new Date(calYear[service], calMonth[service], 1).getDay();
  const totalDays = new Date(calYear[service], calMonth[service] + 1, 0).getDate();
  const today = new Date();
  const booked = (bookedDates[service] && bookedDates[service][calMonth[service] + 1]) || [];
  for (let i = 0; i < firstDay; i++) {
    const el = document.createElement('div'); el.className = 'cal-day empty'; grid.appendChild(el);
  }
  for (let d = 1; d <= totalDays; d++) {
    const el = document.createElement('div');
    el.textContent = d;
    let cls = 'cal-day';
    if (booked.includes(d)) cls += ' booked';
    else cls += ' available';
    if (d === today.getDate() && calMonth[service] === today.getMonth() && calYear[service] === today.getFullYear()) cls += ' today';
    el.className = cls;
    grid.appendChild(el);
  }
}
function changeMonthService(dir, service) {
  calMonth[service] += dir;
  if (calMonth[service] < 0) { calMonth[service] = 11; calYear[service]--; }
  if (calMonth[service] > 11) { calMonth[service] = 0; calYear[service]++; }
  renderCalendar(service);
}

// Initial render for both services
renderCalendar('gladtocall');
renderCalendar('gladmoments');

// ==========================================================================
// GLOBAL LIQUID-GRADIENT PAGE TRANSITION OVERLAY HANDLER
// ==========================================================================
document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  
  // Slide up curtains to reveal page content
  setTimeout(() => {
    body.classList.add('page-loaded');
  }, 100);

  // Catch local link clicks to trigger exit transition
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    const target = link.getAttribute('target');

    // Ignore anchors, blank targets, email, phone, whatsapp, external sites
    if (
      !href ||
      href.startsWith('#') ||
      href.startsWith('javascript:') ||
      target === '_blank' ||
      href.startsWith('mailto:') ||
      href.startsWith('tel:') ||
      href.includes('wa.me') ||
      href.includes('api.whatsapp.com') ||
      link.hasAttribute('download')
    ) {
      return;
    }

    // Check if it is a local path (starts with / or has current origin)
    const isLocal = href.startsWith('/') || href.startsWith(window.location.origin);
    if (isLocal) {
      e.preventDefault();
      
      // Trigger curtains slide down exit transition
      body.classList.remove('page-loaded');
      body.classList.add('page-leaving');
      
      // Navigate to the target page after the curtain finishes sliding down
      setTimeout(() => {
        window.location.href = href;
      }, 750); // Matches CSS transition duration
    }
  });

  // Highlight slider controls and autoplay
  const highlightSlides = document.querySelectorAll('.highlight-slide');
  const highlightDots = document.querySelectorAll('.highlight-dot');
  const highlightNext = document.querySelector('.highlight-next');
  const highlightPrev = document.querySelector('.highlight-prev');
  let highlightIndex = 0;
  let highlightInterval = null;

  function setHighlightSlide(index) {
    if (!highlightSlides.length) return;
    highlightIndex = (index + highlightSlides.length) % highlightSlides.length;
    highlightSlides.forEach((slide, idx) => {
      slide.classList.toggle('active', idx === highlightIndex);
    });
    highlightDots.forEach((dot, idx) => {
      dot.classList.toggle('active', idx === highlightIndex);
    });
  }

  function startHighlightAutoplay() {
    if (highlightInterval) clearInterval(highlightInterval);
    highlightInterval = setInterval(() => {
      setHighlightSlide(highlightIndex + 1);
    }, 7000);
  }

  if (highlightDots.length) {
    highlightDots.forEach(dot => {
      dot.addEventListener('click', () => {
        setHighlightSlide(Number(dot.dataset.index));
        startHighlightAutoplay();
      });
    });
  }

  if (highlightNext) {
    highlightNext.addEventListener('click', () => {
      setHighlightSlide(highlightIndex + 1);
      startHighlightAutoplay();
    });
  }

  if (highlightPrev) {
    highlightPrev.addEventListener('click', () => {
      setHighlightSlide(highlightIndex - 1);
      startHighlightAutoplay();
    });
  }

  if (highlightSlides.length) {
    startHighlightAutoplay();
  }

  const promoModal = document.getElementById('promoPopup');
  if (promoModal) {
    const promoClose = document.getElementById('promoPopupClose');
    setTimeout(() => promoModal.classList.add('active'), 150);

    promoClose?.addEventListener('click', () => {
      promoModal.classList.remove('active');
    });

    promoModal.addEventListener('click', (event) => {
      if (event.target === promoModal) {
        promoModal.classList.remove('active');
      }
    });
  }
});

// Handle browser Back/Forward Cache page restoration
window.addEventListener('pageshow', (event) => {
  if (event.persisted) {
    document.body.classList.remove('page-leaving');
    document.body.classList.add('page-loaded');
  }
});

