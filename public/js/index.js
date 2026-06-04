
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
const now = new Date();
let calYear = now.getFullYear();
let calMonth = now.getMonth();

function renderCalendar() {
  const grid = document.getElementById('calGrid');
  const label = document.getElementById('calMonth');
  if (!grid || !label) return;

  // Use window.bookedCalendar directly so it picks up injected data
  const bookedCalendar = window.bookedCalendar || {};

  label.textContent = months[calMonth] + ' ' + calYear;
  grid.innerHTML = '';
  const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
  days.forEach(d => {
    const el = document.createElement('div');
    el.className = 'cal-day-label';
    el.textContent = d;
    grid.appendChild(el);
  });
  
  const firstDay = new Date(calYear, calMonth, 1).getDay();
  const totalDays = new Date(calYear, calMonth + 1, 0).getDate();
  const today = new Date();
  const monthIndex = calMonth + 1; // 1-based month for lookup
  
  // Add empty cells for days before the first day of the month
  for (let i = 0; i < firstDay; i++) {
    const el = document.createElement('div');
    el.className = 'cal-day empty';
    grid.appendChild(el);
  }
  
  // Add day cells
  for (let d = 1; d <= totalDays; d++) {
    const dayCell = document.createElement('div');
    dayCell.className = 'cal-day';
    dayCell.textContent = d;
    
    let isToday = d === today.getDate() && calMonth === today.getMonth() && calYear === today.getFullYear();
    if (isToday) dayCell.classList.add('today');
    
    // Check if there are any bookings for this day
    const dayBookings = bookedCalendar[monthIndex] && bookedCalendar[monthIndex][d] ? bookedCalendar[monthIndex][d] : [];
    
    if (dayBookings.length > 0) {
      dayCell.classList.add('has-bookings');
      
      // Create service indicators
      const indicatorsContainer = document.createElement('div');
      indicatorsContainer.className = 'service-indicators';
      
      dayBookings.forEach((booking, idx) => {
        const indicator = document.createElement('div');
        indicator.className = 'service-indicator';
        indicator.style.backgroundColor = booking.color;
        indicator.title = booking.name + ' - ' + (booking.status === 'maintenance' ? 'Maintenance' : 'Booked');
        indicatorsContainer.appendChild(indicator);
      });
      
      dayCell.appendChild(indicatorsContainer);
    } else {
      dayCell.classList.add('available');
    }
    
    grid.appendChild(dayCell);
  }
}

function changeMonth(dir) {
  calMonth += dir;
  if (calMonth < 0) {
    calMonth = 11;
    calYear--;
  }
  if (calMonth > 11) {
    calMonth = 0;
    calYear++;
  }
  renderCalendar();
}

// Initial render
renderCalendar();

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
  const highlightSlider = document.getElementById('highlightSlider');
  if (highlightSlider) {
    const highlightSlides = highlightSlider.querySelectorAll('.highlight-slide');
    const highlightHero = highlightSlider.closest('.highlight-hero');
    const highlightDots = highlightHero ? highlightHero.querySelectorAll('.highlight-dot') : document.querySelectorAll('.highlight-dot');
    const highlightNext = highlightSlider.querySelector('.highlight-next');
    const highlightPrev = highlightSlider.querySelector('.highlight-prev');
    let highlightIndex = Array.from(highlightSlides).findIndex(slide => slide.classList.contains('active'));
    if (highlightIndex < 0) {
      highlightIndex = 0;
    }
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
      if (highlightSlides.length <= 1) return;
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
      setHighlightSlide(highlightIndex);
      startHighlightAutoplay();
    }
  }

  const promoModal = document.getElementById('promoPopup');
  if (promoModal) {
    const promoClose = document.getElementById('promoPopupClose');
    setTimeout(() => promoModal.classList.add('active'), 150);

    promoClose?.addEventListener('click', (event) => {
      event.stopPropagation();
      promoModal.classList.remove('active');
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

