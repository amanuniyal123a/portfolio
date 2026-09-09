/* ============================================================================
   resources/js/portfolio.js

   NOTE ON THIS REFACTOR:
   All markup (navbar, hero, sections, icons, tech pills, etc.) is now
   rendered server-side by Blade components from data supplied by
   PortfolioController. This file therefore no longer contains:
     - mockData
     - the Icons SVG library
     - techMeta / techIconHTML / socialIconHTML
     - renderNavbar() / renderHero() / render*() / sectionRenderers / renderPage()

   Everything else — preloader, cursor, navbar scroll/hide behavior,
   mobile menu, magnetic/tilt micro-interactions, carousel, testimonial
   dots, form handlers, and all GSAP/ScrollTrigger animation logic — is
   preserved unchanged, operating on the exact same IDs/classes/data
   attributes that Blade now renders.
   ============================================================================ */

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
let heroStarted = false;

/* ============================================================================
   HERO INTRO TIMELINE
   ============================================================================ */
function startHero(){
  if(heroStarted) return;
  heroStarted = true;
  const d = reduceMotion ? 0.01 : 1;
  const tl = gsap.timeline({defaults:{ease:'power3.out'}});
  tl.to('.hero-greeting', {opacity:1, y:0, duration:.7*d}, 0.05)
    .to('.hero-headline .char', {yPercent:0, duration:.8*d, stagger: reduceMotion?0:0.035, ease:'power4.out'}, 0.15)
    .to('.hero-role', {opacity:1, y:0, duration:.7*d}, 0.5)
    .to('.badges .badge', {opacity:1, y:0, duration:.5*d, stagger: reduceMotion?0:0.06}, 0.62)
    .to('.hero-actions .btn', {opacity:1, y:0, duration:.5*d, stagger: reduceMotion?0:0.08}, 0.75)
    .to('.hero-visual', {opacity:1, y:0, scale:1, duration:1*d}, 0.35)
    .to('.social-rail .social-icon', {opacity:1, x:0, duration:.5*d, stagger: reduceMotion?0:0.06}, 0.8)
    .to('.scroll-indicator', {opacity:1, duration:.6*d}, 1);
}

/* ============================================================================
   PRELOADER
   ============================================================================ */
function initPreloader(){
  const pre = document.getElementById('preloader');
  if(!pre) return;
  const fill = document.getElementById('pre-fill');
  const pct = document.getElementById('pre-pct');
  let prog = 0, done = false;
  const tick = setInterval(()=>{
    prog = Math.min(prog + 8 + Math.random()*12, 92);
    fill.style.width = prog + '%';
    pct.textContent = Math.round(prog) + '%';
  }, 110);

  function finish(){
    if(done) return;
    done = true;
    clearInterval(tick);
    fill.style.width = '100%';
    pct.textContent = '100%';
    gsap.to(pre, {opacity:0, duration: reduceMotion?0.01:0.6, delay:.3, ease:'power2.inOut',
      onComplete: ()=>{ pre.remove(); startHero(); }});
  }
  window.addEventListener('load', finish);
  setTimeout(finish, 4000); // fail-safe
}

/* ============================================================================
   CUSTOM CURSOR (desktop only)
   ============================================================================ */
function initCursor(){
  if(!window.matchMedia('(pointer:fine)').matches || reduceMotion) return;
  const dot = document.getElementById('cursor-dot');
  const ring = document.getElementById('cursor-ring');
  if(!dot || !ring) return;
  let mx = innerWidth/2, my = innerHeight/2, rx = mx, ry = my;
  window.addEventListener('mousemove', e=>{
    mx = e.clientX; my = e.clientY;
    dot.style.left = mx + 'px'; dot.style.top = my + 'px';
  });
  (function loop(){
    rx += (mx - rx) * 0.16; ry += (my - ry) * 0.16;
    ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
    requestAnimationFrame(loop);
  })();
  document.querySelectorAll('a, button, .tech-pill, .badge, .project-card, input, textarea').forEach(el=>{
    el.addEventListener('mouseenter', ()=>ring.classList.add('hovered'));
    el.addEventListener('mouseleave', ()=>ring.classList.remove('hovered'));
  });
}

/* ============================================================================
   NAVBAR + MOBILE MENU
   ============================================================================ */
let menuOpen = false;
function setMenu(open){
  menuOpen = open;
  const toggle = document.getElementById('nav-toggle');
  const menu = document.getElementById('mobile-menu');
  toggle.classList.toggle('active', open);
  toggle.setAttribute('aria-expanded', open);
  menu.classList.toggle('open', open);
  document.body.style.overflow = open ? 'hidden' : '';
  if(open && !reduceMotion){
    gsap.fromTo('#mobile-links a', {y:44, opacity:0}, {y:0, opacity:1, stagger:0.06, duration:.5, ease:'power3.out', delay:.2});
    gsap.fromTo('.mobile-menu-footer, .mobile-menu-email', {y:20, opacity:0}, {y:0, opacity:1, duration:.5, delay:.45, ease:'power3.out'});
  }
}

function initNav(){
  const toggle = document.getElementById('nav-toggle');
  if(!toggle) return;
  toggle.addEventListener('click', ()=>setMenu(!menuOpen));
  document.querySelectorAll('#mobile-links a').forEach(a=>{
    a.addEventListener('click', ()=>setMenu(false));
  });
  document.addEventListener('keydown', e=>{ if(e.key === 'Escape' && menuOpen) setMenu(false); });

  const navbar = document.getElementById('navbar');
  let lastY = 0;
  ScrollTrigger.create({
    start: 0, end: 'max',
    onUpdate: self=>{
      const y = self.scroll();
      navbar.classList.toggle('scrolled', y > 30);
      if(y > 480 && y > lastY && !menuOpen) navbar.classList.add('hidden');
      else navbar.classList.remove('hidden');
      lastY = y;
    }
  });

  // active section highlighting
  document.querySelectorAll('#app section[id]').forEach(sec=>{
    ScrollTrigger.create({
      trigger: sec, start:'top 45%', end:'bottom 45%',
      onEnter: ()=>setActiveNav(sec.id), onEnterBack: ()=>setActiveNav(sec.id)
    });
  });
  function setActiveNav(id){
    const key = (id === 'worked_with' || id === 'expanding') ? 'skills' : id;
    document.querySelectorAll('.nav-links a, #mobile-links a').forEach(a=>
      a.classList.toggle('active', a.dataset.key === key || a.dataset.key === id)
    );
  }

  // scroll progress bar
  const sp = document.getElementById('sp-fill');
  ScrollTrigger.create({
    start: 0, end: 'max',
    onUpdate: self=>{ sp.style.transform = `scaleX(${self.progress})`; }
  });
}

/* ============================================================================
   MAGNETIC + TILT (desktop)
   ============================================================================ */
function initMicro(){
  if(!window.matchMedia('(pointer:fine)').matches || reduceMotion) return;

  document.querySelectorAll('[data-magnetic]').forEach(el=>{
    el.addEventListener('mousemove', e=>{
      const r = el.getBoundingClientRect();
      gsap.to(el, {x:(e.clientX - r.left - r.width/2)*0.28, y:(e.clientY - r.top - r.height/2)*0.28, duration:.4, ease:'power2.out'});
    });
    el.addEventListener('mouseleave', ()=>gsap.to(el, {x:0, y:0, duration:.6, ease:'elastic.out(1,0.4)'}));
  });

  document.querySelectorAll('[data-tilt]').forEach(card=>{
    card.addEventListener('mousemove', e=>{
      const r = card.getBoundingClientRect();
      const rx = ((e.clientY - r.top)/r.height - .5) * -6;
      const ry = ((e.clientX - r.left)/r.width - .5) * 8;
      gsap.to(card, {rotateX:rx, rotateY:ry, transformPerspective:800, duration:.4, ease:'power2.out'});
    });
    card.addEventListener('mouseleave', ()=>gsap.to(card, {rotateX:0, rotateY:0, duration:.5, ease:'power2.out'}));
  });
}

/* ============================================================================
   INTERACTIONS — carousel, testimonial dots, forms
   ============================================================================ */
function initInteractions(){
  // projects carousel
  const track = document.getElementById('projects-track');
  if(track){
    const step = 322;
    const nextBtn = document.getElementById('proj-next');
    const prevBtn = document.getElementById('proj-prev');
    if(nextBtn) nextBtn.addEventListener('click', ()=> track.scrollBy({left: step, behavior:'smooth'}));
    if(prevBtn) prevBtn.addEventListener('click', ()=> track.scrollBy({left: -step, behavior:'smooth'}));
  }

  // testimonial dots — clickable; swipe-sync on mobile
  const grid = document.getElementById('testi-grid');
  const dots = [...document.querySelectorAll('#testi-dots button')];
  if(grid && dots.length){
    const cards = [...grid.children];
    const setDot = i => dots.forEach((d,j)=>d.classList.toggle('active', j===i));
    const isMobile = ()=> window.innerWidth <= 980;
    dots.forEach((d,i)=>d.addEventListener('click', ()=>{
      setDot(i);
      if(isMobile()){
        const pad = parseFloat(getComputedStyle(grid).paddingLeft) || 0;
        grid.scrollTo({left: cards[i].offsetLeft - pad, behavior:'smooth'});
      }
    }));
    let scrollRaf;
    grid.addEventListener('scroll', ()=>{
      if(!isMobile()) return;
      cancelAnimationFrame(scrollRaf);
      scrollRaf = requestAnimationFrame(()=>{
        const pad = parseFloat(getComputedStyle(grid).paddingLeft) || 0;
        const sl = grid.scrollLeft + pad;
        let best = 0, bestDist = Infinity;
        cards.forEach((c,i)=>{
          const dist = Math.abs(c.offsetLeft - sl);
          if(dist < bestDist){ bestDist = dist; best = i; }
        });
        setDot(best);
      });
    }, {passive:true});
    // gentle auto-highlight cycle on desktop
    if(!reduceMotion){
      let idx = 0;
      setInterval(()=>{
        if(isMobile()) return;
        idx = (idx + 1) % dots.length;
        setDot(idx);
      }, 3200);
    }
  }

  // contact form (mock submit — wire to POST /contact later)
  const form = document.getElementById('contact-form');
  if(form){
    form.addEventListener('submit', e=>{
      e.preventDefault();
      const status = document.getElementById('form-status');
      status.textContent = 'Message captured locally — connect the Laravel API to send this for real.';
      status.classList.add('show');
      form.reset();
      setTimeout(()=>status.classList.remove('show'), 5000);
    });
  }

  // newsletter (mock)
  const nl = document.getElementById('newsletter-form');
  if(nl){
    nl.addEventListener('submit', e=>{
      e.preventDefault();
      const note = document.getElementById('footer-note');
      note.textContent = 'Subscribed — newsletter hookup coming soon.';
      note.classList.add('show');
      nl.reset();
      setTimeout(()=>note.classList.remove('show'), 4000);
    });
  }
}

/* ============================================================================
   MOTION SYSTEM — GSAP + ScrollTrigger
   ============================================================================ */
function initMotion(){
  gsap.registerPlugin(ScrollTrigger);

  // split hero headline into characters + set initial hidden state
  document.querySelectorAll('.hero-headline .line-text').forEach(line=>{
    line.innerHTML = [...line.textContent].map(c=>`<span class="char">${c === ' ' ? '&nbsp;' : c}</span>`).join('');
  });
  gsap.set('.hero-headline .char', {yPercent: 115});

  if(!reduceMotion){
    // floating icons ambient bob
    document.querySelectorAll('[data-float]').forEach((el,i)=>{
      gsap.to(el, {y:'+=10', duration:2.4 + i*0.3, ease:'sine.inOut', yoyo:true, repeat:-1, delay:i*0.15});
    });
    // orbit slow spin
    gsap.to('.orbit-ring.r1', {rotate:360, duration:40, repeat:-1, ease:'none'});
    gsap.to('.orbit-ring.r2', {rotate:-360, duration:55, repeat:-1, ease:'none'});
    // hero glow + photo parallax on scroll
    gsap.to('.hero-glow', {yPercent:35, ease:'none', scrollTrigger:{trigger:'.hero', start:'top top', end:'bottom top', scrub:true}});
    gsap.to('.hero-photo-wrap', {yPercent:-8, ease:'none', scrollTrigger:{trigger:'.hero', start:'top top', end:'bottom top', scrub:true}});
  }

  // scroll reveals (hero excluded — handled by intro timeline)
  gsap.utils.toArray('.reveal').forEach(el=>{
    if(el.closest('.hero')) return;
    if(reduceMotion){ gsap.set(el, {opacity:1, y:0}); return; }
    gsap.to(el, {
      opacity:1, y:0, duration:0.8, ease:'power3.out',
      scrollTrigger:{ trigger: el, start:'top 88%', once:true }
    });
  });

  // about code lines typewriter-style stagger
  const codeLines = document.querySelectorAll('#about-code .code-line');
  if(codeLines.length){
    if(reduceMotion){ gsap.set(codeLines, {opacity:1, x:0}); }
    else{
      gsap.to(codeLines, {
        opacity:1, x:0, duration:.45, stagger:.12, ease:'power2.out',
        scrollTrigger:{ trigger:'#about-code', start:'top 80%', once:true }
      });
    }
  }

  // stat counters
  document.querySelectorAll('.stat-value').forEach(el=>{
    const raw = el.dataset.count || el.textContent;
    const num = parseFloat(raw);
    const suffix = raw.replace(/[\d.]/g, '');
    if(isNaN(num) || reduceMotion){ el.textContent = raw; return; }
    const obj = {v: 0};
    gsap.to(obj, {
      v: num, duration:1.6, ease:'power2.out',
      scrollTrigger:{ trigger: el, start:'top 90%', once:true },
      onUpdate: ()=>{ el.textContent = Math.round(obj.v) + suffix; }
    });
  });

  // skill bars — fill + percent count-up on scroll
  document.querySelectorAll('.skill-card').forEach(card=>{
    const fill = card.querySelector('.skill-bar-fill');
    const pct = card.querySelector('.skill-pct');
    const level = parseFloat(fill.dataset.level);
    if(reduceMotion){ fill.style.width = level+'%'; pct.textContent = level+'%'; return; }
    const obj = {v: 0};
    gsap.to(obj, {
      v: level, duration:1.5, ease:'power2.out',
      scrollTrigger:{ trigger: card, start:'top 88%', once:true },
      onUpdate: ()=>{
        fill.style.width = obj.v + '%';
        pct.textContent = Math.round(obj.v) + '%';
      }
    });
  });

  // marquees (seamless, supports reverse)
  document.querySelectorAll('.marquee-track').forEach(track=>{
    if(reduceMotion) return;
    const width = track.scrollWidth / 2;
    const speed = parseFloat(track.dataset.speed) || 40;
    const reversed = track.dataset.reverse === 'true';
    const tween = reversed
      ? gsap.fromTo(track, {x: -width}, {x: 0, duration: speed, ease:'none', repeat:-1})
      : gsap.fromTo(track, {x: 0}, {x: -width, duration: speed, ease:'none', repeat:-1});
    const vp = track.closest('.marquee-viewport');
    vp.addEventListener('mouseenter', ()=>tween.timeScale(0.15));
    vp.addEventListener('mouseleave', ()=>tween.timeScale(1));
  });

  // experience timeline fill
  const tlFill = document.getElementById('tl-fill');
  if(tlFill && !reduceMotion){
    const desktop = window.innerWidth > 980;
    gsap.to(tlFill, {
      ...(desktop ? {width:'100%'} : {height:'100%'}),
      ease:'none',
      scrollTrigger:{ trigger:'.timeline', start:'top 75%', end:'bottom 90%', scrub:1 }
    });
  } else if(tlFill){
    tlFill.style.width = '100%';
  }
}

/* ============================================================================
   INIT
   All markup already exists in the DOM (rendered server-side by Blade),
   so — exactly like the original inline script running after the HTML
   it needed — we can call these directly without a data-render step.
   ============================================================================ */
initPreloader();
initMotion();
initNav();
initInteractions();
initCursor();
initMicro();
